<?php

namespace App\Http\Controllers\Result\Primary;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use App\Models\Result\Primary\PrimaryTermReport;
use App\Models\Result\Primary\PrimaryTermResult;
use App\Models\Pupil;
use App\Models\Teacher;
use App\Models\Result\Term;
use App\Models\Result\Subject;
use App\Http\Requests\Result\Primary\StorePrimaryTermReportRequest;
use App\Http\Requests\Result\Primary\UpdatePrimaryTermReportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PrimaryTermReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // pagination no of rows per page
        session(['per_page' => $request->get('per_page', 10)]);
        $terms = Term::all('id','name','session');
        $filter = [];
        if(isset($request->term) && (!($request->term == 'all'))){
            $filter['term_id']= $request->term;    
        }

        if(Gate::allows('is-staff')){
            return view('results.primary.primary-reports', [
                'reports' => PrimaryTermReport::with('pupil','term')->where($filter)->paginate(session('per_page')),
                'terms' => $terms
            ]); 
        }elseif(Gate::allows('is-parent')){
            $ward = Pupil::find(auth()->user()->pupil_parent->pupil->id);
            return view('results.nursery.nursery-reports', [
                'reports' => PrimaryTermReport::with('pupil','term')->where('pupil_id', $ward->id)->where($filter)->paginate(session('per_page')),
                'terms' => $terms
            ]);
  
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('is-staff');
        $pupils = Pupil::whereIn('class', ['lower_primary', 'upper_primary'])->paginate();
        $terms = Term::all('id','name','session');
        $subjects = Subject::all('id','name');
        return view('results.primary.add-primary-report', ['pupils'=>$pupils, 'terms'=>$terms, 'subjects'=>$subjects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Primary\StorePrimaryTermReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrimaryTermReportRequest $request)
    {
        $this->authorize('is-staff');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'term' => ['required', 'integer', 'exists:terms,id'],
            'subject.*.id' => ['nullable', 'integer', 'exists:subjects,id'],
            'subject.*.name' => ['nullable', 'string'],
            'subject.*.test_1' => ['nullable', 'integer'],
            'subject.*.test_2' => ['nullable', 'integer'],
            'subject.*.test_3' => ['nullable', 'integer'],
            'subject.*.test_4' => ['nullable', 'integer'],
            'subject.*.exam' => ['nullable', 'integer'],
            'subject.*.mark' => ['nullable', 'integer'],
            'subject.*.grade' => ['nullable', 'string', Rule::in(['A','B','C','D','E','F'])],
            'subject.*.effort_grade' => ['nullable','string', Rule::in(['A','B','C','D','E','F'])],
            'subject.*.comment' => ['nullable','string', Rule::in(['excellent','very_good','good','fair','poor','fail'])],
            'times_school_opened' => ['nullable','integer'],
            'times_present' => [ 'nullable','integer'],
            'times_punctual' => ['nullable','integer'],
            'sport_activities_1' => [ 'nullable','integer'],
            'sport_activities_2' => [ 'nullable','integer'],
            'sport_activities_3' => [ 'nullable','integer'],
            'other_activities_1' => [ 'nullable','string'],
            'other_activities_2' => [ 'nullable','string'],
            'other_activities_3' => [ 'nullable','string'],
            'conduct_good' => [ 'nullable','integer'],
            'conduct_bad' => [ 'nullable','integer'],
            'conduct_exemplary' => [ 'nullable','integer'],
            'conduct_comment' => [ 'nullable','string'],
            'height_start' => [ 'nullable','integer'],
            'height_end' => [ 'nullable','integer'],
            'weight_start' => [ 'nullable','integer'],
            'weight_end' => [ 'nullable','integer'],
            'illness_days' => ['nullable','integer'],
            'illness_nature' => ['nullable','string'],
            'cleanliness_rating' => [ 'nullable','string', Rule::in(['A','B','C','D','E','F'])],
            'cleanliness_remark' => [ 'nullable','string', Rule::in(['excellent','very_good','good','fair','poor','fail'])],
            'ball_games' => [ 'nullable','string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'tracks' => [ 'nullable','string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'jumps' => [ 'nullable','string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'throws' => [ 'nullable','string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'swimming' => [ 'nullable','string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'others' => [ 'nullable','string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'organisation'=> [ 'nullable','string'],
            'organisation_office'=> [ 'nullable','string'],
            'organisation_contribution'=> [ 'nullable','string'],
            'teacher_remark'=> [ 'nullable','string'],
            'head_remark'=> [ 'nullable','string'],
        ]);
        $pupil = Pupil::find($request->pupil);
        $teacher = Teacher::where('class', $pupil->class)
                            ->orderByDesc('created_at')
                            ->limit(1)
                            ->get();
        if(count($teacher) > 0){
            $class_teacher_id = $teacher[0]->id;
        }else{
            $class_teacher_id = null;
        }

        // persist report
        $report = $pupil->primaryTermReports()->create([
            'term_id' => $request->term,
            // attendance
            'times_school_opened'=>$request->times_school_opened,
            'times_present'=>$request->times_present,
            'times_punctual'=>$request->times_punctual,
            'sports_1'=>$request->sport_activities_1,
            'sports_2'=>$request->sport_activities_2,
            'sports_3'=>$request->sport_activities_3,
            'other_event_1'=>$request->other_activities_1,
            'other_event_2'=>$request->other_activities_2,
            'other_event_3'=>$request->other_activities_3,
            // conduct
            'conduct_good'=>$request->conduct_good,
            'conduct_bad'=>$request->conduct_bad,
            'conduct_exemplary'=>$request->conduct_exemplary,
            'conduct_comment'=>$request->conduct_comment,
            // physical development, health and cleanliness
            'height_start'=>$request->height_start,
            'height_end'=>$request->height_end,
            'weight_start'=>$request->weight_start,
            'weight_end'=>$request->weight_end,
            'illness_days'=>$request->illness_days,
            'nature_of_illness'=>$request->illness_nature,
            'cleanliness_rating'=>$request->cleanliness_rating,
            'cleanliness_remark'=>$request->cleanliness_remark,
            // sports
            'ball_games'=>$request->ball_games,
            'tracks'=>$request->tracks,
            'jumps'=>$request->jumps,
            'throws'=>$request->throws,
            'swimming'=>$request->swimming,
            'others'=>$request->others,
            // clubs
            'organisation'=>$request->organisation,
            'organisation_office'=>$request->organisation_office,
            'organisation_contribution'=>$request->organisation_contribution,
            'teacher_remark'=>$request->teacher_remark,
            'head_remark'=>$request->head_remark,
            'date'=> Carbon::today(),
            'teacher_id'=> $class_teacher_id
        ]);
        // Log::debug($test);
        foreach($request->subject as $subject){
            $termResult = new PrimaryTermResult();
            $termResult->primary_term_report_id = $report->id;
            $termResult->pupil_id = $pupil->id;
            $termResult->term_id = $request->term;
            $termResult->subject_id = $subject['id'];
            $termResult->test_1 = $subject['test_1'];
            $termResult->test_2 = $subject['test_2'];
            $termResult->test_3 = $subject['test_2'];
            $termResult->test_4 = $subject['test_3'];
            $termResult->exam = $subject['exam'];
            $termResult->percentage = $subject['mark'];
            $termResult->grade = $subject['grade'];
            $termResult->effort_grade = $subject['effort_grade'];
            $termResult->remark = $subject['comment'];

            // persist testResult
            $termResult->save();
        }

        return redirect()->route('primary-reports')->with('success','Term Report added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Primary\PrimaryTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function show(PrimaryTermReport $report)
    {
        if(Gate::allows('is-staff')){
            return view('results.primary.view-primary-report',[
                'report' => $report,
            ]);
        }else{
            return view('results.primary.parent-pirmary-report-view',[
                'report' => $report,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Primary\PrimaryTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(PrimaryTermReport $report)
    {
        $this->authorize('is-staff');
        $pupils = Pupil::whereIn('class', ['lower_primary', 'upper_primary'])->paginate();
        $terms = Term::all('id','name','session');
        $subjects = Subject::all('id','name');
        return view('results.primary.edit-primary-report', [
            'report'=>$report,
            'pupils'=>$pupils, 
            'terms'=>$terms, 
            'subjects'=>$subjects
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Primary\UpdatePrimaryTermReportRequest  $request
     * @param  \App\Models\Primary\PrimaryTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrimaryTermReportRequest $request, PrimaryTermReport $report)
    {
        $this->authorize('is-staff');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'term' => ['required', 'integer', 'exists:terms,id'],
            'result.*.name' => ['string'],
            'result.*.test_1' => ['integer'],
            'result.*.test_2' => ['integer'],
            'result.*.id' => ['integer', 'exists:primary_term_results,id'],
            'result.*.test_3' => ['integer'],
            'result.*.test_4' => ['integer'],
            'result.*.exam' => ['integer'],
            'result.*.mark' => ['integer'],
            'result.*.grade' => ['string', Rule::in(['A','B','C','D','E','F'])],
            'result.*.effort_grade' => ['string', Rule::in(['A','B','C','D','E','F'])],
            'result.*.comment' => ['string', Rule::in(['excellent','very_good','good','fair','poor','fail'])],
            'times_school_opened' => [ 'nullable','integer'],
            'times_present' => [ 'nullable','integer'],
            'times_punctual' => ['nullable','integer'],
            'sport_activities_1' => [ 'nullable','integer'],
            'sport_activities_2' => ['nullable', 'integer'],
            'sport_activities_3' => ['nullable', 'integer'],
            'other_activities_1' => ['nullable', 'string'],
            'other_activities_2' => ['nullable', 'string'],
            'other_activities_3' => ['nullable', 'string'],
            'conduct_good' => [ 'nullable','integer'],
            'conduct_bad' => ['nullable', 'integer'],
            'conduct_exemplary' => [ 'nullable','integer'],
            'conduct_comment' => ['nullable', 'string'],
            'height_start' => [ 'nullable','integer'],
            'height_end' => ['nullable', 'integer'],
            'weight_start' => [ 'nullable','integer'],
            'weight_end' => [ 'nullable','integer'],
            'illness_days' => ['nullable','integer'],
            'illness_nature' => ['nullable','string'],
            'cleanliness_rating' => ['nullable', 'string', Rule::in(['A','B','C','D','E','F'])],
            'cleanliness_remark' => ['nullable', 'string', Rule::in(['excellent','very_good','good','fair','poor','fail'])],
            'ball_games' => [ 'nullable','string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'tracks' => ['nullable', 'string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'jumps' => [ 'nullable','string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'throws' => ['nullable', 'string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'swimming' => [ 'nullable','string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'others' => ['nullable', 'string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'organisation'=> [ 'nullable','string'],
            'organisation_office'=> [ 'nullable','string'],
            'organisation_contribution'=> [ 'nullable','string'],
            'teacher_remark'=> [ 'nullable','string'],
            'head_remark'=> [ 'nullable','string'],
        ]);
        $pupil = Pupil::find($request->pupil);

        // persist report update
        $report -> update([
            'pupil_id' => $request->pupil,
            'term_id' => $request->term,
            // attendance
            'times_school_opened'=>$request->times_school_opened,
            'times_present'=>$request->times_present,
            'times_punctual'=>$request->times_punctual,
            'sports_1'=>$request->sport_activities_1,
            'sports_2'=>$request->sport_activities_2,
            'sports_3'=>$request->sport_activities_3,
            'other_event_1'=>$request->other_activities_1,
            'other_event_2'=>$request->other_activities_2,
            'other_event_3'=>$request->other_activities_3,
            // conduct
            'conduct_good'=>$request->conduct_good,
            'conduct_bad'=>$request->conduct_bad,
            'conduct_exemplary'=>$request->conduct_exemplary,
            'conduct_comment'=>$request->conduct_comment,
            // physical development, health and cleanliness
            'height_start'=>$request->height_start,
            'height_end'=>$request->height_end,
            'weight_start'=>$request->weight_start,
            'weight_end'=>$request->weight_end,
            'illness_days'=>$request->illness_days,
            'nature_of_illness'=>$request->illness_nature,
            'cleanliness_rating'=>$request->cleanliness_rating,
            'cleanliness_remark'=>$request->cleanliness_remark,
            // sports
            'ball_games'=>$request->ball_games,
            'tracks'=>$request->tracks,
            'jumps'=>$request->jumps,
            'throws'=>$request->throws,
            'swimming'=>$request->swimming,
            'others'=>$request->others,
            // clubs
            'organisation'=>$request->organisation,
            'organisation_office'=>$request->organisation_office,
            'organisation_contribution'=>$request->organisation_contribution,
            'teacher_remark'=>$request->teacher_remark,
            'head_remark'=>$request->head_remark,
        ]);
        foreach($request->result as $result){
            $termResult = PrimaryTermResult::find($result['id']);
            $termResult->primary_term_report_id = $report->id;
            $termResult->pupil_id = $pupil->id;
            $termResult->term_id = $request->term;
            $termResult->test_1 = $result['test_1'];
            $termResult->test_2 = $result['test_2'];
            $termResult->test_3 = $result['test_2'];
            $termResult->test_4 = $result['test_3'];
            $termResult->exam = $result['exam'];
            $termResult->percentage = $result['mark'];
            $termResult->grade = $result['grade'];
            $termResult->effort_grade = $result['effort_grade'];
            $termResult->remark = $result['comment'];

            // persist testResult update
            $termResult->update();
        }

        return redirect()->route('primary-reports')->with('success','Term Report updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Primary\PrimaryTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrimaryTermReport $report)
    {
        $this->authorize('is-staff');
        $report->delete();
        return redirect()->route('primary-reports')->with('success','Term report deleted successfully!');
    }
}
