<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('is-admin');
        // pagination no of rows per page
        session(['per_page' => $request->get('per_page', 10)]);
        return view('teacher', [
            'teachers' => Teacher::with('user')->paginate(session('per_page'))
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
        $this->authorize('is-admin');
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'class' => ['required', 'string', Rule::in(['beacon','lower_primary','upper_primary','nursery','playgroup'])],
            'subclass' => ['nullable', 'string', 
                            Rule::in(['upper_primary_6','upper_primary_5','upper_primary_4','lower_primary_3','lower_primary_2','lower_primary_1','nursery_2','nursery_1']),
                            Rule::requiredIf(in_array($request->class, ['lower_primary','upper_primary','nursery']))
                        ],
            'class_group' => ['nullable', 'string', 
                                Rule::in(['daniel','david','joseph','samuel']),
                                Rule::requiredIf(in_array($request->class, ['lower_primary','upper_primary','nursery']))
                            ],
            'gender' => ['required', RULE::in(['M','F'])],
            'phone' => ['required','numeric'],
            'email' => ['required','string','email'],
            'photo' => ['required','image','mimes:jpeg,png,jpg,gif,svg'],
        ]);
        // save the photo
        $photoName = $request->firstname.$request->lastname.'.'.$request->photo->extension();
        $request->photo->storeAs('teachers', $photoName, 'public');

        // persist
        $user = User::create([
            'fullname' => $request->lastname.' '.$request->firstname,
            'username' => $request->lastname.$request->firstname,
            'email' => $request->email,
            'photo' => $photoName,
            'password' => Hash::make('12345678'),
           
        ]);

        $teacher = Teacher::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'class' => $request->class,
            'subclass'=>$request->subclass,
            'class_group'=>$request->class_group,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'user_id'=> $user->id,
        ]);

        $user->update([
            'type_id' => $teacher->id,
            'type_type' => get_class($teacher),
        ]);

        event(new Registered($user));

        return redirect()->route('teachers')->with('success','Teacher added successfully!');
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
        $this->authorize('is-admin');
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
        $this->authorize('is-admin');
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'class' => ['required', 'string', Rule::in(['beacon','lower_primary','upper_primary','nursery','playgroup'])],
            'subclass' => ['nullable', 'string', 
                            Rule::in(['upper_primary_6','upper_primary_5','upper_primary_4','lower_primary_3','lower_primary_2','lower_primary_1','nursery_2','nursery_1']),
                            Rule::requiredIf(in_array($request->class, ['lower_primary','upper_primary','nursery']))
                        ],
            'class_group' => ['nullable', 'string', 
                                Rule::in(['daniel','david','joseph','samuel']),
                                Rule::requiredIf(in_array($request->class, ['lower_primary','upper_primary','nursery']))
                            ],
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

        $teacher_user = $teacher->user();
        $teacher_user->update([
            'fullname' => $request->lastname.' '.$request->firstname,
            'email' => $request->email,
            'photo' => $photoName,
        ]);
        // persist
        $teacher->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'class' => $request->class,
            'subclass'=>$request->subclass,
            'class_group'=>$request->class_group,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'photo' => $photoName,
        ]);
 
        return redirect()->route('teachers')->with('success','Teacher updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $this->authorize('is-admin');
        $photoName = $teacher->photo;
        if (Storage::disk('public')->exists('teachers/'.$photoName)) {
            Storage::disk('public')->delete('teachers/'.$photoName);
        }
        // unlink('pupils_images/'.$pupil->photo);
        $teacher->delete();
        return redirect()->route('teachers')->with('success','Teacher deleted successfully!');
    }
}
