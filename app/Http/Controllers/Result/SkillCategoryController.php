<?php

namespace App\Http\Controllers\Result;
use App\Http\Controllers\Controller;

use App\Models\Result\SkillCategory;
use App\Http\Requests\Result\StoreSkillCategoryRequest;
use App\Http\Requests\Result\UpdateSkillCategoryRequest;

class SkillCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreSkillCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkillCategoryRequest $request)
    {
        $this->authorize('is-admin');
        $request->validate([
            'name' => ['required', 'string', 'unique:skill_categories'],
        ]);

        // persist
        $skill_category = SkillCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('add-skill')->with('success','new skill category added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SkillCategory  $skillCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SkillCategory $skillCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SkillCategory  $skillCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SkillCategory $skillCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSkillCategoryRequest  $request
     * @param  \App\Models\SkillCategory  $skillCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkillCategoryRequest $request, SkillCategory $skillCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SkillCategory  $skillCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SkillCategory $skillCategory)
    {
        //
    }
}
