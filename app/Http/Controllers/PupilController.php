<?php

namespace App\Http\Controllers;

use App\Models\Pupil;
use App\Http\Requests\StorePupilRequest;
use App\Http\Requests\UpdatePupilRequest;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PupilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('is-staff');
        // pagination no of rows per page
        session(['per_page' => $request->get('per_page', 10)]);
        $class_filter = [];
        if(Gate::denies('is-admin')){ 
            if(Gate::allows('is-teacher')){
                $class_filter['class']= auth()->user()->teacher->class;
            }elseif(Gate::allows('is-parent')){
                $class_filter['class']= auth()->user()->pupil_parent->pupil->class;
            }
        }
        return view('pupil', [
            'pupils' => Pupil::where($class_filter)->paginate(session('per_page'))
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
        return view('add-pupil');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePupilRequest  $request
     * @return \Illuminate\Http\Response
     * 
     *  @throws \Illuminate\Validation\ValidationException
     */
    public function store(StorePupilRequest $request)
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
            'DOB' => ['required', 'date'],
            'gender' => ['required', 'string'],
            'parent_phone' => ['required','numeric'],
            'parent_email' => ['required','string','email'],
            'admission_no' => ['required','string','unique:pupils'],
            'entry_date' => ['required','date'],
            'photo' => ['required','image','mimes:jpeg,png,jpg,gif,svg'],
        ]);
        // save the photo
        $photoName = $request->firstname.$request->lastname.'.'.$request->photo->extension();
        $request->photo->storeAs('pupils', $photoName, 'public');

        // persist
        $pupil = Pupil::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'class' => $request->class,
            'subclass'=>$request->subclass,
            'class_group'=>$request->class_group,
            'dob' => $request->DOB,
            'gender' => $request->gender,
            'parent_phone' => $request->parent_phone,
            'parent_email' => $request->parent_email,
            'admission_no' => $request->admission_no,
            'entry_date' => $request->entry_date,
            'photo' => $photoName,
        ]);

        return redirect(RouteServiceProvider::ADMIN_HOME)->with('success','Pupil added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pupil  $pupil
     * @return \Illuminate\Http\Response
     */
    public function show(Pupil $pupil)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  \App\Models\Pupil  $pupil
     * @return \Illuminate\Http\Response
     */
    public function edit(Pupil $id)
    {
        $this->authorize('is-admin');
        $pupil = Pupil::find($id)->first();
        return view('edit_pupil',[
            'pupil' => $pupil
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePupilRequest  $request
     * @param  \App\Models\Pupil  $pupil
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePupilRequest $request, Pupil $pupil)
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
            'DOB' => ['required', 'date'],
            'gender' => ['required', 'string'],
            'parent_phone' => ['required','numeric'],
            'parent_email' => ['required','string','email'],
            'admission_no' => ['required','string', Rule::unique('pupils')->ignore($pupil->id)],
            'entry_date' => ['required','date'],
            'photo' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg'],
        ]);
        $photoName = $pupil->photo;
        if ($request->hasFile('photo') && $request->file('photo')->isValid()){
            if (Storage::disk('public')->exists('pupils/'.$photoName)) {
                Storage::disk('public')->delete('pupils/'.$photoName);
            }
            $photoName = $request->firstname.$request->lastname.'.'.$request->photo->extension();
            // save the photo
            $request->photo->storeAs('pupils', $photoName, 'public');
        };
        // persist
        $pupil->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'class' => $request->class,
            'subclass'=>$request->subclass,
            'class_group'=>$request->class_group,
            'dob' => $request->DOB,
            'gender' => $request->gender,
            'parent_phone' => $request->parent_phone,
            'parent_email' => $request->parent_email,
            'admission_no' => $request->admission_no,
            'entry_date' => $request->entry_date,
            'photo' => $photoName,
        ]);
 
        return redirect(RouteServiceProvider::ADMIN_HOME)->with('success','Pupil updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pupil  $pupil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pupil $pupil)
    {
        $this->authorize('is-admin');
        $photoName = $pupil->photo;
        if (Storage::disk('public')->exists('pupils/'.$photoName)) {
            Storage::disk('public')->delete('pupils/'.$photoName);
        }
        // unlink('pupils_images/'.$pupil->photo);
        $pupil->delete();
        return redirect(RouteServiceProvider::ADMIN_HOME)->with('success','Pupil deleted successfully!');
    }

    /**
     * Show the form for moving pupils.
     *
     * @return \Illuminate\Http\Response
     */
    public function relocate()
    {
        $this->authorize('is-admin');
        $pupils = Pupil::all('id','firstname','lastname');
        return view('move-pupil',['pupils'=>$pupils]);
    }


    /**
     * Change the pupil's class.
     *
     * @param  \App\Http\Requests\UpdatePupilRequest  $request
     * @param  \App\Models\Pupil  $pupil
     * @return \Illuminate\Http\Response
    */
    public function move(UpdatePupilRequest $request){
        $this->authorize('is-admin');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'class' => ['required', 'string', Rule::in(['beacon','lower_primary','upper_primary','nursery','playgroup'])],
        ]);
        $pupil = Pupil::find($request->pupil);
        $pupil -> update([
            'class'=>$request->class
        ]);
        return redirect(RouteServiceProvider::ADMIN_HOME)->with('success','Pupil moved successfully!');
    }
}
