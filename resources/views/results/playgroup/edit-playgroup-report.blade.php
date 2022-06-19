@extends('results.playgroup.base')
@section('title', 'Edit Playgroup Term Report')
@section('page-heading', 'Edit Playgroup Term Report')

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
        <form action="{{route('update-playgroup-report', $report->id)}}" method="POST">
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
                            <div class="row">
                                @foreach($report->playgroupSkillResults as $skill_result)
                                    @if($skill_result->skill_category->id == $category->id)
                                        <div class="col-md-4">
                                            <div class="deshboard_main_top_edit_area_single_item">
                                                <input class="form-control" type="number" id="{{$category->id}}" name="skill_result[{{$loop->index}}][category_id]" value='{{old("skill_result[{$loop->index}][category_id]", $category->id)}}' required hidden readonly aria-hidden="true" aria-readonly="true">
                                                <input class="form-control" type="number" id="{{$skill_result->id}}" name="skill_result[{{$loop->index}}][id]" value='{{old("skill_result[{$loop->index}][id]", $skill_result->id)}}' required hidden readonly aria-hidden="true" aria-readonly="true">
                                                {{-- <input class="form-control" type="text" id="{{$skill->name}}" name="skill[{{$loop->index}}][name]" value='{{old("skill[{$loop->index}][name]", $skill->name)}}' required readonly> --}}
                                                <div class="deshboard_main_top_edit_area_single_item">
                                                    <label for="{{$skill_result->skill->name}}-score">{{$skill_result->skill->name}}</label>
                                                    <select name="skill_result[{{$loop->index}}][score]" class="form-control" id="{{$skill_result->skill->name}}-score">
                                                        <option value="" {{old("skill_result[{$loop->index}][score]", $skill_result->score) == "" ? "selected" : "" }} hidden=""></option>
                                                        <option value=1 {{old("skill_result[{$loop->index}][score]", $skill_result->score) == 1 ? "selected" : "" }}>1</option>
                                                        <option value=2 {{old("skill_result[{$loop->index}][score]", $skill_result->score) == 2 ? "selected" : "" }}>2</option>
                                                        <option value=3 {{old("skill_result[{$loop->index}][score]", $skill_result->score) == 3 ? "selected" : "" }}>3</option>
                                                        <option value=4 {{old("skill_result[{$loop->index}][score]", $skill_result->score) == 4 ? "selected" : "" }}>4</option>
                                                        <option value=5 {{old("skill_result[{$loop->index}][score]", $skill_result->score) == 5 ? "selected" : "" }}>5</option>
                                                        <option value=6 {{old("skill_result[{$loop->index}][score]", $skill_result->score) == 6 ? "selected" : "" }}>6</option>
                                                        <option value=7 {{old("skill_result[{$loop->index}][score]", $skill_result->score) == 7 ? "selected" : "" }}>7</option>
                                                        <option value=8 {{old("skill_result[{$loop->index}][score]", $skill_result->score) == 8 ? "selected" : "" }}>8</option>
                                                        <option value=9 {{old("skill_result[{$loop->index}][score]", $skill_result->score) == 9 ? "selected" : "" }}>9</option>
                                                        <option value=10 {{old("skill_result[{$loop->index}][score]", $skill_result->score) == 10 ? "selected" : "" }}>10</option>
                                                    </select>                                
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div> 
                        </div> 
                    @endforeach
                    
                    <hr class="col-md-12 mb-3 mt-5">
                    <h5 class="col-md-12 text-blue mb-2">ATTENTION SKILLS</h5>
                    {{-- subject results --}}
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="">Subject</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="">Remarks</label>
                            </div>
                        </div>
                        {{-- ability to concentrate --}}
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" value="Comment here on ability to concentrate" required disabled>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" name="ability_to_concentrate" value="{{old("ability_to_concentrate", $report->ability_to_concentrate)}}" required>
                            </div>
                        </div>   
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" value="C.R.K" required disabled>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" id="crk" name="crk" value="{{old("crk", $report->crk)}}" required>
                            </div>
                        </div>   
                        {{-- Colouring & art --}}
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" value="Colouring $ Art" required disabled>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" name="colouring_art" value="{{old("colouring_art", $report->colouring_art)}}" required>
                            </div>
                        </div>  
                        {{-- Games --}}
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" value="Games" required disabled>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text"  name="games" value="{{old("games", $report->games)}}" required>
                            </div>
                        </div>   
                        {{-- Language --}}
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" value="Language development $ Vocabulary" required disabled>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" id="language_dev" name="language_dev" value="{{old("language_dev", $report->lang_dev_vocab)}}" required>
                            </div>
                        </div>   
                        {{-- number_work --}}
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" value="Number Work" required disabled>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" id="number_work" name="number_work" value="{{old("number_work", $report->number_work)}}" required>
                            </div>
                        </div>   
                        {{-- other_activities --}}
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" value="Other Activities" required disabled>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" name="other_activities" value="{{old("other_activities", $report->other_activities)}}" required>
                            </div>
                        </div>   
                        {{-- pencil --}}
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" value="Pencil play/Pencil activities" required disabled>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" id="pencil_work" name="pencil_work" value="{{old("pencil_work", $report->pencil_play_activities)}}" required>
                            </div>
                        </div>   
                        {{-- phonics --}}
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" value="Phonics" required disabled>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" id="phonics" name="phonics" value="{{old("phonics", $report->phonics)}}" required>
                            </div>
                        </div>   
                        {{-- phonics --}}
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" value="Project Work(General Knowledge)" required disabled>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" name="project_work" value="{{old("project_work", $report->project_work)}}" required>
                            </div>
                        </div>   
                    <hr class="col-md-12 mb-3 mt-5">
                    <h5 class="col-md-12 text-blue mb-2">AFFECTIVE AREAS SKILLS</h5>
                    {{-- Attitude to Work --}}
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <input class="form-control" type="text" value="Attitude to Work" required disabled>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <input class="form-control" type="text" name="attitude_to_work" value="{{old("attitude_to_work", $report->attitude_to_work)}}" required>
                        </div>
                    </div> 
                    {{-- Cleanliness --}}
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <input class="form-control" type="text" value="Cleanliness" required disabled>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <input class="form-control" type="text" name="cleanliness" value="{{old("cleanliness", $report->cleanliness)}}" required>
                        </div>
                    </div> 
                    {{-- Dress --}}
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <input class="form-control" type="text" value="Dress" required disabled>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <input class="form-control" type="text" name="dress" value="{{old("dress", $report->dress)}}" required>
                        </div>
                    </div> 
                    {{-- Hair --}}
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <input class="form-control" type="text" value="Hair" required disabled>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <input class="form-control" type="text" name="hair" value="{{old("hair", $report->hair)}}" required>
                        </div>
                    </div> 
                    {{-- Nails --}}
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <input class="form-control" type="text" value="Nails" required disabled>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <input class="form-control" type="text" name="nails" value="{{old("nails", $report->nails)}}" required>
                        </div>
                    </div> 
                    {{-- Neatness --}}
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <input class="form-control" type="text" value="Neatness" required disabled>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <input class="form-control" type="text" name="neatness" value="{{old("neatness", $report->neatness)}}" required>
                        </div>
                    </div> 
                    {{-- Punctuality --}}
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <input class="form-control" type="text" value="Punctuality" required disabled>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <input class="form-control" type="text" name="punctuality" value="{{old("punctuality", $report->punctuality)}}" required>
                        </div>
                    </div> 
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