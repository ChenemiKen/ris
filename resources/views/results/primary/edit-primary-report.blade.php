@extends('results.primary.base')
@section('title', 'Edit Term Report')
@section('page-heading', 'Edit Term Report')

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
        <form action="{{route('update-report', $report->id)}}" method="POST">
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
                                    <option value={{$pupil->id}} {{ old('pupil', $report->pupil_id) == $pupil->id ? "selected" : "" }}>{{$pupil->firstname}}{{$pupil->lastname}}</option>
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
                                    <option value={{$term->id}} {{ old('term', $report->term_id) == $term->id ? "selected" : "" }}>{{$term->name}}{{$term->session}}</option>
                                @endforeach                           
                            </select>
                        </div>
                    </div>
                    {{-- subject results --}}
                    @foreach($report->termResults as $termResult)
                        <div class="col-md-2">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="number" id="{{$termResult->id}}" name="result[{{$loop->index}}][id]" value='{{old("result[{$loop->index}][id]", $termResult->id)}}' required hidden readonly aria-hidden="true" aria-readonly="true">
                                <label for="{{$termResult->subject->name}}">Subject</label>
                                <input class="form-control" type="text" id="{{$termResult->subject->name}}" name="result[{{$loop->index}}][name]" value='{{old("result[{$loop->index}][name]", $termResult->subject->name)}}' required readonly>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$termResult->subject->name}}-test_1">1st test</label>
                                <input class="form-control" type="number" id="{{$termResult->subject->name}}-test_1" name="result[{{$loop->index}}][test_1]" value="{{old("result[{$loop->index}][test_1]", $termResult->test_1)}}" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$termResult->subject->name}}-test_2">2nd test</label>
                                <input class="form-control" type="number" id="{{$termResult->subject->name}}-test_2" name="result[{{$loop->index}}][test_2]" value="{{old("result[{$loop->index}][test_2]", $termResult->test_2)}}" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$termResult->subject->name}}-test_3">3rd test</label>
                                <input class="form-control" type="number" id="{{$termResult->subject->name}}-test_3" name="result[{{$loop->index}}][test_3]" value="{{old("result[{$loop->index}][test_3]", $termResult->test_3)}}" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$termResult->subject->name}}-test_4">4th test</label>
                                <input class="form-control" type="number" id="{{$termResult->subject->name}}-test_4" name="result[{{$loop->index}}][test_4]" value="{{old("result[{$loop->index}][test_4]", $termResult->test_4)}}" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$termResult->subject->name}}-exam">Exam</label>
                                <input class="form-control" type="number" id="{{$termResult->subject->name}}-exam" name="result[{{$loop->index}}][exam]" value="{{old("result[{$loop->index}][exam]", $termResult->exam)}}" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$termResult->subject->name}}-mark">Mark %</label>
                                <input class="form-control" type="number" id="{{$termResult->subject->name}}-mark" name="result[{{$loop->index}}][mark]" value="{{old("result[{$loop->index}][mark]", $termResult->percentage)}}" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$termResult->subject->name}}-grade">Grade</label>
                                <select name="result[{{$loop->index}}][grade]" class="form-control" id="{{$termResult->subject->name}}-grade">
                                    <option value="" {{old("result[{$loop->index}][grade]", $termResult->grade) == "" ? "selected" : "" }} hidden=""></option>
                                    <option value=A {{old("result[{$loop->index}][grade]", $termResult->grade) == 'A' ? "selected" : "" }}>A</option>
                                    <option value=B {{old("result[{$loop->index}][grade]", $termResult->grade) == 'B' ? "selected" : "" }}>B</option>
                                    <option value=C {{old("result[{$loop->index}][grade]", $termResult->grade) == 'C' ? "selected" : "" }}>C</option>
                                    <option value=D {{old("result[{$loop->index}][grade]", $termResult->grade) == 'D' ? "selected" : "" }}>D</option>
                                    <option value=E {{old("result[{$loop->index}][grade]", $termResult->grade) == 'E' ? "selected" : "" }}>E</option>
                                    <option value=F {{old("result[{$loop->index}][grade]", $termResult->grade) == 'F' ? "selected" : "" }}>F</option>
                                </select>                                
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$termResult->subject->name}}-effort_grade" style="white-space:nowrap;"><small>Effort Grade</small></label>
                                <select name="result[{{$loop->index}}][effort_grade]" class="form-control" id="{{$termResult->subject->name}}-effort_grade">
                                    <option value="" {{old("result[{$loop->index}][effort_grade]", $termResult->effort_grade) == "" ? "selected" : "" }} hidden=""></option>
                                    <option value=A {{old("result[{$loop->index}][effort_grade]", $termResult->effort_grade) == 'A' ? "selected" : "" }}>A</option>
                                    <option value=B {{old("result[{$loop->index}][effort_grade]", $termResult->effort_grade) == 'B' ? "selected" : "" }}>B</option>
                                    <option value=C {{old("result[{$loop->index}][effort_grade]", $termResult->effort_grade) == 'C' ? "selected" : "" }}>C</option>
                                    <option value=D {{old("result[{$loop->index}][effort_grade]", $termResult->effort_grade) == 'D' ? "selected" : "" }}>D</option>
                                    <option value=E {{old("result[{$loop->index}][effort_grade]", $termResult->effort_grade) == 'E' ? "selected" : "" }}>E</option>
                                    <option value=F {{old("result[{$loop->index}][effort_grade]", $termResult->effort_grade) == 'F' ? "selected" : "" }}>F</option>
                                </select>                                
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$termResult->subject->name}}-comment">Teacher's Comment</label>
                                <select name="result[{{$loop->index}}][comment]" class="form-control" id="{{$termResult->subject->name}}-comment">
                                    <option value="" {{old("result[{$loop->index}][comment]", $termResult->remark) == "" ? "selected" : "" }} hidden=""></option>
                                    <option value='very_good' {{old("result[{$loop->index}][comment]", $termResult->remark) == 'very_good' ? "selected" : "" }}>Very Good</option>
                                    <option value='excellent' {{old("result[{$loop->index}][comment]", $termResult->remark) == 'excellent' ? "selected" : "" }}>Excellent</option>
                                    <option value='good' {{old("result[{$loop->index}][comment]", $termResult->remark) == 'good' ? "selected" : "" }}>Good</option>
                                    <option value='fair' {{old("result[{$loop->index}][comment]", $termResult->remark) == 'fair' ? "selected" : "" }}>Fair</option>
                                    <option value='poor' {{old("result[{$loop->index}][comment]", $termResult->remark) == 'poor' ? "selected" : "" }}>Poor</option>
                                    <option value='fail' {{old("result[{$loop->index}][comment]", $termResult->remark) == 'fail' ? "selected" : "" }}>Fail</option>
                                </select>                            
                            </div>
                        </div>   
                    @endforeach
                </div>
                <hr class="mb-3 mt-5">
                <h5 class="text-blue mb-5">Attendance</h5>
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
                            <label for="times_punctual">No. of Times Punctual</label>
                            <input class="form-control" type="number" id="times_punctual" name="times_punctual" value="{{old("times_punctual", $report->times_punctual)}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="sport_activities_1">Sports Activities</label>
                            <input class="form-control" type="number" id="sport_activities_1" name="sport_activities_1" value="{{old("sport_activities_1", $report->sports_1)}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="sport_activities_2">Sports Activities</label>
                            <input class="form-control" type="number" id="sport_activities_2" name="sport_activities_2" value="{{old("sport_activities_2", $report->sports_2)}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="sport_activities_3">Sports Activities</label>
                            <input class="form-control" type="number" id="sport_activities_3" name="sport_activities_3" value="{{old("sport_activities_3", $report->sports_3)}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="other_activities_1">Other Organized Activities</label>
                            <input class="form-control" type="text" id="other_activities_1" name="other_activities_1" value="{{old("other_activities_1", $report->other_event_1)}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="other_activities_2">Other Organized Activities</label>
                            <input class="form-control" type="text" id="other_activities_2" name="other_activities_2" value="{{old("other_activities_2", $report->other_event_2)}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="other_activities_1">Other Organized Activities</label>
                            <input class="form-control" type="text" id="other_activities_3" name="other_activities_3" value="{{old("other_activities_3", $report->other_event_3)}}">
                        </div>
                    </div>
                </div>
                <hr class="mb-3 mt-5">
                <h5 class="text-blue mb-5">CONDUCT</h5>
                <div class="row">
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="conduct_good">Good</label>
                            <input class="form-control" type="number" id="conduct_good" name="conduct_good" value="{{old("conduct_good", $report->conduct_good)}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="conduct_bad">Bad Conduct</label>
                            <input class="form-control" type="number" id="conduct_bad" name="conduct_bad" value="{{old("conduct_bad", $report->conduct_bad)}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="conduct_exemplary">Exemplary Conduct</label>
                            <input class="form-control" type="number" id="conduct_exemplary" name="conduct_exemplary" value="{{old("conduct_exemplary", $report->conduct_exemplary)}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="conduct_comment">Comments</label>
                            <input class="form-control" type="text" id="conduct_comment" name="conduct_comment" value="{{old("conduct_comment", $report->conduct_comment)}}">
                        </div>
                    </div>
                </div>
                <hr class="mb-3 mt-5">
                <h5 class="text-blue mb-5">PHYSICAL DEVELOPMENT HEALTH AND CLEANLINESS</h5>
                <div class="row">
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="height_start">Height(Begining of term)</label>
                            <input class="form-control" type="number" id="height_start" name="height_start" value="{{old("height_start", $report->height_start)}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="height_end">Height(End of term)</label>
                            <input class="form-control" type="number" id="height_end" name="height_end" value="{{old("height_end", $report->height_end)}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="weight_start">Weight(Begining of term)</label>
                            <input class="form-control" type="number" id="weight_start" name="weight_start" value="{{old("weight_start", $report->weight_start)}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="weight_end">Weight(end of term)</label>
                            <input class="form-control" type="number" id="weight_end" name="weight_end" value="{{old("weight_end", $report->weight_end)}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="illness_days">No. of days absent due to illness</label>
                            <input class="form-control" type="number" id="illness_days" name="illness_days" value="{{old("illness_days", $report->illness_days)}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="illness_nature">Nature of illness</label>
                            <input class="form-control" type="text" id="illness_nature" name="illness_nature" value="{{old("illness_nature", $report->nature_of_illness)}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="cleanliness_rating">Cleanliness rating</label>
                            <select name="cleanliness_rating" class="form-control" id="cleanliness_rating">
                                <option value="" {{old("cleanliness_rating", $report->cleanliness_rating) == "" ? "selected" : "" }} hidden=""></option>
                                <option value=A {{old("cleanliness_rating", $report->cleanliness_rating) == 'A' ? "selected" : "" }}>A</option>
                                <option value=B {{old("cleanliness_rating", $report->cleanliness_rating) == 'B' ? "selected" : "" }}>B</option>
                                <option value=C {{old("cleanliness_rating", $report->cleanliness_rating) == 'C' ? "selected" : "" }}>C</option>
                                <option value=D {{old("cleanliness_rating", $report->cleanliness_rating) == 'D' ? "selected" : "" }}>D</option>
                                <option value=E {{old("cleanliness_rating", $report->cleanliness_rating) == 'E' ? "selected" : "" }}>E</option>
                                <option value=F {{old("cleanliness_rating", $report->cleanliness_rating) == 'F' ? "selected" : "" }}>F</option>
                            </select>                                
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="cleanliness_remark">Remarks</label>
                            <select name="cleanliness_remark" class="form-control" id="cleanliness_remark">
                                <option value="" {{old("cleanliness_remark", $report->cleanliness_remark) == "" ? "selected" : "" }} hidden=""></option>
                                <option value='excellent' {{old("cleanliness_remark", $report->cleanliness_remark) == 'excellent' ? "selected" : "" }}>Excellent</option>
                                <option value='very_good' {{old("cleanliness_remark", $report->cleanliness_remark) == 'very_good' ? "selected" : "" }}>Very Good</option>
                                <option value='good' {{old("cleanliness_remark", $report->cleanliness_remark) == 'good' ? "selected" : "" }}>Good</option>
                                <option value='fair' {{old("cleanliness_remark", $report->cleanliness_remark) == 'fair' ? "selected" : "" }}>Fair</option>
                                <option value='poor' {{old("cleanliness_remark", $report->cleanliness_remark) == 'poor' ? "selected" : "" }}>Poor</option>
                                <option value='fail' {{old("cleanliness_remark", $report->cleanliness_remark) == 'fail' ? "selected" : "" }}>Fail</option>
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
                                <option value="" {{old("ball_games", $report->ball_games) == "" ? "selected" : "" }} hidden=""></option>
                                <option value='excellent' {{old("ball_games", $report->ball_games) == 'excellent' ? "selected" : "" }}>Excellent</option>
                                <option value='very_good' {{old("ball_games", $report->ball_games) == 'very_good' ? "selected" : "" }}>Very Good</option>
                                <option value='good' {{old("ball_games", $report->ball_games) == 'good' ? "selected" : "" }}>Good</option>
                                <option value='fair' {{old("ball_games", $report->ball_games) == 'fair' ? "selected" : "" }}>Fair</option>
                                <option value='poor' {{old("ball_games", $report->ball_games) == 'poor' ? "selected" : "" }}>Poor</option>
                                <option value='fail' {{old("ball_games", $report->ball_games) == 'fail' ? "selected" : "" }}>Fail</option>
                                <option value='nil' {{old("ball_games", $report->ball_games) == 'nil' ? "selected" : "" }}>Nil</option>
                            </select>                            
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="tracks">Tracks</label>
                            <select name="tracks" class="form-control" id="tracks">
                                <option value="" {{old("tracks", $report->tracks) == "" ? "selected" : "" }} hidden=""></option>
                                <option value='excellent' {{old("tracks", $report->tracks) == 'excellent' ? "selected" : "" }}>Excellent</option>
                                <option value='very_good' {{old("tracks", $report->tracks) == 'very_good' ? "selected" : "" }}>Very Good</option>
                                <option value='good' {{old("tracks", $report->tracks) == 'good' ? "selected" : "" }}>Good</option>
                                <option value='fair' {{old("tracks", $report->tracks) == 'fair' ? "selected" : "" }}>Fair</option>
                                <option value='poor' {{old("tracks", $report->tracks) == 'poor' ? "selected" : "" }}>Poor</option>
                                <option value='fail' {{old("tracks", $report->tracks) == 'fail' ? "selected" : "" }}>Fail</option>
                                <option value='nil' {{old("tracks", $report->tracks) == 'nil' ? "selected" : "" }}>Nil</option>
                            </select>                            
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="jumps">Jumps</label>
                            <select name="jumps" class="form-control" id="jumps">
                                <option value="" {{old("jumps", $report->jumps) == "" ? "selected" : "" }} hidden=""></option>
                                <option value='excellent' {{old("jumps", $report->jumps) == 'excellent' ? "selected" : "" }}>Excellent</option>
                                <option value='very_good' {{old("jumps", $report->jumps) == 'very_good' ? "selected" : "" }}>Very Good</option>
                                <option value='good' {{old("jumps", $report->jumps) == 'good' ? "selected" : "" }}>Good</option>
                                <option value='fair' {{old("jumps", $report->jumps) == 'fair' ? "selected" : "" }}>Fair</option>
                                <option value='poor' {{old("jumps", $report->jumps) == 'poor' ? "selected" : "" }}>Poor</option>
                                <option value='fail' {{old("jumps", $report->jumps) == 'fail' ? "selected" : "" }}>Fail</option>
                                <option value='nil' {{old("jumps", $report->jumps) == 'nil' ? "selected" : "" }}>Nil</option>
                            </select>                            
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="throws">Throws</label>
                            <select name="throws" class="form-control" id="throws">
                                <option value="" {{old("throws", $report->throws) == "" ? "selected" : "" }} hidden=""></option>
                                <option value='excellent' {{old("throws", $report->throws) == 'excellent' ? "selected" : "" }}>Excellent</option>
                                <option value='very_good' {{old("throws", $report->throws) == 'very_good' ? "selected" : "" }}>Very Good</option>
                                <option value='good' {{old("throws", $report->throws) == 'good' ? "selected" : "" }}>Good</option>
                                <option value='fair' {{old("throws", $report->throws) == 'fair' ? "selected" : "" }}>Fair</option>
                                <option value='poor' {{old("throws", $report->throws) == 'poor' ? "selected" : "" }}>Poor</option>
                                <option value='fail' {{old("throws", $report->throws) == 'fail' ? "selected" : "" }}>Fail</option>
                                <option value='nil' {{old("throws", $report->throws) == 'nil' ? "selected" : "" }}>Nil</option>
                            </select>                            
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="swimming">Swimming</label>
                            <select name="swimming" class="form-control" id="swimming">
                                <option value="" {{old("swimming", $report->swimming) == "" ? "selected" : "" }} hidden=""></option>
                                <option value='excellent' {{old("swimming", $report->swimming) == 'excellent' ? "selected" : "" }}>Excellent</option>
                                <option value='very_good' {{old("swimming", $report->swimming) == 'very_good' ? "selected" : "" }}>Very Good</option>
                                <option value='good' {{old("swimming", $report->swimming) == 'good' ? "selected" : "" }}>Good</option>
                                <option value='fair' {{old("swimming", $report->swimming) == 'fair' ? "selected" : "" }}>Fair</option>
                                <option value='poor' {{old("swimming", $report->swimming) == 'poor' ? "selected" : "" }}>Poor</option>
                                <option value='fail' {{old("swimming", $report->swimming) == 'fail' ? "selected" : "" }}>Fail</option>
                                <option value='nil' {{old("swimming", $report->swimming) == 'nil' ? "selected" : "" }}>Nil</option>
                            </select>                            
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="others">Others</label>
                            <select name="others" class="form-control" id="others">
                                <option value="" {{old("others", $report->others) == "" ? "selected" : "" }} hidden=""></option>
                                <option value='excellent' {{old("others", $report->others) == 'excellent' ? "selected" : "" }}>Excellent</option>
                                <option value='very_good' {{old("others", $report->others) == 'very_good' ? "selected" : "" }}>Very Good</option>
                                <option value='good' {{old("others", $report->others) == 'good' ? "selected" : "" }}>Good</option>
                                <option value='fair' {{old("others", $report->others) == 'fair' ? "selected" : "" }}>Fair</option>
                                <option value='poor' {{old("others", $report->others) == 'poor' ? "selected" : "" }}>Poor</option>
                                <option value='fail' {{old("others", $report->others) == 'fail' ? "selected" : "" }}>Fail</option>
                                <option value='nil' {{old("others", $report->others) == 'nil' ? "selected" : "" }}>Nil</option>
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
                            <input class="form-control" type="text" id="organisation" name="organisation" value="{{old("organisation", $report->organisation)}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="organisation_office">Office Held</label>
                            <input class="form-control" type="text" id="organisation_office" name="organisation_office" value="{{old("organisation_office", $report->organisation_office)}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="organisation_contribution">Significant Contribution</label>
                            <input class="form-control" type="text" id="organisation_contribution" name="organisation_contribution" value="{{old("organisation_contribution", $report->organisation_contribution)}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="teacher_remark">Class Teacher's Remark</label>
                            <textarea class="form-control" rows="5" id="teacher_remark" name="teacher_remark">{{old("teacher_remark", $report->teacher_remark)}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="head_remark">Head of School's Remark</label>
                            <textarea class="form-control" rows="5" id="head_remark" name="head_remark">{{old("head_remark", $report->head_remark)}}</textarea>
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