<?php

namespace App\Http\Controllers\Result\Beacon;
use App\Http\Controllers\Controller;

use App\Models\Result\Beacon\BeaconSkillResult;
use App\Http\Requests\Result\Beacon\StoreBeaconSkillResultRequest;
use App\Http\Requests\Result\Beacon\UpdateBeaconSkillResultRequest;

class BeaconSkillResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Result\Beacon\StoreBeaconSkillResultRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBeaconSkillResultRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result\Beacon\BeaconSkillResult  $beaconSkillResult
     * @return \Illuminate\Http\Response
     */
    public function show(BeaconSkillResult $beaconSkillResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result\Beacon\BeaconSkillResult  $beaconSkillResult
     * @return \Illuminate\Http\Response
     */
    public function edit(BeaconSkillResult $beaconSkillResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBeaconSkillResultRequest  $request
     * @param  \App\Models\BeaconSkillResult  $beaconSkillResult
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBeaconSkillResultRequest $request, BeaconSkillResult $beaconSkillResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BeaconSkillResult  $beaconSkillResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(BeaconSkillResult $beaconSkillResult)
    {
        //
    }
}
