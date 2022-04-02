<?php

namespace App\Http\Controllers\Result;
use App\Http\Controllers\Controller;

use App\Models\Term;
use App\Http\Requests\Result\StoreTermRequest;
use App\Http\Requests\Result\UpdateTermRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermController extends Controller
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
        return view('results/terms', [
            'terms' => DB::table('terms')->paginate(session('per_page'))
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
        return view('results.add-term');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTermRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTermRequest $request)
    {
        $this->authorize('is-admin');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'session' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        // persist
        $term = Term::create([
            'name' => $request->name,
            'session' => $request->session,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('terms')->with('success','Term added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        $this->authorize('is-admin');
        $term = Term::find($term)->first();
        return view('results.edit-term',[
            'term' => $term
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTermRequest  $request
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTermRequest $request, Term $term)
    {
        $this->authorize('is-admin');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'session' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);
 
        // persist
        $term->update([
            'name' => $request->name,
            'session' => $request->session,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
 
        return redirect()->route('terms')->with('success','Term updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        $this->authorize('is-admin');
        $term->delete();
        return redirect()->route('terms')->with('success','Term deleted successfully!');
    }
}
