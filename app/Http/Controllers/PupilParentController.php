<?php

namespace App\Http\Controllers;


// use App\Http\Requests\StorePupilParentRequest;
// use App\Http\Requests\UpdatePupilParentRequest;
use App\Models\User;
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
        // pagination no of rows per page
        session(['per_page' => $request->get('per_page', 10)]);
        return view('parents', [
            'parents' => DB::table('users')->where('is_admin', false)->paginate(session('per_page'))
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'admission_no' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','string', 'max:255'],
            'address' => ['required', 'string'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'fullname' => $request->fullname,
            'username' => $request->admission_no,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->admission_no),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        return redirect('/parents')->with('success','Parent added successfully!');
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
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'admission_no' => ['required', 'string', 'max:255', Rule::unique('users,username')->ignore($parent->id)],
            'email' => ['required', 'string', 'email', Rule::unique('users')->ignore($parent->id)],
            'phone' => ['required','string', 'max:255'],
            'address' => ['required', 'string'],
        ]);
        
        // persist
        $parent->update([
            'fullname' => $request->fullname,
            'username' => $request->admission_no,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
 
        return redirect('/parents')->with('success','Parent updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $parent
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $parent)
    {
        $parent->delete();
        return redirect('/parents')->with('success','Parent deleted successfully!');
    }
}
