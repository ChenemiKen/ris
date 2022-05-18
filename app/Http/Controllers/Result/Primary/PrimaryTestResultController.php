<?php

namespace App\Http\Controllers\Result\Primary;
use App\Http\Controllers\Controller;

use App\Models\Result\Primary\PrimaryTestResult;
use App\Http\Requests\Result\Primary\StorePrimaryTestResultRequest;
use App\Http\Requests\Result\Primary\UpdatePrimaryTestResultRequest;

class TestResultController extends Controller
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
     * @param  App\Http\Requests\Result\Primary\StorePrimaryTestResultRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrimaryTestResultRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Result\Primary\PrimaryTestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function show(PrimaryTestResult $testResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Result\Primary\PrimaryTestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function edit(PrimaryTestResult $testResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Result\Primary\UpdatePrimaryTestResultRequest  $request
     * @param  App\Models\Result\Primary\PrimaryTestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrimaryTestResultRequest $request, PrimaryTestResult $testResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Result\Primary\PrimaryTestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrimaryTestResult $testResult)
    {
        //
    }
}
