<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePupilParentRequest;
use App\Http\Requests\UpdatePupilParentRequest;
use App\Models\User;
use App\Models\Pupil;
use App\Models\PupilParent;
// use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PupilParentController extends Controller
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
        return view('parents', [
            'parents' =>PupilParent::with('user')->paginate(session('per_page'))
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
        return view('add-parent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->authorize('is-admin');
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'admission_no' => ['required', 'string', 'max:255', 'unique:users,username', 'exists:pupils,admission_no'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','string', 'max:255'],
            'address' => ['required', 'string'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $ward = Pupil::where('admission_no', $request->admission_no)->first();

        $user = User::create([
            'fullname' => $request->fullname,
            'username' => $request->admission_no,
            'email' => $request->email,
            'password' => Hash::make($request->admission_no),
        ]);

        $pupil_parent = PupilParent::create([
            'admission_no'=>$request->admission_no,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'user_id'=>$user->id,
            'pupil_id'=>$ward->id,
        ]);

        $user->update([
            'type_id' => $pupil_parent->id,
            'type_type' => get_class($pupil_parent),
        ]);

        event(new Registered($user));

        return redirect()->route('parents')->with('success','Parent added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PupilParent  $pupilParent
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $parent
     * @return \Illuminate\Http\Response
     */
    public function edit(User $parent)
    {
        $this->authorize('is-admin');
        $parent = User::find($parent)->first();
        return view('edit-parent',[
            'parent' => $parent
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User  $parent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $parent)
    {
        $this->authorize('is-admin');
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'admission_no' => ['required', 'string', 'max:255', Rule::unique('users','username')->ignore($parent->id)],
            'email' => ['required', 'string', 'email', Rule::unique('users')->ignore($parent->id)],
            'phone' => ['required','string', 'max:255'],
            'address' => ['required', 'string'],
        ]);

        $puilParent_user = $parent->user();
        $puilParent_user->update([
            'fullname' => $request->lastname.' '.$request->firstname,
            'email' => $request->email,
        ]);
        
        // persist
        $parent->update([
            'fullname' => $request->fullname,
            'username' => $request->admission_no,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
 
        return redirect()->route('parents')->with('success','Parent updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $parent
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $parent)
    {
        $this->authorize('is-admin');
        $parent->delete();
        return redirect()->route('parents')->with('success','Parent deleted successfully!');
    }
}
