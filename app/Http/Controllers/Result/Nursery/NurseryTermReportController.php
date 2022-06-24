<?php

namespace App\Http\Controllers\Result\Nursery;
use App\Http\Controllers\Controller;

use App\Models\Result\Nursery\NurseryTermReport;
use App\Models\Result\Nursery\NurserySubjectResult;
use App\Models\Result\Nursery\NurserySkillResult;
use App\Models\Pupil;
use App\Models\Teacher;
use App\Models\Result\Term;
use App\Models\Result\Subject;
use App\Models\Result\Skill;
use App\Models\Result\SkillCategory;
use App\Http\Requests\Result\Nursery\StoreNurseryTermReportRequest;
use App\Http\Requests\Result\Nursery\UpdateNurseryTermReportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class NurseryTermReportController extends Controller
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

        if(Gate::allows('is-staff')){
            return view('results.nursery.nursery-reports', [
                'reports' => NurseryTermReport::with('pupil','term')->where($filter)->paginate(session('per_page')),
                'terms' => $terms
            ]);
        }elseif(Gate::allows('is-parent')){
            $ward = Pupil::find(auth()->user()->pupil_parent->pupil->id);
            return view('results.nursery.nursery-reports', [
                'reports' => NurseryTermReport::with('pupil','term')->where('pupil_id', $ward->id)->where($filter)->paginate(session('per_page')),
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
        $filter = ['class'=>'nursery'];
        $pupils = Pupil::where($filter)->paginate();
        $terms = Term::all('id','name','session');
        $subjects = Subject::all('id','name');
        $skills = Skill::all('id','name','skill_category_id');
        $skillCategories = SkillCategory::all('id','name');
        return view('results.nursery.add-nursery-report', ['pupils'=>$pupils, 'terms'=>$terms, 'subjects'=>$subjects, 'skills'=>$skills, 'skill_categories'=>$skillCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Result\Nursery\StoreNurseryTermReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNurseryTermReportRequest $request)
    {
        $this->authorize('is-staff');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'term' => ['required', 'integer', 'exists:terms,id'],
            'cat.*.skill.*.category_id' => ['nullable', 'integer', 'exists:skill_categories,id'],
            'cat.*.skill.*.id' => ['nullable', 'integer', 'exists:skills,id'],
            'cat.*.skill.*.name' => ['nullable', 'string'],
            'cat.*.skill.*.grade' => ['nullable', 'string', Rule::in(['A+','A','B+','B','C+','C','S.A','N.A'])],
            'cat.*.skill.*.effort_grade' => ['nullable', 'string', Rule::in(['A+','A','B+','B','C+','C','S.A','N.A'])],
            'subject.*.id' => ['nullable', 'integer', 'exists:subjects,id'],
            'subject.*.name' => ['nullable', 'string'],
            'subject.*.score' => ['nullable', 'integer'],
            'subject.*.remarks' => ['nullable', 'string'],
            'times_school_opened' => ['nullable','integer'],
            'times_present' => [ 'nullable','integer'],
            'times_absent' => ['nullable','integer'],
            'height_start' => [ 'nullable','integer'],
            'height_end' => [ 'nullable','integer'],
            'weight_start' => [ 'nullable','integer'],
            'weight_end' => [ 'nullable','integer'],
            'personal_note'=> [ 'nullable','string'],
            'teacher_remark'=> [ 'nullable','string'],
            'head_remark'=> [ 'nullable','string'],
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

        // persist report
        $report = $pupil->nurseryTermReports()->create([
            'term_id' => $request->term,
            // attendance
            'times_school_opened'=>$request->times_school_opened,
            'times_present'=>$request->times_present,
            'times_absent'=>$request->times_absent,
            // physical development
            'height_start'=>$request->height_start,
            'height_end'=>$request->height_end,
            'weight_start'=>$request->weight_start,
            'weight_end'=>$request->weight_end,
            'personal_note'=>$request->personal_note,
            'teacher_remark'=>$request->teacher_remark,
            'head_remark'=>$request->head_remark,
            'date'=> Carbon::today(),
            'teacher_id'=> $class_teacher_id
        ]);
        foreach($request->cat as $cat){
            foreach($cat as $cat_skill){
                foreach($cat_skill as $skill){
                    switch($skill['grade']){
                        case 'A+':
                            $remarks = 'Exceptional';
                            break;
                        case 'A':
                            $remarks = 'Excellent';
                            break;
                        case 'B+':
                            $remarks = 'Very_good';
                            break;
                        case 'B':
                            $remarks = 'Good';
                            break;
                        case 'C+':
                            $remarks = 'Satisfactory';
                            break;
                        case 'C':
                            $remarks = 'Room_for_Improvement';
                            break;
                        case 'S.A':
                            $remarks = 'Special_Attention';
                            break;
                        case 'N.A':
                            $remarks = 'Not_Applicable';
                            break;
                        default:
                            $remarks = '';
                            break;
                    }
                    $nurserySkillResult = new NurserySkillResult();
                    $nurserySkillResult->nursery_term_report_id = $report->id;
                    $nurserySkillResult->pupil_id = $pupil->id;
                    $nurserySkillResult->term_id = $request->term;
                    $nurserySkillResult->skill_category_id = $skill['category_id'];
                    $nurserySkillResult->skill_id = $skill['id'];
                    $nurserySkillResult->grade = $skill['grade'];
                    $nurserySkillResult->effort_grade = $skill['effort_grade'];
                    $nurserySkillResult->remark = $remarks;

                    // persist testResult
                    $nurserySkillResult->save();
                }
            }
        }
        
        foreach($request->subject as $subject){
            $nurserySubjectResult = new NurserySubjectResult();
            $nurserySubjectResult->nursery_term_report_id = $report->id;
            $nurserySubjectResult->pupil_id = $pupil->id;
            $nurserySubjectResult->term_id = $request->term;
            $nurserySubjectResult->subject_id = $subject['id'];
            $nurserySubjectResult->score = $subject['score'];
            $nurserySubjectResult->remark = $subject['remarks'];

            // persist testResult
            $nurserySubjectResult->save();
        }

        return redirect()->route('nursery-reports')->with('success','Term Report added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result\Nursery\NurseryTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function show(NurseryTermReport $report)
    {
        $skillCategories = SkillCategory::all('id','name');

        if(Gate::allows('is-staff')){
            return view('results.nursery.view-nursery-report',[
                'report' => $report,
                'skill_categories'=>$skillCategories,
            ]);
        }else{
            return view('results.nursery.nursery-report-parent-view',[
                'report' => $report,
                'skill_categories'=>$skillCategories,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result\Nursery\NurseryTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(NurseryTermReport $report)
    {
        $this->authorize('is-staff');
        $filter = ['class'=>'nursery'];
        $pupils = Pupil::where($filter)->paginate();
        $terms = Term::all('id','name','session');
        $subjects = Subject::all('id','name');
        $skillCategories = SkillCategory::all('id','name');
        return view('results.nursery.edit-nursery-report', [
            'report'=>$report,
            'pupils'=>$pupils, 
            'terms'=>$terms, 
            'subjects'=>$subjects,
            'skill_categories'=>$skillCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Result\Nursery\UpdateNurseryTermReportRequest  $request
     * @param  \App\Models\Result\Nursery\NurseryTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNurseryTermReportRequest $request, NurseryTermReport $report)
    {
        $this->authorize('is-staff');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'term' => ['required', 'integer', 'exists:terms,id'],
            'skill_result.*.category_id' => ['nullable', 'integer', 'exists:skill_categories,id'],
            'skill_result.*.id' => ['nullable', 'integer', 'exists:nursery_skill_results,id'],
            'skill_result.*.name' => ['nullable', 'string'],
            'skill_result.*.grade' => ['nullable', 'string', Rule::in(['A+','A','B+','B','C+','C','S.A','N.A'])],
            'skill_result.*.effort_grade' => ['nullable', 'string', Rule::in(['A+','A','B+','B','C+','C','S.A','N.A'])],
            'subject_result.*.id' => ['nullable', 'integer', 'exists:nursery_subject_results,id'],
            'subject_result.*.name' => ['nullable', 'string'],
            'subject_result.*.score' => ['nullable', 'integer'],
            'subject_result.*.remarks' => ['nullable', 'string'],
            'times_school_opened' => ['nullable','integer'],
            'times_present' => [ 'nullable','integer'],
            'times_absent' => ['nullable','integer'],
            'height_start' => [ 'nullable','integer'],
            'height_end' => [ 'nullable','integer'],
            'weight_start' => [ 'nullable','integer'],
            'weight_end' => [ 'nullable','integer'],
            'personal_note'=> [ 'nullable','string'],
            'teacher_remark'=> [ 'nullable','string'],
            'head_remark'=> [ 'nullable','string'],
        ]);
        $pupil = Pupil::find($request->pupil);

        // persist report
        $report->update([
            'pupil_id' => $request->pupil,
            'term_id' => $request->term,
            // attendance
            'times_school_opened'=>$request->times_school_opened,
            'times_present'=>$request->times_present,
            'times_absent'=>$request->times_absent,
            // physical development
            'height_start'=>$request->height_start,
            'height_end'=>$request->height_end,
            'weight_start'=>$request->weight_start,
            'weight_end'=>$request->weight_end,
            'personal_note'=>$request->personal_note,
            'teacher_remark'=>$request->teacher_remark,
            'head_remark'=>$request->head_remark,
        ]);
        foreach($request->skill_result as $skill_result){
            $nurserySkillResult = NurserySkillResult::find($skill_result['id']);
            switch($skill_result['grade']){
                case 'A+':
                    $remarks = 'Exceptional';
                    break;
                case 'A':
                    $remarks = 'Excellent';
                    break;
                case 'B+':
                    $remarks = 'Very_good';
                    break;
                case 'B':
                    $remarks = 'Good';
                    break;
                case 'C+':
                    $remarks = 'Satisfactory';
                    break;
                case 'C':
                    $remarks = 'Room_for_Improvement';
                    break;
                case 'S.A':
                    $remarks = 'Special_Attention';
                    break;
                case 'N.A':
                    $remarks = 'Not_Applicable';
                    break;
                default:
                    $remarks = '';
                    break;
            }

            $nurserySkillResult->nursery_term_report_id = $report->id;
            $nurserySkillResult->pupil_id = $pupil->id;
            $nurserySkillResult->term_id = $request->term;
            $nurserySkillResult->skill_category_id = $skill_result['category_id'];
            // $nurserySkillResult->skill_id = $skill_result['id'];
            $nurserySkillResult->grade = $skill_result['grade'];
            $nurserySkillResult->effort_grade = $skill_result['effort_grade'];
            $nurserySkillResult->remark = $remarks;

            // update term Result
            $nurserySkillResult->update();
        }
        
        foreach($request->subject_result as $subject_result){
            $nurserySubjectResult = NurserySubjectResult::find($subject_result['id']);
            $nurserySubjectResult->nursery_term_report_id = $report->id;
            $nurserySubjectResult->pupil_id = $pupil->id;
            $nurserySubjectResult->term_id = $request->term;
            // $nurserySubjectResult->subject->id = $subject_result['id'];
            $nurserySubjectResult->score = $subject_result['score'];
            $nurserySubjectResult->remark = $subject_result['remarks'];

            // persist testResult
            $nurserySubjectResult->update();
        }

        return redirect()->route('nursery-reports')->with('success','Term Report updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result\Nursery\NurseryTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(NurseryTermReport $report)
    {
        $this->authorize('is-staff');
        $report->delete();
        return redirect()->route('nursery-reports')->with('success','Term report deleted successfully!');
    }
}
