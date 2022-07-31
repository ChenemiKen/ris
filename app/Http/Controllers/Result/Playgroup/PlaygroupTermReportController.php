<?php

namespace App\Http\Controllers\Result\Playgroup;
use App\Http\Controllers\Controller;

use App\Models\Result\Playgroup\PlaygroupTermReport;
use App\Models\Pupil;
use App\Models\Teacher;
use App\Models\Result\Term;
use App\Models\Result\Skill;
use App\Models\Result\SkillCategory;
use App\Models\Result\Playgroup\PlaygroupSkillResult;
use App\Http\Requests\Result\Playgroup\StorePlaygroupTermReportRequest;
use App\Http\Requests\Result\Playgroup\UpdatePlaygroupTermReportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PlaygroupTermReportController extends Controller
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
            return view('results.playgroup.playgroup-reports', [
                'reports' => PlaygroupTermReport::with('pupil','term')->where($filter)->paginate(session('per_page')),
                'terms' => $terms
            ]);
        }elseif(Gate::allows('is-parent')){
            $ward = Pupil::find(auth()->user()->pupil_parent->pupil->id);
            return view('results.playgroup.playgroup-reports', [
                'reports' => PlaygroupTermReport::with('pupil','term')->where('pupil_id', $ward->id)->where($filter)->paginate(session('per_page')),
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
        $filter = ['class'=>'playgroup'];
        $pupils = Pupil::where($filter)->paginate();
        $terms = Term::all('id','name','session');
        $skills = Skill::all('id','name','skill_category_id');
        $skillCategories = SkillCategory::all('id','name');
        return view('results.playgroup.add-playgroup-report', ['pupils'=>$pupils, 'terms'=>$terms, 'skills'=>$skills, 'skill_categories'=>$skillCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Result\Playgroup\StorePlaygroupTermReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlaygroupTermReportRequest $request)
    {
        $this->authorize('is-staff');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'term' => ['required', 'integer', 'exists:terms,id'],
            'cat.*.skill.*.category_id' => ['nullable', 'integer', 'exists:skill_categories,id'],
            'cat.*.skill.*.id' => ['nullable', 'integer', 'exists:skills,id'],
            'cat.*.skill.*.score' => ['nullable', 'string', Rule::in([1,2,3,4,5,6,7,8,9,10])],
            // attention skills
            "ability_to_concentrate" => ['nullable', 'string'],
            'crk' => ['nullable', 'string'],
            'colouring_art' => ['nullable', 'string'],
            'games' => ['nullable', 'string'],
            'language_dev' => ['nullable', 'string'],
            'number_work' => ['nullable', 'string'],
            'other_activities' => ['nullable', 'string'],
            'pencil_work' => ['nullable', 'string'],
            'phonics' => ['nullable', 'string'],
            'project_work' => ['nullable', 'string'],
            // AFFECTIVE AREAS SKILLS
            'attitude_to_work' => ['nullable', 'string'],
            'cleanliness' => ['nullable', 'string'],
            'dress' => ['nullable', 'string'],
            'hair' => ['nullable', 'string'],
            'nails' => ['nullable', 'string'],
            'neatness' => ['nullable', 'string'],
            'punctuality' => ['nullable', 'string'],
            //attendance
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
        $report = $pupil->playgroupTermReports()->create([
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
            // Attention skills
            'ability_to_concentrate'=>$request->ability_to_concentrate,
            'crk'=>$request->crk,
            'colouring_art'=>$request->colouring_art,
            'games'=>$request->games,
            'lang_dev_vocab'=>$request->language_dev,
            'number_work'=>$request->number_work,
            'other_activities'=>$request->other_activities,
            'pencil_play_activities'=>$request->pencil_work,
            'phonics'=>$request->phonics,
            'project_work'=>$request->project_work,
            // Affective area skills
            'attitude_to_work'=>$request->attitude_to_work,
            'cleanliness'=>$request->cleanliness,
            'dress'=>$request->dress,
            'hair'=>$request->hair,
            'nails'=>$request->nails,
            'neatness'=>$request->neatness,
            'punctuality'=>$request->punctuality,
            'date'=> Carbon::today(),
            'teacher_id'=> $class_teacher_id
        ]);

        if($request->cat){
            foreach($request->cat as $cat){
                foreach($cat as $cat_skill){
                    foreach($cat_skill as $skill){
                        $playgroupSkillResult = new PlaygroupSkillResult();
                        $playgroupSkillResult->playgroup_term_report_id = $report->id;
                        $playgroupSkillResult->pupil_id = $pupil->id;
                        $playgroupSkillResult->term_id = $request->term;
                        $playgroupSkillResult->skill_category_id = $skill['category_id'];
                        $playgroupSkillResult->skill_id = $skill['id'];
                        $playgroupSkillResult->score = $skill['score'];
    
                        // persist beaconSkillResult
                        $playgroupSkillResult->save();
                    }
                }
            }
        }
        
        return redirect()->route('playgroup-reports')->with('success','Term Report added successfully!');$this->authorize('is-staff');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result\Playgroup\PlaygroupTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function show(PlaygroupTermReport $report)
    {
        $skillCategories = SkillCategory::all('id','name');

        if(Gate::allows('is-staff')){
            return view('results.playgroup.view-playgroup-report',[
                'report' => $report,
                'skill_categories'=>$skillCategories,
            ]);
        }else{
            return view('results.playgroup.parent-playgroup-report-view',[
                'report' => $report,
                'skill_categories'=>$skillCategories,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result\Playgroup\PlaygroupTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(PlaygroupTermReport $report)
    {
        $this->authorize('is-staff');
        $filter = ['class'=>'playgroup'];
        $pupils = Pupil::where($filter)->paginate();
        $terms = Term::all('id','name','session');
        $skillCategories = SkillCategory::all('id','name');
        return view('results.playgroup.edit-playgroup-report', [
            'report'=>$report,
            'pupils'=>$pupils, 
            'terms'=>$terms, 
            'skill_categories'=>$skillCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Result\Playgroup\UpdatePlaygroupTermReportRequest  $request
     * @param  \App\Models\Result\Playgroup\PlaygroupTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlaygroupTermReportRequest $request, PlaygroupTermReport $report)
    {
        $this->authorize('is-staff');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'term' => ['required', 'integer', 'exists:terms,id'],
            'skill_result.*.category_id' => ['nullable', 'integer', 'exists:skill_categories,id'],
            'skill_result.*.id' => ['nullable', 'integer', 'exists:playgroup_skill_results,id'],
            'skill_result.*.score' => ['nullable', 'string', Rule::in([1,2,3,4,5,6,7,8,9,10])],
            // attention skills
            "ability_to_concentrate" => ['nullable', 'string'],
            'crk' => ['nullable', 'string'],
            'colouring_art' => ['nullable', 'string'],
            'games' => ['nullable', 'string'],
            'language_dev' => ['nullable', 'string'],
            'number_work' => ['nullable', 'string'],
            'other_activities' => ['nullable', 'string'],
            'pencil_work' => ['nullable', 'string'],
            'phonics' => ['nullable', 'string'],
            'project_work' => ['nullable', 'string'],
            // AFFECTIVE AREAS SKILLS
            'attitude_to_work' => ['nullable', 'string'],
            'cleanliness' => ['nullable', 'string'],
            'dress' => ['nullable', 'string'],
            'hair' => ['nullable', 'string'],
            'nails' => ['nullable', 'string'],
            'neatness' => ['nullable', 'string'],
            'punctuality' => ['nullable', 'string'],
            //attendance
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
        $report ->update([
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
            // Attention skills
            'ability_to_concentrate'=>$request->ability_to_concentrate,
            'crk'=>$request->crk,
            'colouring_art'=>$request->colouring_art,
            'games'=>$request->games,
            'lang_dev_vocab'=>$request->language_dev,
            'number_work'=>$request->number_work,
            'other_activities'=>$request->other_activities,
            'pencil_play_activities'=>$request->pencil_work,
            'phonics'=>$request->phonics,
            'project_work'=>$request->project_work,
            // Affective area skills
            'attitude_to_work'=>$request->attitude_to_work,
            'cleanliness'=>$request->cleanliness,
            'dress'=>$request->dress,
            'hair'=>$request->hair,
            'nails'=>$request->nails,
            'neatness'=>$request->neatness,
            'punctuality'=>$request->punctuality,
        ]);

        if($request->skill_result){
            foreach($request->skill_result as $skill_result){
                $playgroupSkillResult = PlaygroupSkillResult::find($skill_result['id']);
                $playgroupSkillResult->playgroup_term_report_id = $report->id;
                $playgroupSkillResult->pupil_id = $pupil->id;
                $playgroupSkillResult->term_id = $request->term;
                $playgroupSkillResult->skill_category_id = $skill_result['category_id'];
                $playgroupSkillResult->score = $skill_result['score'];
    
                // persist beaconSkillResult
                $playgroupSkillResult->update();
            }
        }

        return redirect()->route('playgroup-reports')->with('success','Term Report updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result\Playgroup\PlaygroupTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlaygroupTermReport $report)
    {
        $this->authorize('is-staff');
        $report->delete();
        return redirect()->route('playgroup-reports')->with('success','Term report deleted successfully!');
    }

        /**
    * Download the specified report as PDF.
    *
    * @param  \App\Models\Playgroup\PlaygroupTermReport  $report
    * @return \Illuminate\Http\Response
    */
    public function downloadPDF(PlaygroupTermReport $report)
    {
        $skillCategories = SkillCategory::all('id','name');
        
        $pdf = Pdf::loadView('results.playgroup.pdf.report', [
            'report' => $report,
            'skill_categories'=>$skillCategories
        ]);
        return $pdf->download();
    }
}
