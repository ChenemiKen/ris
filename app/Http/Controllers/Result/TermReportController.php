<?php

namespace App\Http\Controllers\Result;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use App\Models\TermReport;
use App\Models\Pupil;
use App\Models\Term;
use App\Models\Subject;
use App\Http\Requests\StoreTermReportRequest;
use App\Http\Requests\UpdateTermReportRequest;
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
                'reports' => TermResult::with('pupil','term')->paginate(session('per_page'))
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TermReport  $termReport
     * @return \Illuminate\Http\Response
     */
    public function show(TermReport $termReport)
    {
        //
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
