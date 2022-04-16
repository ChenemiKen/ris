<?php

namespace App\Http\Controllers\Result;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use App\Models\TermReport;
use App\Models\Pupil;
use App\Models\Term;
use App\Models\Subject;
use App\Http\Requests\Result\StoreTermReportRequest;
use App\Http\Requests\Result\UpdateTermReportRequest;
use App\Models\TermResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TermReportController extends Controller
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

        if(auth()->user()->is_admin){
            return view('results.reports', [
                'reports' => TermReport::with('pupil','term')->where($filter)->paginate(session('per_page')),
                'terms' => $terms
            ]);
        }else{
            $ward = Pupil::where('admission_no', auth()->user()->username)->first();
            if(!is_null($ward)){
                return view('results.reports', [
                    'reports' => TermReport::with('pupil','term')->where('pupil_id', $ward->id)->where($filter)->paginate(session('per_page')),
                    'terms' => $terms
                ]);
            }else{
                return view('results.reports', [
                    'reports' => TermReport::with('pupil','term')->where('pupil_id', ' ')->where($filter)->paginate(session('per_page')),
                    'terms' => $terms
                ]); 
            }   
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('is-admin');
        $pupils = Pupil::all('id','firstname','lastname');
        $terms = Term::all('id','name','session');
        $subjects = Subject::all('id','name');
        return view('results.add-report', ['pupils'=>$pupils, 'terms'=>$terms, 'subjects'=>$subjects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTermReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTermReportRequest $request)
    {
        $this->authorize('is-admin');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'term' => ['required', 'integer', 'exists:terms,id'],
            'subject.*.id' => ['required', 'integer', 'exists:subjects,id'],
            'subject.*.name' => ['required', 'string'],
            'subject.*.test_1' => ['required', 'integer'],
            'subject.*.test_2' => ['required', 'integer'],
            'subject.*.test_3' => ['required', 'integer'],
            'subject.*.test_4' => ['required', 'integer'],
            'subject.*.exam' => ['required', 'integer'],
            'subject.*.mark' => ['required', 'integer'],
            'subject.*.grade' => ['required', 'string', Rule::in(['A','B','C','D','E','F'])],
            'subject.*.effort_grade' => ['required', 'string', Rule::in(['A','B','C','D','E','F'])],
            'subject.*.comment' => ['required', 'string', Rule::in(['excellent','very_good','good','fair','poor','fail'])],
            // I removed required for now to ease testing
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

        // persist report
        $report = $pupil->termReports()->create([
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
        // Log::debug($test);
        foreach($request->subject as $subject){
            $termResult = new TermResult();
            $termResult->term_report_id = $report->id;
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

        return redirect()->route('reports')->with('success','Term Report added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function show(TermReport $report)
    {
        if(auth()->user()->is_admin){
            return view('results.view-report',[
                'report' => $report,
            ]);
        }else{
            return view('results.parent-report-view',[
                'report' => $report,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(TermReport $report)
    {
        $this->authorize('is-admin');
        $pupils = Pupil::all('id','firstname','lastname');
        $terms = Term::all('id','name','session');
        $subjects = Subject::all('id','name');
        return view('results.edit-report', [
            'report'=>$report,
            'pupils'=>$pupils, 
            'terms'=>$terms, 
            'subjects'=>$subjects
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTermReportRequest  $request
     * @param  \App\Models\TermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTermReportRequest $request, TermReport $report)
    {
        $this->authorize('is-admin');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'term' => ['required', 'integer', 'exists:terms,id'],
            'result.*.name' => ['required', 'string'],
            'result.*.test_1' => ['required', 'integer'],
            'result.*.test_2' => ['required', 'integer'],
            'result.*.id' => ['required', 'integer', 'exists:term_results,id'],
            'result.*.test_3' => ['required', 'integer'],
            'result.*.test_4' => ['required', 'integer'],
            'result.*.exam' => ['required', 'integer'],
            'result.*.mark' => ['required', 'integer'],
            'result.*.grade' => ['required', 'string', Rule::in(['A','B','C','D','E','F'])],
            'result.*.effort_grade' => ['required', 'string', Rule::in(['A','B','C','D','E','F'])],
            'result.*.comment' => ['required', 'string', Rule::in(['excellent','very_good','good','fair','poor','fail'])],
            // I removed required for now to ease testing
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
        // Log::debug($test);
        foreach($request->result as $result){
            $termResult = TermResult::find($result['id']);
            $termResult->term_report_id = $report->id;
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

        return redirect()->route('reports')->with('success','Term Report updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermReport $report)
    {
        $this->authorize('is-admin');
        $report->delete();
        return redirect()->route('reports')->with('success','Term report deleted successfully!');
    }
}
