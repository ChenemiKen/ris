@extends('results.nursery.base')
@section('title', 'Edit Nursery Term Report')
@section('page-heading', 'Edit Nursery Term Report')

@section('page-content')
    <div class="deshboard_main_edit_create_page_area">
        @if ($errors->any())
            <div >
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- form --}}
        <form action="{{route('update-nursery-report', $report->id)}}" method="POST">
            @csrf
            <div class="deshboard_main_top_edit_area">
                {{-- pupil details --}}
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="pupil">Pupil</label>
                            <select name="pupil" class="form-control" id="pupil">
                                <option value="" {{ old('pupil') == "" ? "selected" : "" }} hidden=""></option>
                                @foreach($pupils as $pupil)
                                    <option value={{$pupil->id}} {{ old('pupil', $report->pupil_id) == $pupil->id ? "selected" : "" }}>{{$pupil->firstname}} {{$pupil->lastname}}</option>
                                @endforeach                           
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="term">Term</label>
                            <select name="term" class="form-control" id="term">
                                <option value="" {{ old('term') == "" ? "selected" : "" }} hidden=""></option>
                                @foreach($terms as $term)
                                    <option value={{$term->id}} {{ old('term', $report->term_id) == $term->id ? "selected" : "" }}>{{$term->name}} {{$term->session}}</option>
                                @endforeach                           
                            </select>
                        </div>
                    </div>
                
                    {{-- skills results --}}
                    @foreach($skill_categories as $category)
                        <div class="col-md-12">
                            <hr class="mb-3 mt-5">
                            <h5 class="text-blue mb-5 col-md-12">{{$category->name}}</h5>
                            @foreach($report->nurserySkillResults as $skill_result)
                                @if($skill_result->skill_category->id == $category->id)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="deshboard_main_top_edit_area_single_item">
                                                <input class="form-control" type="number" id="{{$category->id}}" name="skill_result[{{$loop->index}}][category_id]" value='{{old("skill_result[{$loop->index}][category_id]", $category->id)}}' required hidden readonly aria-hidden="true" aria-readonly="true">
                                                <input class="form-control" type="number" id="{{$skill_result->id}}" name="skill_result[{{$loop->index}}][id]" value='{{old("skill_result[{$loop->index}][id]", $skill_result->id)}}' required hidden readonly aria-hidden="true" aria-readonly="true">
                                                <label for="{{$skill_result->skill->name}}">&nbsp;</label>
                                                <input class="form-control" type="text" id="{{$skill_result->skill->name}}" name="skill_result[{{$loop->index}}][name]" value='{{old("skill_result[{$loop->index}][name]", $skill_result->skill->name)}}' required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="deshboard_main_top_edit_area_single_item">
                                                <label for="{{$skill_result->skill->name}}-grade">Grade</label>
                                                <select name="skill_result[{{$loop->index}}][grade]" class="form-control" id="{{$skill_result->skill->name}}-grade">
                                                    <option value="" {{old("skill_result[{$loop->index}][grade]", $skill_result->grade) == "" ? "selected" : "" }} hidden=""></option>
                                                    <option value=A+ {{old("skill_result[{$loop->index}][grade]", $skill_result->grade) == 'A+' ? "selected" : "" }}>A+</option>
                                                    <option value=A {{old("skill_result[{$loop->index}][grade]", $skill_result->grade) == 'A' ? "selected" : "" }}>A</option>
                                                    <option value=B+ {{old("skill_result[{$loop->index}][grade]", $skill_result->grade) == 'B+' ? "selected" : "" }}>B+</option>
                                                    <option value=B {{old("skill_result[{$loop->index}][grade]", $skill_result->grade) == 'B' ? "selected" : "" }}>B</option>
                                                    <option value=C+ {{old("skill_result[{$loop->index}][grade]", $skill_result->grade) == 'C+' ? "selected" : "" }}>C+</option>
                                                    <option value=C {{old("skill_result[{$loop->index}][grade]", $skill_result->grade) == 'C' ? "selected" : "" }}>C</option>
                                                    <option value=N.A {{old("skill_result[{$loop->index}][grade]", $skill_result->grade) == 'N.A' ? "selected" : "" }}>N.A</option>
                                                    <option value=S.A {{old("skill_result[{$loop->index}][grade]", $skill_result->grade) == 'S.A' ? "selected" : "" }}>S.A</option>
                                                </select>                                
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="deshboard_main_top_edit_area_single_item">
                                                <label for="{{$skill_result->skill->name}}-effort_grade" style="white-space:nowrap;"><small>Effort Grade</small></label>
                                                <select name="skill_result[{{$loop->index}}][effort_grade]" class="form-control" id="{{$skill_result->skill->name}}-effort_grade">
                                                    <option value=A+ {{old("skill_result[{$loop->index}][effort_grade]", $skill_result->effort_grade) == 'A+' ? "selected" : "" }}>A+</option>
                                                    <option value="" {{old("skill_result[{$loop->index}][effort_grade]", $skill_result->effort_grade) == "" ? "selected" : "" }} hidden=""></option>
                                                    <option value=A {{old("skill_result[{$loop->index}][effort_grade]", $skill_result->effort_grade) == 'A' ? "selected" : "" }}>A</option>
                                                    <option value=B+ {{old("skill_result[{$loop->index}][effort_grade]", $skill_result->effort_grade) == 'B+' ? "selected" : "" }}>B+</option>
                                                    <option value=B {{old("skill_result[{$loop->index}][effort_grade]", $skill_result->effort_grade) == 'B' ? "selected" : "" }}>B</option>
                                                    <option value=C+ {{old("skill_result[{$loop->index}][effort_grade]", $skill_result->effort_grade) == 'C+' ? "selected" : "" }}>C+</option>
                                                    <option value=C {{old("skill_result[{$loop->index}][effort_grade]", $skill_result->effort_grade) == 'C' ? "selected" : "" }}>C</option>
                                                    <option value=S.A {{old("skill_result[{$loop->index}][effort_grade]", $skill_result->effort_grade) == 'S.A' ? "selected" : "" }}>S.A</option>
                                                    <option value=N.A {{old("skill_result[{$loop->index}][effort_grade]", $skill_result->effort_grade) == 'N.A' ? "selected" : "" }}>N.A</option>
                                                </select>                                
                                            </div>
                                        </div>
                                    </div> 
                                @endif
                            @endforeach
                        </div> 
                    @endforeach
                    
                    <hr class="col-md-12 mb-3 mt-5">
                    {{-- subject results --}}
                    @foreach($report->nurserySubjectResults as $subject_result)
                        <div class="col-md-2">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="number" id="{{$subject_result->id}}" name="subject_result[{{$loop->index}}][id]" value='{{old("subject_result[{$loop->index}][id]", $subject_result->id)}}' required hidden readonly aria-hidden="true" aria-readonly="true">
                                <label for="{{$subject_result->subject->name}}">Subject</label>
                                <input class="form-control" type="text" id="{{$subject_result->subject->name}}" name="subject_result[{{$loop->index}}][name]" value='{{old("subject_result[{$loop->index}][name]", $subject_result->subject->name)}}' required readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$subject_result->subject->name}}-score">Score</label>
                                <input class="form-control" type="number" id="{{$subject_result->subject->name}}-score" name="subject_result[{{$loop->index}}][score]" value="{{old("subject_result[{$loop->index}][score]", $subject_result->score)}}" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$subject_result->subject->name}}-remarks">Remarks</label>  
                                <input class="form-control" type="text" id="{{$subject_result->subject->name}}-remarks" name="subject_result[{{$loop->index}}][remarks]" value="{{old("subject_result[{$loop->index}][remarks]", $subject_result->remark)}}" required>
                            </div>
                        </div>   
                    @endforeach
                </div>
                <hr class="mb-3 mt-5">
                <h5 class="text-blue mb-5">ATTENDANCE</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="times_school_opened">No. of Times School Opened</label>
                            <input class="form-control" type="number" id="times_school_opened" name="times_school_opened" value="{{old("times_school_opened", $report->times_school_opened)}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="times_present">No. of Times Present</label>
                            <input class="form-control" type="number" id="times_present" name="times_present" value="{{old("times_present", $report->times_present)}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="times_absent">No. of Times Absent</label>
                            <input class="form-control" type="number" id="times_absent" name="times_absent" value="{{old("times_absent", $report->times_absent)}}">
                        </div>
                    </div>
                </div>
                <hr class="mb-3 mt-5">
                <h5 class="text-blue mb-5">PHYSICAL DEVELOPMENT</h5>
                <div class="row">
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="height_start">Height(Begining of term)(cm)</label>
                            <input class="form-control" type="number" id="height_start" name="height_start" value="{{old("height_start", $report->height_start)}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="height_end">Height(End of term)(cm)</label>
                            <input class="form-control" type="number" id="height_end" name="height_end" value="{{old("height_end", $report->height_end)}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="weight_start">Weight(Begining of term)(kg)</label>
                            <input class="form-control" type="number" id="weight_start" name="weight_start" value="{{old("weight_start", $report->weight_start)}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="weight_end">Weight(end of term)(kg)</label>
                            <input class="form-control" type="number" id="weight_end" name="weight_end" value="{{old("weight_end", $report->weight_end)}}">
                        </div>
                    </div>
                </div>
                <hr class="mb-3 mt-5">
                <h5 class="text-blue mb-5">PERSONAL NOTE</h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="deshboard_main_top_edit_area_single_item">
                            {{-- <label for="teacher_remark">Class Teacher's Remark</label> --}}
                            <textarea class="form-control" rows="10" id="personal_note" name="personal_note">{{old("personal_note", $report->personal_note)}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="teacher_remark">Class Teacher's Remark</label>
                            <textarea class="form-control" rows="10" id="teacher_remark" name="teacher_remark">{{old("teacher_remark", $report->teacher_remark)}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="head_remark">Head of School's Remark</label>
                            <textarea class="form-control" rows="10" id="head_remark" name="head_remark">{{old("head_remark", $report->head_remark)}}</textarea>
                        </div>
                    </div>
                </div>
                {{-- submit button --}}
                <div class="col-md-12 mt-5">
                    <div class="deshboard_single_item_editor_btn_area">
                        <input type="submit" value="Update Report" name="edit-btn-area">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection