<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
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
        return view('teacher', [
            'teachers' => DB::table('teachers')->paginate(session('per_page'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-teacher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'class' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string'],
            'phone' => ['required','numeric'],
            'email' => ['required','string','email'],
            'photo' => ['required','image','mimes:jpeg,png,jpg,gif,svg'],
        ]);
        // save the photo
        $photoName = $request->firstname.$request->lastname.'.'.$request->photo->extension();
        $request->photo->storeAs('teachers', $photoName, 'public');

        // persist
        $teacher = Teacher::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'class' => $request->class,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'photo' => $photoName,
        ]);

        return redirect('/teachers')->with('success','Teacher added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $pupil = Teacher::find($teacher)->first();
        return view('edit_teacher',[
            'teacher' => $teacher
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeacherRequest  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'class' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string'],
            'phone' => ['required','numeric'],
            'email' => ['required','string','email'],
            'photo' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg'],
        ]);
        $photoName = $teacher->photo;
        if ($request->hasFile('photo') && $request->file('photo')->isValid()){
            if (Storage::disk('public')->exists('teachers/'.$photoName)) {
                Storage::disk('public')->delete('teachers/'.$photoName);
            }
            $photoName = $request->firstname.$request->lastname.'.'.$request->photo->extension();
            // save the photo
            $request->photo->storeAs('teachers', $photoName, 'public');
        };
        // persist
        $teacher->update([
             'firstname' => $request->firstname,
             'lastname' => $request->lastname,
             'class' => $request->class,
             'gender' => $request->gender,
             'phone' => $request->phone,
             'email' => $request->email,
             'photo' => $photoName,
        ]);
 
        return redirect('/teachers')->with('success','Teacher updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
