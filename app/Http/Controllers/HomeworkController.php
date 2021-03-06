<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Http\Requests\StoreHomeworkRequest;
use App\Http\Requests\UpdateHomeworkRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

class HomeworkController extends Controller
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
        if(Gate::allows('is-admin')){
            return view('homeworks', [
                'homeworks' => DB::table('homework')->paginate(session('per_page'))
            ]);
        }elseif(Gate::allows('is-teacher')){
            return view('homeworks', [
                'homeworks' => Homework::where('class', auth()->user()->class)->paginate(session('per_page'))
            ]);
        }elseif(Gate::allows('is-parent')){
            return view('homeworks', [
                'homeworks' => Homework::where('class', auth()->user()->pupil_parent->pupil->class)->paginate(session('per_page'))
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
        return view('add-homework');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHomeworkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHomeworkRequest $request)
    {
        $this->authorize('is-staff');
        $request->validate([
            'date' => ['required', 'date'],
            'class' => ['required', 'string', 'max:255'],
            'submission_date' => ['required', 'date'],
            'homework' => ['required', 'string'],
        ]);

        // persist
        $homework = Homework::create([
            'date' => $request->date,
            'class' => $request->class,
            'submission_date' => $request->submission_date,
            'homework' => $request->homework,
        ]);
        return redirect('/homeworks')->with('success','Homework created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function show(Homework $homework)
    {
        return view('view-homework',[
            'homework' => $homework,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function edit(Homework $homework)
    {
        $this->authorize('is-staff');
        $homework = Homework::find($homework)->first();
        return view('edit-homework',[
            'homework' => $homework
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHomeworkRequest  $request
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomeworkRequest $request, Homework $homework)
    {
        $this->authorize('is-staff');
        $request->validate([
            'date' => ['required', 'date'],
            'class' => ['required', 'string', 'max:255'],
            'submission_date' => ['required', 'date'],
            'homework' => ['required', 'string'],
        ]);

        // persist
        $homework->update([
            'date' => $request->date,
            'class' => $request->class,
            'submission_date' => $request->submission_date,
            'homework' => $request->homework,
        ]);
        return redirect('/homeworks')->with('success','Homework updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function destroy(Homework $homework)
    {
        $this->authorize('is-staff');
        $homework->delete();
        return redirect('/homeworks')->with('success','Homework deleted successfully!');
    }
}
