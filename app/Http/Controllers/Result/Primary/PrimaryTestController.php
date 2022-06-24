<?php

namespace App\Http\Controllers\Result\Primary;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use App\Models\Pupil;
use App\Models\Teacher;
use App\Models\Result\Term;
use App\Models\Result\Subject;
use App\Models\Result\Primary\PrimaryTest;
use App\Models\Result\Primary\PrimaryTestResult;
use App\Http\Requests\Result\Primary\StorePrimaryTestRequest;
use App\Http\Requests\Result\Primary\UpdatePrimaryTestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PrimaryTestController extends Controller
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
        if(Gate::allows('is-staff')){
            return view('results.primary.primary-tests', [
                'tests' => PrimaryTest::with('pupil','term')->where($filter)->paginate(session('per_page')),
                'terms' => $terms,
            ]);
        }elseif(Gate::allows('is-parent')){
            $ward = Pupil::find(auth()->user()->pupil_parent->pupil->id);
            return view('results.nursery.nursery-reports', [
                'reports' => PrimaryTest::with('pupil','term')->where('pupil_id', $ward->id)->where($filter)->paginate(session('per_page')),
                'terms' => $terms
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('is-staff');
        $pupils = Pupil::whereIn('class', ['lower_primary', 'upper_primary'])->paginate();
        $terms = Term::all('id','name','session');
        $subjects = Subject::all('id','name');
        return view('results.primary.add-primary-test', ['pupils'=>$pupils, 'terms'=>$terms, 'subjects'=>$subjects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Result\Primary\StorePrimaryTestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrimaryTestRequest $request)
    {
        $this->authorize('is-staff');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'term' => ['required', 'integer', 'exists:terms,id'],
            'test_no' => ['required', 'integer', Rule::in([1,2,3,4])],
            'subject.*.id' => ['nullable', 'integer', 'exists:subjects,id'],
            'subject.*.name' => ['nullable', 'string'],
            'subject.*.score' => ['nullable', 'string'],
            'subject.*.grade' => ['nullable', 'string', Rule::in(['A','B','C','D','E','F'])],
            'subject.*.remark' => ['nullable', 'string', Rule::in(['excellent','very_good','good','fair','poor','fail'])],
        ]);
        $pupil = Pupil::find($request->pupil);
        $teacher = Teacher::where('class', $pupil->class)
                            ->orderByDesc('created_at')
                            ->limit(1)
                            ->get();
        if(count($teacher) > 0){
            $class_teacher_id = $teacher[0]->id;
        }else{
            $class_teacher_id = null;
        }
        Log::debug($class_teacher_id);
        // persist test
        $test = $pupil->primaryTests()->create([
            'test_no'=> $request->test_no,
            'term_id'=> $request->term,
            'date'=> Carbon::today(),
            'teacher_id'=> $class_teacher_id
        ]);
        foreach($request->subject as $subject){
            $testResult = new PrimaryTestResult();
            $testResult->primary_test_id = $test->id;
            $testResult->pupil_id = $pupil->id;
            $testResult->term_id = $request->term;
            $testResult->subject_id = $subject['id'];
            $testResult->score = $subject['score'];
            $testResult->grade = $subject['grade'];
            $testResult->remark = $subject['remark'];

            // persist testResult
            $testResult->save();
        }

        return redirect()->route('primary-tests')->with('success','Test Result added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result\Primary\PrimaryTest  $test
     * @return \Illuminate\Http\Response
     */
    public function show(PrimaryTest $test)
    {
        if(Gate::allows('is-staff')){
            return view('results.primary.view-primary-test',[
                'test' => $test,
            ]);
        }else{
            return view('results.primary.parent-primary-test-view',[
                'test' => $test,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result\Primary\PrimaryTest  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(PrimaryTest $test)
    {
        $this->authorize('is-staff');
        $pupils = Pupil::whereIn('class', ['lower_primary', 'upper_primary'])->paginate();
        $terms = Term::all('id','name','session');
        $subjects = Subject::all('id','name');
        return view('results.primary.edit-primary-test', [
            'test'=>$test,
            'pupils'=>$pupils, 
            'terms'=>$terms, 
            'subjects'=>$subjects
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Result\Primary\UpdatePrimaryTestRequest  $request
     * @param  \App\Models\Result\Primary\PrimaryTest  $test
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrimaryTestRequest $request, PrimaryTest $test)
    {
        $this->authorize('is-staff');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'term' => ['required', 'integer', 'exists:terms,id'],
            'test_no' => ['required', 'integer', Rule::in([1,2,3,4])],
            'result.*.id' => ['nullable', 'integer', 'exists:primary_test_results,id'],
            'result.*.name' => ['nullable', 'string'],
            'result.*.score' => ['nullable', 'string'],
            'result.*.grade' => ['nullable', 'string', Rule::in(['A','B','C','D','E','F'])],
            'result.*.remark' => ['nullable', 'string', Rule::in(['excellent','very_good','good','fair','poor','fail'])],
        ]);
        $pupil = Pupil::find($request->pupil);
        
        // persist test update
        $test->update([
            'pupil_id' => $request->pupil,
            'term_id' => $request->term,
            'test_no' => $request->test_no,
        ]);
        foreach($request->result as $result){
            $testResult = PrimaryTestResult::find($result['id']);
            $testResult->primary_test_id = $test->id;
            $testResult->pupil_id = $pupil->id;
            $testResult->term_id = $request->term;
            $testResult->score = $result['score'];
            $testResult->grade = $result['grade'];
            $testResult->remark = $result['remark'];

            // persist testResult update
            $testResult->update();
        }

        return redirect()->route('primary-tests')->with('success','Test Result updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result\Primary\PrimaryTest  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrimaryTest $test)
    {
        $this->authorize('is-staff');
        $test->delete();
        return redirect()->route('primary-tests')->with('success','Test Result deleted successfully!');
    }
}
