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
        // if(auth()->user()->is_admin){
            return view('results.reports', [
                'reports' => TermReport::with('pupil','term')->paginate(session('per_page'))
            ]);
        // }else{
        //     return view('results.tests', [
        //         'tests' => Test::where('pupil_id', auth()->user()->id)->paginate(session('per_page'))
        //     ]);
        // }
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
            'times_school_opened' => [ 'integer'],
            'times_present' => [ 'integer'],
            'times_punctual' => ['integer'],
            'sport_activities_1' => [ 'integer'],
            'sport_activities_2' => [ 'integer'],
            'sport_activities_3' => [ 'integer'],
            'other_activities_1' => [ 'integer'],
            'other_activities_2' => [ 'integer'],
            'other_activities_3' => [ 'integer'],
            'conduct_good' => [ 'integer'],
            'conduct_bad' => [ 'integer'],
            'conduct_exemplary' => [ 'integer'],
            'conduct_comment' => [ 'string'],
            'height_start' => [ 'integer'],
            'height_end' => [ 'integer'],
            'weight_start' => [ 'integer'],
            'weight_end' => [ 'integer'],
            'illness_days' => ['integer'],
            'illness_nature' => ['string'],
            'cleanliness_rating' => [ 'string', Rule::in(['A','B','C','D','E','F'])],
            'cleanliness_remark' => [ 'string', Rule::in(['excellent','very_good','good','fair','poor','fail'])],
            'ball_games' => [ 'string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'tracks' => [ 'string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'jumps' => [ 'string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'throws' => [ 'string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'swimming' => [ 'string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'others' => [ 'string', Rule::in(['excellent','very_good','good','fair','poor','fail','nil'])],
            'organisation'=> [ 'string'],
            'organisation_office'=> [ 'string'],
            'organisation_contribution'=> [ 'string'],
            'teacher_remark'=> [ 'string'],
            'head_remark'=> [ 'string'],
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
            $termResult->test_2 = $subject['test_1'];
            $termResult->test_3 = $subject['test_1'];
            $termResult->test_4 = $subject['test_1'];
            $termResult->exam = $subject['test_1'];
            $termResult->percentage = $subject['test_1'];
            $termResult->grade = $subject['grade'];
            $termResult->effort_grade = $subject['grade'];
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
        return view('results.view-report',[
            'report' => $report,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermReport  $termReport
     * @return \Illuminate\Http\Response
     */
    public function edit(TermReport $termReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTermReportRequest  $request
     * @param  \App\Models\TermReport  $termReport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTermReportRequest $request, TermReport $termReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermReport  $termReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermReport $termReport)
    {
        //
    }
}
