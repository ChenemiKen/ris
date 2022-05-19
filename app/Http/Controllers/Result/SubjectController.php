<?php

namespace App\Http\Controllers\Result;
use App\Http\Controllers\Controller;

use App\Models\Result\Subject;
use App\Http\Requests\Result\StoreSubjectRequest;
use App\Http\Requests\Result\UpdateSubjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
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
        return view('results/subjects', [
            'subjects' => DB::table('subjects')->where($filter)->paginate(session('per_page'))
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
        return view('results.add-subject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubjectRequest $request)
    {
        $this->authorize('is-admin');
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:subjects'],
            'class' => ['required', 'string', Rule::in(['beacon','lower_primary','upper_primary','nursery','playgroup'])],
            'max_score' => ['required', 'numeric'],
        ]);

        // persist
        $subject = Subject::create([
            'name' => $request->name,
            'class' => $request->class,
            'max_score' => $request->max_score,
        ]);

        return redirect()->route('subjects')->with('success','Subject added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $this->authorize('is-admin');
        $subject = Subject::find($subject)->first();
        return view('results.edit-subject',[
            'subject' => $subject
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubjectRequest  $request
     * @param  \App\Models\Result\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $this->authorize('is-admin');
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('subjects')->ignore($subject->id)],
            'class' => ['required', 'string', 'max:255'],
            'max_score' => ['required', 'numeric'],
        ]);
 
        // persist
        $subject->update([
            'name' => $request->name,
            'class' => $request->class,
            'max_score' => $request->max_score,
        ]);
 
        return redirect()->route('subjects')->with('success','Subject updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $this->authorize('is-admin');
        $subject->delete();
        return redirect()->route('subjects')->with('success','Subject deleted successfully!');
    }
}
