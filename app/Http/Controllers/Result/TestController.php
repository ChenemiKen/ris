<?php

namespace App\Http\Controllers\Result;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use App\Models\Test;
use App\Models\Pupil;
use App\Models\Term;
use App\Models\Subject;
use App\Http\Requests\Result\StoreTestRequest;
use App\Http\Requests\Result\UpdateTestRequest;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
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
        $terms = Term::all('id','name','session');
        $filter = [];
        if(isset($request->term) && (!($request->term == 'all'))){
            $filter['term_id']= $request->term;    
        }
        if(isset($request->test) && (!($request->test == 'all'))){
            $filter['test_no']= $request->test;    
        }
        // if(auth()->user()->is_admin){
            return view('results.tests', [
                'tests' => Test::with('pupil','term')->where($filter)->paginate(session('per_page')),
                'terms' => $terms,
            ]);
        // }else{
        //     return view('results.tests', [
        //         'tests' => Test::where('pupil_id', auth()->user()->id)->paginate(session('per_page'))
        //     ]);
        // }
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
        $terms = Term::all('id','name','session');
        $subjects = Subject::all('id','name');
        return view('results.add-test', ['pupils'=>$pupils, 'terms'=>$terms, 'subjects'=>$subjects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestRequest $request)
    {
        $this->authorize('is-admin');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'term' => ['required', 'integer', 'exists:terms,id'],
            'test_no' => ['required', 'integer', Rule::in([1,2,3,4])],
            'subject.*.id' => ['required', 'integer', 'exists:subjects,id'],
            'subject.*.name' => ['required', 'string'],
            'subject.*.score' => ['required', 'integer'],
            'subject.*.grade' => ['required', 'string', Rule::in(['A','B','C','D','E','F'])],
            'subject.*.remark' => ['required', 'string', Rule::in(['excellent','very_good','good','fair','poor','fail'])],
        ]);
        $pupil = Pupil::find($request->pupil);
        
        // $test = new Test();
        // $test->test_no = $request->test_no;
        // $test->term_id = $request->term;

        // persist test
        $test = $pupil->tests()->create([
            'test_no' => $request->test_no,
            'term_id' => $request->term,
        ]);
        // Log::debug($test);
        foreach($request->subject as $subject){
            $testResult = new TestResult();
            $testResult->test_id = $test->id;
            $testResult->pupil_id = $pupil->id;
            $testResult->term_id = $request->term;
            $testResult->subject_id = $subject['id'];
            $testResult->score = $subject['score'];
            $testResult->grade = $subject['grade'];
            $testResult->remark = $subject['remark'];

            // persist testResult
            $testResult->save();
        }

        return redirect()->route('tests')->with('success','Test Result added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        return view('results.view-test',[
            'test' => $test,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        $this->authorize('is-admin');
        $pupils = Pupil::all('id','firstname','lastname');
        $terms = Term::all('id','name','session');
        $subjects = Subject::all('id','name');
        return view('results.edit-test', [
            'test'=>$test,
            'pupils'=>$pupils, 
            'terms'=>$terms, 
            'subjects'=>$subjects
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTestRequest  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestRequest $request, Test $test)
    {
        $this->authorize('is-admin');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'term' => ['required', 'integer', 'exists:terms,id'],
            'test_no' => ['required', 'integer', Rule::in([1,2,3,4])],
            'result.*.id' => ['required', 'integer', 'exists:test_results,id'],
            'result.*.name' => ['required', 'string'],
            'result.*.score' => ['required', 'integer'],
            'result.*.grade' => ['required', 'string', Rule::in(['A','B','C','D','E','F'])],
            'result.*.remark' => ['required', 'string', Rule::in(['excellent','very_good','good','fair','poor','fail'])],
        ]);
        $pupil = Pupil::find($request->pupil);
        
        // persist test update
        $test->update([
            'pupil_id' => $request->pupil,
            'term_id' => $request->term,
            'test_no' => $request->test_no,
        ]);
        foreach($request->result as $result){
            $testResult = TestResult::find($result['id']);
            $testResult->test_id = $test->id;
            $testResult->pupil_id = $pupil->id;
            $testResult->term_id = $request->term;
            $testResult->score = $result['score'];
            $testResult->grade = $result['grade'];
            $testResult->remark = $result['remark'];

            // persist testResult update
            $testResult->update();
        }

        return redirect()->route('tests')->with('success','Test Result updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        $this->authorize('is-admin');
        $test->delete();
        return redirect()->route('tests')->with('success','Test Result deleted successfully!');
    }
}
