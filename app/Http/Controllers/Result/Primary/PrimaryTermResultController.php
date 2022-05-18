<?php

namespace App\Http\Controllers\Result\Primary;
use App\Http\Controllers\Controller;

use App\Models\Result\Primary\PrimaryTermResult;
use App\Http\Requests\Result\Primary\StorePrimaryTermResultRequest;
use App\Http\Requests\Result\Primary\UpdatePrimaryTermResultRequest;

class PrimaryTermResultController extends Controller
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
     * @param  \App\Http\Requests\Result\Primary\StorePrimaryTermResultRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrimaryTermResultRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Primary\PrimaryTermResult  $termResult
     * @return \Illuminate\Http\Response
     */
    public function show(PrimaryTermResult $termResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Primary\PrimaryTermResult  $termResult
     * @return \Illuminate\Http\Response
     */
    public function edit(PrimaryTermResult $termResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Result\Primary\UpdatePrimaryTermResultRequest  $request
     * @param  \App\Models\Result\Primary\PrimaryTermResult  $termResult
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrimaryTermResultRequest $request, PrimaryTermResult $termResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result\Primary\PrimaryTermResult  $termResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrimaryTermResult $termResult)
    {
        //
    }
}
