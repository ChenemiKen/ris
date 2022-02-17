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
        // pagination no of rows per page
        session(['per_page' => $request->get('per_page', 10)]);
        return view('pupil', [
            'pupils' => DB::table('pupils')->paginate(session('per_page'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'class' => ['required', 'string', 'max:255'],
            'DOB' => ['required', 'date'],
            'age' => ['required', 'numeric'],
            'gender' => ['required', 'string'],
            'parent_phone' => ['required','numeric'],
            'parent_email' => ['required','string','email'],
            'admission_no' => ['required','string','max:255'],
            'entry_date' => ['required','date'],
            'photo' => ['required','image','mimes:jpeg,png,jpg,gif,svg'],
        ]);
        // save the photo
        $photoName = $request->firstname.$request->lastname.'.'.$request->photo->extension();
        $request->photo->storeAs('pupils_images', $photoName);

        // persist
        $pupil = Pupil::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'class' => $request->class,
            'dob' => $request->DOB,
            'age' => $request->age,
            'gender' => $request->gender,
            'parent_phone' => $request->parent_phone,
            'parent_email' => $request->parent_email,
            'admission_no' => $request->admission_no,
            'entry_date' => $request->entry_date,
            'photo' => $photoName,
        ]);

        return redirect(RouteServiceProvider::HOME)->with('success','Pupil added successfully!');
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
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'class' => ['required', 'string', 'max:255'],
            'DOB' => ['required', 'date'],
            'age' => ['required', 'numeric'],
            'gender' => ['required', 'string'],
            'parent_phone' => ['required','numeric'],
            'parent_email' => ['required','string','email'],
            'admission_no' => ['required','string','max:255'],
            'entry_date' => ['required','date'],
            'photo' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg'],
        ]);
        $photoName = $pupil->photo;
        Log::debug($photoName);
        if ($request->hasFile('photo') && $request->file('photo')->isValid()){
            Log::debug('has file!');
            if (Storage::disk('pupils')->exists($photoName)) {
                Log::debug('file exists!');
                Storage::disk('pupils')->delete($photoName);
            }
            $photoName = $request->firstname.$request->lastname.'.'.$request->photo->extension();
            // save the photo
            $request->photo->storeAs('pupils_images', $photoName);
        };
        // persist
        $pupil->update([
             'firstname' => $request->firstname,
             'lastname' => $request->lastname,
             'class' => $request->class,
             'dob' => $request->DOB,
             'age' => $request->age,
             'gender' => $request->gender,
             'parent_phone' => $request->parent_phone,
             'parent_email' => $request->parent_email,
             'admission_no' => $request->admission_no,
             'entry_date' => $request->entry_date,
             'photo' => $photoName,
        ]);
 
         return redirect(RouteServiceProvider::HOME)->with('success','Pupil updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pupil  $pupil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pupil $pupil)
    {
        //
    }
}
