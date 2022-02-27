<?php

namespace App\Http\Controllers;

use App\Models\Birthday;
use App\Models\Pupil;
use App\Http\Requests\StoreBirthdayRequest;
use App\Http\Requests\UpdateBirthdayRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BirthdayController extends Controller
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
        return view('birthdays', [
            'birthdays' => Birthday::with('pupil')->paginate()
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
        $pupils = Pupil::all('id','firstname','lastname');
        return view('add-birthday',['pupils'=>$pupils]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBirthdayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBirthdayRequest $request)
    {
        $this->authorize('is-admin');
        $request->validate([
            'date' => ['required', 'date'],
            'pupil' => ['required', 'exists:pupils,id'],
            'photo' => ['required'],
        ]);
        $pupil = Pupil::find($request->pupil);
        // save the file
        $photoName = $pupil->firstname.$pupil->lastname.$request->date.'.'.$request->photo->extension();
        $request->photo->storeAs('birthdays', $photoName, 'public');
        
        $birthday = new Birthday();
        $birthday->date = $request->date;
        $birthday->photo = $photoName;

        // persist
        $pupil = $pupil->birthdays()->save($birthday);

        return redirect()->route('birthdays')->with('success','Birthday added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Birthday  $birthday
     * @return \Illuminate\Http\Response
     */
    public function show(Birthday $birthday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Birthday  $birthday
     * @return \Illuminate\Http\Response
     */
    public function edit(Birthday $birthday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBirthdayRequest  $request
     * @param  \App\Models\Birthday  $birthday
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBirthdayRequest $request, Birthday $birthday)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Birthday  $birthday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Birthday $birthday)
    {
        //
    }
}
