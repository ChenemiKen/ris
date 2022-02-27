<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Pupil;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ResultController extends Controller
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
        return view('results', [
            'results' => Result::with('pupil')->paginate(session('per_page'))
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
        return view('add-result',['pupils'=>$pupils]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResultRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResultRequest $request)
    {
        $this->authorize('is-admin');
        $request->validate([
            'date' => ['required', 'date'],
            'pupil' => ['required', 'exists:pupils,id'],
            'term' => ['required', 'string', 'max:255'],
            'data' => ['required', 'string', 'max:255'],
            'file' => ['required'],
        ]);
        $pupil = Pupil::find($request->pupil);
        // save the file
        $fileName = $pupil->firstname.$pupil->lastname.$request->term.$request->date.'.'.$request->file->extension();
        $request->file->storeAs('results', $fileName, 'public');
        
        $result = new Result();
        $result->date = $request->date;
        $result->term = $request->term;
        $result->data = $request->data;
        $result->file = $fileName;

        // persist
        $pupil = $pupil->results()->save($result);

        return redirect()->route('results')->with('success','Result added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        $this->authorize('is-admin');
        $result = Result::find($result)->first();
        $pupils = Pupil::all('id','firstname','lastname');
        return view('edit-result',[
            'result' => $result,
            'pupils'=>$pupils
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResultRequest  $request
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResultRequest $request, Result $result)
    {
        $this->authorize('is-admin');
        $request->validate([
            'date' => ['required', 'date'],
            'term' => ['required', 'string', 'max:255'],
            'data' => ['required', 'string', 'max:255'],
            'file' => [],
        ]);
        $pupil = Pupil::find($result->pupil_id)->first();
        // save the file
        $fileName = $result->file;
        // Log::debug($photoName);
        if ($request->hasFile('file') && $request->file('file')->isValid()){
            // Log::debug('has file!');
            if (Storage::disk('public')->exists('results/'.$fileName)) {
                // Log::debug('file exists!');
                Storage::disk('public')->delete('results/'.$fileName);
            }
            $fileName = $pupil->firstname.$pupil->lastname.$request->term.$request->date.".".$request->file->extension();
            $request->file->storeAs('results', $fileName, 'public');
        };

        $result->date = $request->date;
        $result->term = $request->term;
        $result->data = $request->data;
        $result->file = $fileName;

        // persist
        $result->save();

        return redirect()->route('results')->with('success','Result updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        $this->authorize('is-admin');
        $fileName = $result->file;
        if (Storage::disk('public')->exists('results/'.$fileName)) {
            Storage::disk('public')->delete('results/'.$fileName);
        }
        $result->delete();
        return redirect()->route('results')->with('success','Result deleted successfully!');
    }
}
