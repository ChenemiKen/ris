<?php

namespace App\Http\Controllers\Result\Beacon;
use App\Http\Controllers\Controller;

use App\Models\Result\Beacon\BeaconTermReport;
use App\Models\Pupil;
use App\Models\Result\Term;
use App\Models\Result\Skill;
use App\Models\Result\SkillCategory;
use App\Http\Requests\Result\Beacon\StoreBeaconTermReportRequest;
use App\Http\Requests\Result\Beacon\UpdateBeaconTermReportRequest;
use App\Models\Result\Beacon\BeaconSkillResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

use function Psy\debug;

class BeaconTermReportController extends Controller
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
            return view('results.beacon.beacon-reports', [
                'reports' => BeaconTermReport::with('pupil','term')->where($filter)->paginate(session('per_page')),
                'terms' => $terms
            ]);
        }elseif(Gate::allows('is-parent')){
            $ward = Pupil::find(auth()->user()->pupil_parent->pupil->id);
            return view('results.beacon.beacon-reports', [
                'reports' => BeaconTermReport::with('pupil','term')->where('pupil_id', $ward->id)->where($filter)->paginate(session('per_page')),
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
        $filter = ['class'=>'beacon'];
        $pupils = Pupil::where($filter)->paginate();
        $terms = Term::all('id','name','session');
        $skills = Skill::all('id','name','skill_category_id');
        $skillCategories = SkillCategory::all('id','name');
        return view('results.beacon.add-beacon-report', ['pupils'=>$pupils, 'terms'=>$terms, 'skills'=>$skills, 'skill_categories'=>$skillCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Result\Beacon\StoreBeaconTermReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBeaconTermReportRequest $request)
    {
        $this->authorize('is-staff');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'term' => ['required', 'integer', 'exists:terms,id'],
            'cat.*.skill.*.category_id' => ['required', 'integer', 'exists:skill_categories,id'],
            'cat.*.skill.*.id' => ['required', 'integer', 'exists:skills,id'],
            'cat.*.skill.*.score' => ['required', 'string', Rule::in([1,2,3,4,5,6,7,8,9,10])],
            // attention skills
            "ability_to_concentrate" => ['required', 'string'],
            'crk' => ['required', 'string'],
            'colouring_art' => ['required', 'string'],
            'games' => ['required', 'string'],
            'language_dev' => ['required', 'string'],
            'number_work' => ['required', 'string'],
            'other_activities' => ['required', 'string'],
            'pencil_work' => ['required', 'string'],
            'phonics' => ['required', 'string'],
            'project_work' => ['required', 'string'],
            // AFFECTIVE AREAS SKILLS
            'attitude_to_work' => ['required', 'string'],
            'cleanliness' => ['required', 'string'],
            'dress' => ['required', 'string'],
            'hair' => ['required', 'string'],
            'nails' => ['required', 'string'],
            'neatness' => ['required', 'string'],
            'punctuality' => ['required', 'string'],
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
        $report = $pupil->beaconTermReports()->create([
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
        foreach($request->cat as $cat){
            foreach($cat as $cat_skill){
                foreach($cat_skill as $skill){
                    $beaconSkillResult = new BeaconSkillResult();
                    $beaconSkillResult->beacon_term_report_id = $report->id;
                    $beaconSkillResult->pupil_id = $pupil->id;
                    $beaconSkillResult->term_id = $request->term;
                    $beaconSkillResult->skill_category_id = $skill['category_id'];
                    $beaconSkillResult->skill_id = $skill['id'];
                    $beaconSkillResult->score = $skill['score'];
        
                    // persist beaconSkillResult
                    $beaconSkillResult->save();
                }
            }
        }
        

        return redirect()->route('beacon-reports')->with('success','Term Report added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result\Beacon\BeaconTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function show(BeaconTermReport $report)
    {
        $skillCategories = SkillCategory::all('id','name');

        if(Gate::allows('is-staff')){
            return view('results.beacon.view-beacon-report',[
                'report' => $report,
                'skill_categories'=>$skillCategories,
            ]);
        }else{
            return view('results.beacon.beacon-report-parent-view',[
                'report' => $report,
                'skill_categories'=>$skillCategories,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result\Beacon\BeaconTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(BeaconTermReport $report)
    {
        $this->authorize('is-staff');
        $filter = ['class'=>'beacon'];
        $pupils = Pupil::where($filter)->paginate();
        $terms = Term::all('id','name','session');
        $skillCategories = SkillCategory::all('id','name');
        return view('results.beacon.edit-beacon-report', [
            'report'=>$report,
            'pupils'=>$pupils, 
            'terms'=>$terms, 
            'skill_categories'=>$skillCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Result\Beacon\UpdateBeaconTermReportRequest  $request
     * @param  \App\Models\Result\Beacon\BeaconTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBeaconTermReportRequest $request, BeaconTermReport $report)
    {
        $this->authorize('is-staff');
        $request->validate([
            'pupil' => ['required', 'integer', 'exists:pupils,id'],
            'term' => ['required', 'integer', 'exists:terms,id'],
            'skill_result.*.category_id' => ['required', 'integer', 'exists:skill_categories,id'],
            'skill_result.*.id' => ['required', 'integer', 'exists:beacon_skill_results,id'],
            'skill_result.*.score' => ['required', 'string', Rule::in([1,2,3,4,5,6,7,8,9,10])],
            // attention skills
            "ability_to_concentrate" => ['required', 'string'],
            'crk' => ['required', 'string'],
            'colouring_art' => ['required', 'string'],
            'games' => ['required', 'string'],
            'language_dev' => ['required', 'string'],
            'number_work' => ['required', 'string'],
            'other_activities' => ['required', 'string'],
            'pencil_work' => ['required', 'string'],
            'phonics' => ['required', 'string'],
            'project_work' => ['required', 'string'],
            // AFFECTIVE AREAS SKILLS
            'attitude_to_work' => ['required', 'string'],
            'cleanliness' => ['required', 'string'],
            'dress' => ['required', 'string'],
            'hair' => ['required', 'string'],
            'nails' => ['required', 'string'],
            'neatness' => ['required', 'string'],
            'punctuality' => ['required', 'string'],
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
        foreach($request->skill_result as $skill_result){
            $beaconSkillResult = BeaconSkillResult::find($skill_result['id']);
            $beaconSkillResult->beacon_term_report_id = $report->id;
            $beaconSkillResult->pupil_id = $pupil->id;
            $beaconSkillResult->term_id = $request->term;
            $beaconSkillResult->skill_category_id = $skill_result['category_id'];
            $beaconSkillResult->skill_id = $skill_result['id'];
            $beaconSkillResult->score = $skill_result['score'];

            // persist beaconSkillResult
            $beaconSkillResult->update();
        }

        return redirect()->route('beacon-reports')->with('success','Term Report updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result\Beacon\BeaconTermReport  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(BeaconTermReport $report)
    {
        $this->authorize('is-staff');
        $report->delete();
        return redirect()->route('beacon-reports')->with('success','Term report deleted successfully!');
    }
}
