<?php

namespace App\Http\Controllers\Result;
use App\Http\Controllers\Controller;

use App\Models\Result\Skill;
use App\Http\Requests\Result\StoreSkillRequest;
use App\Http\Requests\Result\UpdateSkillRequest;
use App\Models\Result\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SkillController extends Controller
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
        $filter = [];
        if(isset($request->class) && (!($request->class == 'all'))){
            $filter['class'] = $request->class;    
        }
        // Log::debug($request->class);
        return view('results/skills', [
            'skills' => Skill::with('skill_category')->where($filter)->paginate(session('per_page'))
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('is-admin');
        $categories = SkillCategory::all('id','name');
        return view('results.add-skill', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSkillRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkillRequest $request)
    {
        $this->authorize('is-admin');
        $request->validate([
            'name' => ['required', 'string', 'unique:skill_categories'],
            'class' => ['required', 'string', Rule::in(['beacon','lower_primary','upper_primary','nursery','playgroup'])],
            'category' => ['required', 'numeric', 'exists:skill_categories,id'],
        ]);

        // persist
        $skill = Skill::create([
            'name' => $request->name,
            'class'=>$request->class,
            'skill_category_id'=>$request->category,
        ]);

        return redirect()->route('skills')->with('success','new skill added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        $this->authorize('is-admin');
        $skill = Skill::find($skill)->first();
        $categories = SkillCategory::all('id','name');
        return view('results.edit-skill',[
            'skill' => $skill,
            'categories'=> $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSkillRequest  $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkillRequest $request, Skill $skill)
    {
        $this->authorize('is-admin');
        $request->validate([
            'name' => ['required', 'string', 'unique:skill_categories'],
            'class' => ['required', 'string', Rule::in(['beacon','lower_primary','upper_primary','nursery','playgroup'])],
            'category' => ['required', 'numeric', 'exists:skill_categories,id'],
        ]);
 
        // persist
        $skill->update([
            'name' => $request->name,
            'class'=>$request->class,
            'skill_category_id'=>$request->category,
        ]);
 
        return redirect()->route('skills')->with('success','Skill updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        $this->authorize('is-admin');
        $skill->delete();
        return redirect()->route('skills')->with('success','Skill deleted successfully!');
    }
}
