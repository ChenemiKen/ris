<?php

namespace App\Http\Controllers\Result\Beacon;
use App\Http\Controllers\Controller;

use App\Models\Result\Beacon\BeaconTermReport;
use App\Models\Result\Beacon\BeaconSkillTermReport;
use App\Models\Pupil;
use App\Models\Result\Term;
use App\Models\Result\Skill;
use App\Models\Result\SkillCategory;
use App\Http\Requests\Result\Beacon\StoreBeaconTermReportRequest;
use App\Http\Requests\Result\Beacon\UpdateBeaconTermReportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class BeaconTermReportController extends Controller
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

        if(Gate::allows('is-admin')){
            return view('results.beacon.beacon-reports', [
                'reports' => BeaconTermReport::with('pupil','term')->where($filter)->paginate(session('per_page')),
                'terms' => $terms
            ]);
        }elseif(Gate::allows('is-teacher')){
            return view('results.beacon.beacon-reports', [
                'reports' => BeaconTermReport::with('pupil','term')->where($filter)->paginate(session('per_page')),
                'terms' => $terms
            ]);
        }elseif(Gate::allows('is-parent')){
            $ward = Pupil::find(auth()->user()->pupil_parent->pupil->id);
            return view('results.beacon.beacon-reports', [
                'reports' => BeaconTermReport::with('pupil','term')->where('pupil_id', $ward->id)->where($filter)->paginate(session('per_page')),
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
        $pupils = Pupil::all('id','firstname','lastname');
        $terms = Term::all('id','name','session');
        $skills = Skill::all('id','name','skill_category_id');
        $skillCategories = SkillCategory::all('id','name');
        return view('results.beacon.add-beacon-report', ['pupils'=>$pupils, 'terms'=>$terms, 'skills'=>$skills, 'skill_categories'=>$skillCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Result\Beacon\StoreBeaconTermReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBeaconTermReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result\Beacon\BeaconTermReport  $beaconTermReport
     * @return \Illuminate\Http\Response
     */
    public function show(BeaconTermReport $beaconTermReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result\Beacon\BeaconTermReport  $beaconTermReport
     * @return \Illuminate\Http\Response
     */
    public function edit(BeaconTermReport $beaconTermReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Result\Beacon\UpdateBeaconTermReportRequest  $request
     * @param  \App\Models\Result\Beacon\BeaconTermReport  $beaconTermReport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBeaconTermReportRequest $request, BeaconTermReport $beaconTermReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result\Beacon\BeaconTermReport  $beaconTermReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(BeaconTermReport $beaconTermReport)
    {
        //
    }
}
