@extends('results.playgroup.base')
@section('title', 'Add Playgroup Term Report')
@section('page-heading', 'Add Playgroup Term Report')

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
        <form action="{{route('create-playgroup-report')}}" method="POST">
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
                                    <option value={{$pupil->id}} {{ old('pupil') == $pupil->id ? "selected" : "" }}>{{$pupil->firstname}} {{$pupil->lastname}}</option>
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
                                    <option value={{$term->id}} {{ old('term') == $term->id ? "selected" : "" }}>{{$term->name}} {{$term->session}}</option>
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
                                @foreach($category->skills as $skill)
                                    <div class="col-md-4">
                                        <div class="deshboard_main_top_edit_area_single_item">
                                            <input class="form-control" type="number" id="{{$category->id}}" name="cat[{{$category->id}}][skill][{{$loop->index}}][category_id]" value='{{old("cat[{$category->id}][skill][{$loop->index}][category_id]", $category->id)}}' required hidden readonly aria-hidden="true" aria-readonly="true">
                                            <input class="form-control" type="number" id="{{$skill->id}}" name="cat[{{$category->id}}][skill][{{$loop->index}}][id]" value='{{old("cat[{$category->id}][skill][{$loop->index}][id]", $skill->id)}}' required hidden readonly aria-hidden="true" aria-readonly="true">
                                            {{-- <input class="form-control" type="text" id="{{$skill->name}}" name="skill[{{$loop->index}}][name]" value='{{old("skill[{$loop->index}][name]", $skill->name)}}' required readonly> --}}
                                            <div class="deshboard_main_top_edit_area_single_item">
                                                <label for="{{$skill->name}}-score">{{$skill->name}}</label>
                                                <select name="cat[{{$category->id}}][skill][{{$loop->index}}][score]" class="form-control" id="{{$skill->name}}-score">
                                                    <option value="" {{old("cat[{$category->id}][skill][{$loop->index}][score]") == "" ? "selected" : "" }} hidden=""></option>
                                                    <option value=1 {{old("cat[{$category->id}][skill][{$loop->index}][score]") == 1 ? "selected" : "" }}>1</option>
                                                    <option value=2 {{old("cat[{$category->id}][skill][{$loop->index}][score]") == 2 ? "selected" : "" }}>2</option>
                                                    <option value=3 {{old("cat[{$category->id}][skill][{$loop->index}][score]") == 3 ? "selected" : "" }}>3</option>
                                                    <option value=4 {{old("cat[{$category->id}][skill][{$loop->index}][score]") == 4 ? "selected" : "" }}>4</option>
                                                    <option value=6 {{old("cat[{$category->id}][skill][{$loop->index}][score]") == 6 ? "selected" : "" }}>6</option>
                                                    <option value=5 {{old("cat[{$category->id}][skill][{$loop->index}][score]") == 5 ? "selected" : "" }}>5</option>
                                                    <option value=7 {{old("cat[{$category->id}][skill][{$loop->index}][score]") == 7 ? "selected" : "" }}>7</option>
                                                    <option value=8 {{old("cat[{$category->id}][skill][{$loop->index}][score]") == 8 ? "selected" : "" }}>8</option>
                                                    <option value=9 {{old("cat[{$category->id}][skill][{$loop->index}][score]") == 9 ? "selected" : "" }}>9</option>
                                                    <option value=10 {{old("cat[{$category->id}][skill][{$loop->index}][score]") == 10 ? "selected" : "" }}>10</option>
                                                </select>                                
                                            </div>
                                        </div>
                                    </div>
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
                                <input class="form-control" type="text" name="ability_to_concentrate" value="{{old("ability_to_concentrate")}}" required>
                            </div>
                        </div>   
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" value="C.R.K" required disabled>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="text" id="crk" name="crk" value="{{old("crk")}}" required>
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
                                <input class="form-control" type="text" name="colouring_art" value="{{old("colouring_art")}}" required>
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
                                <input class="form-control" type="text"  name="games" value="{{old("games")}}" required>
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
                                <input class="form-control" type="text" id="language_dev" name="language_dev" value="{{old("language_dev")}}" required>
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
                                <input class="form-control" type="text" id="number_work" name="number_work" value="{{old("number_work")}}" required>
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
                                <input class="form-control" type="text" name="other_activities" value="{{old("other_activities")}}" required>
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
                                <input class="form-control" type="text" id="pencil_work" name="pencil_work" value="{{old("pencil_work")}}" required>
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
                                <input class="form-control" type="text" id="phonics" name="phonics" value="{{old("phonics")}}" required>
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
                                <input class="form-control" type="text" name="project_work" value="{{old("project_work")}}" required>
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
                            <input class="form-control" type="text" name="attitude_to_work" value="{{old("attitude_to_work")}}" required>
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
                            <input class="form-control" type="text" name="cleanliness" value="{{old("cleanliness")}}" required>
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
                            <input class="form-control" type="text" name="dress" value="{{old("dress")}}" required>
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
                            <input class="form-control" type="text" name="hair" value="{{old("hair")}}" required>
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
                            <input class="form-control" type="text" name="nails" value="{{old("nails")}}" required>
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
                            <input class="form-control" type="text" name="neatness" value="{{old("neatness")}}" required>
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
                            <input class="form-control" type="text" name="punctuality" value="{{old("punctuality")}}" required>
                        </div>
                    </div> 
                </div>
                <hr class="mb-3 mt-5">
                <h5 class="text-blue mb-5">ATTENDANCE</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="times_school_opened">No. of Times School Opened</label>
                            <input class="form-control" type="number" id="times_school_opened" name="times_school_opened" value="{{old("times_school_opened")}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="times_present">No. of Times Present</label>
                            <input class="form-control" type="number" id="times_present" name="times_present" value="{{old("times_present")}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="times_absent">No. of Times Absent</label>
                            <input class="form-control" type="number" id="times_absent" name="times_absent" value="{{old("times_absent")}}">
                        </div>
                    </div>
                </div>
                <hr class="mb-3 mt-5">
                <h5 class="text-blue mb-5">PHYSICAL DEVELOPMENT</h5>
                <div class="row">
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="height_start">Height(Begining of term)(cm)</label>
                            <input class="form-control" type="number" id="height_start" name="height_start" value="{{old("height_start")}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="height_end">Height(End of term)(cm)</label>
                            <input class="form-control" type="number" id="height_end" name="height_end" value="{{old("height_end")}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="weight_start">Weight(Begining of term)(kg)</label>
                            <input class="form-control" type="number" id="weight_start" name="weight_start" value="{{old("weight_start")}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="weight_end">Weight(end of term)(kg)</label>
                            <input class="form-control" type="number" id="weight_end" name="weight_end" value="{{old("weight_end")}}">
                        </div>
                    </div>
                </div>
                <hr class="mb-3 mt-5">
                <h5 class="text-blue mb-5">PERSONAL NOTE</h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="deshboard_main_top_edit_area_single_item">
                            {{-- <label for="teacher_remark">Class Teacher's Remark</label> --}}
                            <textarea class="form-control" rows="10" id="personal_note" name="personal_note">{{old("personal_note")}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="teacher_remark">Class Teacher's Remark</label>
                            <textarea class="form-control" rows="10" id="teacher_remark" name="teacher_remark">{{old("teacher_remark")}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="head_remark">Head of School's Remark</label>
                            <textarea class="form-control" rows="10" id="head_remark" name="head_remark">{{old("head_remark")}}</textarea>
                        </div>
                    </div>
                </div>
                {{-- submit button --}}
                <div class="col-md-12 mt-5">
                    <div class="deshboard_single_item_editor_btn_area">
                        <input type="submit" value="Add Report" name="edit-btn-area">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection