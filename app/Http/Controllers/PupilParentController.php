<?php

namespace App\Http\Controllers;

use App\Models\PupilParent;
use App\Http\Requests\StorePupilParentRequest;
use App\Http\Requests\UpdatePupilParentRequest;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use App\Models\Pupil;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PupilParentController extends Controller
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
        return view('parents', [
            'parents' => DB::table('pupil_parents')->paginate(session('per_page'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-parent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePupilParentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePupilParentRequest $request)
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'phone' => ['required','numeric'],
            'email' => ['required','string','email'],
            'address' => ['required', 'string'],
        ]);

        // persist
        $parent = PupilParent::create([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect('/parents')->with('success','Parent added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PupilParent  $pupilParent
     * @return \Illuminate\Http\Response
     */
    public function show(PupilParent $pupilParent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PupilParent  $parent
     * @return \Illuminate\Http\Response
     */
    public function edit(PupilParent $parent)
    {
        $parent = PupilParent::find($parent)->first();
        return view('edit-parent',[
            'parent' => $parent
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePupilParentRequest  $request
     * @param  \App\Models\PupilParent  $parent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePupilParentRequest $request, PupilParent $parent)
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'phone' => ['required','numeric'],
            'email' => ['required','string','email'],
            'address' => ['required', 'string'],
        ]);
        
        // persist
        $parent->update([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ]);
 
        return redirect('/parents')->with('success','Parent updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PupilParent  $parent
     * @return \Illuminate\Http\Response
     */
    public function destroy(PupilParent $parent)
    {
        $parent->delete();
        return redirect('/parents')->with('success','Parent deleted successfully!');
    }
}
