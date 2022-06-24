@extends('results.primary.base')
@section('title', 'Add Term Report')
@section('page-heading', 'Add Term Report')

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
        <form action="{{route('create-primary-report')}}" method="POST">
            @csrf
            <div class="deshboard_main_top_edit_area">
                {{-- pupil details --}}
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="pupil">Pupil</label>
                            <select name="pupil" class="form-control" id="pupil" required>
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
                            <select name="term" class="form-control" id="term" required>
                                <option value="" {{ old('term') == "" ? "selected" : "" }} hidden=""></option>
                                @foreach($terms as $term)
                                    <option value={{$term->id}} {{ old('term') == $term->id ? "selected" : "" }}>{{$term->name}} {{$term->session}}</option>
                                @endforeach                           
                            </select>
                        </div>
                    </div>
                    {{-- subject results --}}
                    @foreach($subjects as $subject)
                        <div class="col-md-2">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="number" id="{{$subject->id}}" name="subject[{{$loop->index}}][id]" value='{{old("subject[{$loop->index}][id]", $subject->id)}}' hidden readonly aria-hidden="true" aria-readonly="true">
                                <label for="{{$subject->name}}">Subject</label>
                                <input class="form-control" type="text" id="{{$subject->name}}" name="subject[{{$loop->index}}][name]" value='{{old("subject[{$loop->index}][name]", $subject->name)}}' readonly>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$subject->name}}-test_1">1st test</label>
                                <input class="form-control" type="text" id="{{$subject->name}}-test_1" name="subject[{{$loop->index}}][test_1]" value="{{old("subject[{$loop->index}][test_1]")}}">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$subject->name}}-test_2">2nd test</label>
                                <input class="form-control" type="text" id="{{$subject->name}}-test_2" name="subject[{{$loop->index}}][test_2]" value="{{old("subject[{$loop->index}][test_2]")}}">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$subject->name}}-test_3">3rd test</label>
                                <input class="form-control" type="text" id="{{$subject->name}}-test_3" name="subject[{{$loop->index}}][test_3]" value="{{old("subject[{$loop->index}][test_3]")}}">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$subject->name}}-test_4">4th test</label>
                                <input class="form-control" type="text" id="{{$subject->name}}-test_4" name="subject[{{$loop->index}}][test_4]" value="{{old("subject[{$loop->index}][test_4]")}}">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$subject->name}}-exam">Exam</label>
                                <input class="form-control" type="text" id="{{$subject->name}}-exam" name="subject[{{$loop->index}}][exam]" value="{{old("subject[{$loop->index}][exam]")}}">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$subject->name}}-mark">Mark %</label>
                                <input class="form-control" type="text" id="{{$subject->name}}-mark" name="subject[{{$loop->index}}][mark]" value="{{old("subject[{$loop->index}][mark]")}}">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$subject->name}}-grade">Grade</label>
                                <select name="subject[{{$loop->index}}][grade]" class="form-control" id="{{$subject->name}}-grade">
                                    <option value="" {{old("subject[{$loop->index}][grade]") == "" ? "selected" : "" }} hidden=""></option>
                                    <option value=A {{old("subject[{$loop->index}][grade]") == 'A' ? "selected" : "" }}>A</option>
                                    <option value=B {{old("subject[{$loop->index}][grade]") == 'B' ? "selected" : "" }}>B</option>
                                    <option value=C {{old("subject[{$loop->index}][grade]") == 'C' ? "selected" : "" }}>C</option>
                                    <option value=D {{old("subject[{$loop->index}][grade]") == 'D' ? "selected" : "" }}>D</option>
                                    <option value=E {{old("subject[{$loop->index}][grade]") == 'E' ? "selected" : "" }}>E</option>
                                    <option value=F {{old("subject[{$loop->index}][grade]") == 'F' ? "selected" : "" }}>F</option>
                                </select>                                
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$subject->name}}-effort_grade" style="white-space:nowrap;"><small>Effort Grade</small></label>
                                <select name="subject[{{$loop->index}}][effort_grade]" class="form-control" id="{{$subject->name}}-effort_grade">
                                    <option value="" {{old("subject[{$loop->index}][effort_grade]") == "" ? "selected" : "" }} hidden=""></option>
                                    <option value=A {{old("subject[{$loop->index}][effort_grade]") == 'A' ? "selected" : "" }}>A</option>
                                    <option value=B {{old("subject[{$loop->index}][effort_grade]") == 'B' ? "selected" : "" }}>B</option>
                                    <option value=C {{old("subject[{$loop->index}][effort_grade]") == 'C' ? "selected" : "" }}>C</option>
                                    <option value=D {{old("subject[{$loop->index}][effort_grade]") == 'D' ? "selected" : "" }}>D</option>
                                    <option value=E {{old("subject[{$loop->index}][effort_grade]") == 'E' ? "selected" : "" }}>E</option>
                                    <option value=F {{old("subject[{$loop->index}][effort_grade]") == 'F' ? "selected" : "" }}>F</option>
                                </select>                                
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$subject->name}}-comment">Teacher's Comment</label>
                                <select name="subject[{{$loop->index}}][comment]" class="form-control" id="{{$subject->name}}-comment">
                                    <option value="" {{old("subject[{$loop->index}][comment]") == "" ? "selected" : "" }} hidden=""></option>
                                    <option value='excellent' {{old("subject[{$loop->index}][comment]") == 'excellent' ? "selected" : "" }}>Excellent</option>
                                    <option value='very_good' {{old("subject[{$loop->index}][comment]") == 'very_good' ? "selected" : "" }}>Very Good</option>
                                    <option value='good' {{old("subject[{$loop->index}][comment]") == 'good' ? "selected" : "" }}>Good</option>
                                    <option value='fair' {{old("subject[{$loop->index}][comment]") == 'fair' ? "selected" : "" }}>Fair</option>
                                    <option value='poor' {{old("subject[{$loop->index}][comment]") == 'poor' ? "selected" : "" }}>Poor</option>
                                    <option value='fail' {{old("subject[{$loop->index}][comment]") == 'fail' ? "selected" : "" }}>Fail</option>
                                </select>                            
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
                            <label for="times_punctual">No. of Times Punctual</label>
                            <input class="form-control" type="number" id="times_punctual" name="times_punctual" value="{{old("times_punctual")}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="sport_activities_1">Sports Activities</label>
                            <input class="form-control" type="text" id="sport_activities_1" name="sport_activities_1" value="{{old("sport_activities_1")}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="sport_activities_2">Sports Activities</label>
                            <input class="form-control" type="text" id="sport_activities_2" name="sport_activities_2" value="{{old("sport_activities_2")}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="sport_activities_3">Sports Activities</label>
                            <input class="form-control" type="text" id="sport_activities_3" name="sport_activities_3" value="{{old("sport_activities_3")}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="other_activities_1">Other Organized Activities</label>
                            <input class="form-control" type="text" id="other_activities_1" name="other_activities_1" value="{{old("other_activities_1")}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="other_activities_2">Other Organized Activities</label>
                            <input class="form-control" type="text" id="other_activities_2" name="other_activities_2" value="{{old("other_activities_2")}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="other_activities_1">Other Organized Activities</label>
                            <input class="form-control" type="text" id="other_activities_3" name="other_activities_3" value="{{old("other_activities_3")}}">
                        </div>
                    </div>
                </div>
                <hr class="mb-3 mt-5">
                <h5 class="text-blue mb-5">CONDUCT</h5>
                <div class="row">
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="conduct_good">Good</label>
                            <input class="form-control" type="number" id="conduct_good" name="conduct_good" value="{{old("conduct_good")}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="conduct_bad">Bad Conduct</label>
                            <input class="form-control" type="number" id="conduct_bad" name="conduct_bad" value="{{old("conduct_bad")}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="conduct_exemplary">Exemplary Conduct</label>
                            <input class="form-control" type="number" id="conduct_exemplary" name="conduct_exemplary" value="{{old("conduct_exemplary")}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="conduct_comment">Comments</label>
                            <input class="form-control" type="text" id="conduct_comment" name="conduct_comment" value="{{old("conduct_comment")}}">
                        </div>
                    </div>
                </div>
                <hr class="mb-3 mt-5">
                <h5 class="text-blue mb-5">PHYSICAL DEVELOPMENT HEALTH AND CLEANLINESS</h5>
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
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="illness_days">No. of days absent due to illness</label>
                            <input class="form-control" type="number" id="illness_days" name="illness_days" value="{{old("illness_days")}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="illness_nature">Nature of illness</label>
                            <input class="form-control" type="text" id="illness_nature" name="illness_nature" value="{{old("illness_nature")}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="cleanliness_rating">Cleanliness rating</label>
                            <select name="cleanliness_rating" class="form-control" id="cleanliness_rating">
                                <option value="" {{old("cleanliness_rating") == "" ? "selected" : "" }} hidden=""></option>
                                <option value=A {{old("cleanliness_rating") == 'A' ? "selected" : "" }}>A</option>
                                <option value=B {{old("cleanliness_rating") == 'B' ? "selected" : "" }}>B</option>
                                <option value=C {{old("cleanliness_rating") == 'C' ? "selected" : "" }}>C</option>
                                <option value=D {{old("cleanliness_rating") == 'D' ? "selected" : "" }}>D</option>
                                <option value=E {{old("cleanliness_rating") == 'E' ? "selected" : "" }}>E</option>
                                <option value=F {{old("cleanliness_rating") == 'F' ? "selected" : "" }}>F</option>
                            </select>                                
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="cleanliness_remark">Remarks</label>
                            <select name="cleanliness_remark" class="form-control" id="cleanliness_remark">
                                <option value="" {{old("cleanliness_remark") == "" ? "selected" : "" }} hidden=""></option>
                                <option value='excellent' {{old("cleanliness_remark") == 'excellent' ? "selected" : "" }}>Excellent</option>
                                <option value='very_good' {{old("cleanliness_remark") == 'very_good' ? "selected" : "" }}>Very Good</option>
                                <option value='good' {{old("cleanliness_remark") == 'good' ? "selected" : "" }}>Good</option>
                                <option value='fair' {{old("cleanliness_remark") == 'fair' ? "selected" : "" }}>Fair</option>
                                <option value='poor' {{old("cleanliness_remark") == 'poor' ? "selected" : "" }}>Poor</option>
                                <option value='fail' {{old("cleanliness_remark") == 'fail' ? "selected" : "" }}>Fail</option>
                            </select>                            
                        </div>
                    </div>
                </div>
                <hr class="mb-3 mt-5">
                <h5 class="text-blue mb-5">SPORTS</h5>
                <div class="row">
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="ball_games">Ball games</label>
                            <select name="ball_games" class="form-control" id="ball_games">
                                <option value="" {{old("ball_games") == "" ? "selected" : "" }} hidden=""></option>
                                <option value='excellent' {{old("ball_games") == 'excellent' ? "selected" : "" }}>Excellent</option>
                                <option value='very_good' {{old("ball_games") == 'very_good' ? "selected" : "" }}>Very Good</option>
                                <option value='good' {{old("ball_games") == 'good' ? "selected" : "" }}>Good</option>
                                <option value='fair' {{old("ball_games") == 'fair' ? "selected" : "" }}>Fair</option>
                                <option value='poor' {{old("ball_games") == 'poor' ? "selected" : "" }}>Poor</option>
                                <option value='fail' {{old("ball_games") == 'fail' ? "selected" : "" }}>Fail</option>
                                <option value='nil' {{old("ball_games") == 'nil' ? "selected" : "" }}>Nil</option>
                            </select>                            
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="tracks">Tracks</label>
                            <select name="tracks" class="form-control" id="tracks">
                                <option value="" {{old("tracks") == "" ? "selected" : "" }} hidden=""></option>
                                <option value='excellent' {{old("tracks") == 'excellent' ? "selected" : "" }}>Excellent</option>
                                <option value='very_good' {{old("tracks") == 'very_good' ? "selected" : "" }}>Very Good</option>
                                <option value='good' {{old("tracks") == 'good' ? "selected" : "" }}>Good</option>
                                <option value='fair' {{old("tracks") == 'fair' ? "selected" : "" }}>Fair</option>
                                <option value='poor' {{old("tracks") == 'poor' ? "selected" : "" }}>Poor</option>
                                <option value='fail' {{old("tracks") == 'fail' ? "selected" : "" }}>Fail</option>
                                <option value='nil' {{old("tracks") == 'nil' ? "selected" : "" }}>Nil</option>
                            </select>                            
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="jumps">Jumps</label>
                            <select name="jumps" class="form-control" id="jumps">
                                <option value="" {{old("jumps") == "" ? "selected" : "" }} hidden=""></option>
                                <option value='excellent' {{old("jumps") == 'excellent' ? "selected" : "" }}>Excellent</option>
                                <option value='very_good' {{old("jumps") == 'very_good' ? "selected" : "" }}>Very Good</option>
                                <option value='good' {{old("jumps") == 'good' ? "selected" : "" }}>Good</option>
                                <option value='fair' {{old("jumps") == 'fair' ? "selected" : "" }}>Fair</option>
                                <option value='poor' {{old("jumps") == 'poor' ? "selected" : "" }}>Poor</option>
                                <option value='fail' {{old("jumps") == 'fail' ? "selected" : "" }}>Fail</option>
                                <option value='nil' {{old("jumps") == 'nil' ? "selected" : "" }}>Nil</option>
                            </select>                            
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="throws">Throws</label>
                            <select name="throws" class="form-control" id="throws">
                                <option value="" {{old("throws") == "" ? "selected" : "" }} hidden=""></option>
                                <option value='excellent' {{old("throws") == 'excellent' ? "selected" : "" }}>Excellent</option>
                                <option value='very_good' {{old("throws") == 'very_good' ? "selected" : "" }}>Very Good</option>
                                <option value='good' {{old("throws") == 'good' ? "selected" : "" }}>Good</option>
                                <option value='fair' {{old("throws") == 'fair' ? "selected" : "" }}>Fair</option>
                                <option value='poor' {{old("throws") == 'poor' ? "selected" : "" }}>Poor</option>
                                <option value='fail' {{old("throws") == 'fail' ? "selected" : "" }}>Fail</option>
                                <option value='nil' {{old("throws") == 'nil' ? "selected" : "" }}>Nil</option>
                            </select>                            
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="swimming">Swimming</label>
                            <select name="swimming" class="form-control" id="swimming">
                                <option value="" {{old("swimming") == "" ? "selected" : "" }} hidden=""></option>
                                <option value='excellent' {{old("swimming") == 'excellent' ? "selected" : "" }}>Excellent</option>
                                <option value='very_good' {{old("swimming") == 'very_good' ? "selected" : "" }}>Very Good</option>
                                <option value='good' {{old("swimming") == 'good' ? "selected" : "" }}>Good</option>
                                <option value='fair' {{old("swimming") == 'fair' ? "selected" : "" }}>Fair</option>
                                <option value='poor' {{old("swimming") == 'poor' ? "selected" : "" }}>Poor</option>
                                <option value='fail' {{old("swimming") == 'fail' ? "selected" : "" }}>Fail</option>
                                <option value='nil' {{old("swimming") == 'nil' ? "selected" : "" }}>Nil</option>
                            </select>                            
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="others">Others</label>
                            <select name="others" class="form-control" id="others">
                                <option value="" {{old("others") == "" ? "selected" : "" }} hidden=""></option>
                                <option value='excellent' {{old("others") == 'excellent' ? "selected" : "" }}>Excellent</option>
                                <option value='very_good' {{old("others") == 'very_good' ? "selected" : "" }}>Very Good</option>
                                <option value='good' {{old("others") == 'good' ? "selected" : "" }}>Good</option>
                                <option value='fair' {{old("others") == 'fair' ? "selected" : "" }}>Fair</option>
                                <option value='poor' {{old("others") == 'poor' ? "selected" : "" }}>Poor</option>
                                <option value='fail' {{old("others") == 'fail' ? "selected" : "" }}>Fail</option>
                                <option value='nil' {{old("others") == 'nil' ? "selected" : "" }}>Nil</option>
                            </select>                            
                        </div>
                    </div> 
                </div>
                <hr class="mb-3 mt-5">
                <h5 class="text-blue mb-5">CLUBS</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="organisation">Organisation</label>
                            <input class="form-control" type="text" id="organisation" name="organisation" value="{{old("organisation")}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="organisation_office">Office Held</label>
                            <input class="form-control" type="text" id="organisation_office" name="organisation_office" value="{{old("organisation_office")}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="organisation_contribution">Significant Contribution</label>
                            <input class="form-control" type="text" id="organisation_contribution" name="organisation_contribution" value="{{old("organisation_contribution")}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="teacher_remark">Class Teacher's Remark</label>
                            <textarea class="form-control" rows="5" id="teacher_remark" name="teacher_remark">{{old("teacher_remark")}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="head_remark">Head of School's Remark</label>
                            <textarea class="form-control" rows="5" id="head_remark" name="head_remark">{{old("head_remark")}}</textarea>
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