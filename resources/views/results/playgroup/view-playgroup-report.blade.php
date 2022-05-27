@extends('results.playgroup.base')
@section('title', 'View playgroup report')
@section('page-heading', 'Playgroup Term report')

@section('page-content') 
    <div class="deshboard_booking_main_content_area pt-0">
        <div class="deshboard_booking_main_content_area_container">
            <!-- Header area End  -->
            <div class="deshboard_main_edit_task_area table pt-4 pb-5">
                <h5 class="text-blue mb-5">{{$report->term->session}} {{$report->term->name}} TERM REPORT</h5>
                <div class="row mb-5">
                    <img src="{{asset('uploads/pupils/'.$report->pupil->photo)}}" alt="" class="col-md-4" height=350>
                    <div class="col-md-8">
                        <table class='pupil-details-table'>
                            <tbody> 
                                <tr>
                                    <td><strong>Pupil's Name: </strong>{{$report->pupil->lastname}} {{$report->pupil->firstname}}</td>
                                    <td><strong>Admission Number: </strong>{{$report->pupil->admission_no}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Class: </strong>{{$report->pupil->class}}</td>
                                    <td><strong>Term: </strong>{{$report->term->name}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Class Average Age: </strong></td>
                                    <td><strong>Date: </strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Teacher's Name: </strong></td>
                                    <td><strong>Age: </strong>{{$report->pupil->age}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- Attendance section --}}
                <h5 class="text-blue mt-5 mb-2">Term Attendance</h5>
                <table class="pupil-result-table col-md-8">
                    <thead>
                        <th>No. of times school opened</th>
                        <th>No. of times present</th>
                        <th>No. of times absent</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$report->times_school_opened}}</td>
                            <td>{{$report->times_present}}</td>
                            <td>{{$report->times_absent}}</td>
                        </tr>
                    </tbody>
                </table>

                {{-- Skills section --}}
                <h4 class="text-blue mt-5 mb-3 fw-bold">Areas of Learning</h4>
                <div class="mb-5">
                @foreach($skill_categories as $category)
                    <table class="pupil-result-table mb-5">
                        <thead>
                            <th>{{$category->name}}</th>
                            <th>*</th>
                            <th>10</th>
                            <th>9</th>
                            <th>8</th>
                            <th>7</th>
                            <th>6</th>
                            <th>5</th>
                            <th>4</th>
                            <th>3</th>
                            <th>2</th>
                            <th>1</th>
                        </thead>
                        <tbody>
                            @foreach($report->playgroupSkillResults as $skill_result)
                                @if($skill_result->skill_category->id == $category->id)
                                    <tr>
                                        <td>{{$skill_result->skill->name}}</td>
                                        <td>@if($skill_result->score == '') <div class="shade"></div> @endif</td>
                                        <td>@if($skill_result->score == 10) <div class="shade"></div> @endif</td>
                                        <td>@if($skill_result->score == 9) <div class="shade"></div> @endif</td>
                                        <td>@if($skill_result->score == 8) <div class="shade"></div> @endif</td>
                                        <td>@if($skill_result->score == 7) <div class="shade"></div> @endif</td>
                                        <td>@if($skill_result->score == 6) <div class="shade"></div> @endif</td>
                                        <td>@if($skill_result->score == 5) <div class="shade"></div> @endif</td>
                                        <td>@if($skill_result->score == 4) <div class="shade"></div> @endif</td>
                                        <td>@if($skill_result->score == 3) <div class="shade"></div> @endif</td>
                                        <td>@if($skill_result->score == 2) <div class="shade"></div> @endif</td>
                                        <td>@if($skill_result->score == 1) <div class="shade"></div> @endif</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
                </div>

                {{-- Attention skills table --}}
                <table class="pupil-result-table mb-5">
                    <thead>
                        <th colspan="2">Attention Skills</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-5">Comment here on ability to concentrate</td>
                            <td>{{$report->ability_to_concentrate}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">C.R.K</td>
                            <td>{{$report->crk}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">Colouring & Art</td>
                            <td>{{$report->colouring_art}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">Games</td>
                            <td>{{$report->games}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">Language development & Vocabulary</td>
                            <td>{{$report->lang_dev_vocab}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">Number Work</td>
                            <td>{{$report->number_work}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">Other Activities</td>
                            <td>{{$report->other_activities}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">Pencil play/Pencil activities</td>
                            <td>{{$report->pencil_play_activities}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">Phonics</td>
                            <td>{{$report->phonics}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">Project work(General Knowledge)</td>
                            <td>{{$report->project_work}}</td>
                        </tr>
                    </tbody>
                </table>
                {{-- Affective area skills table --}}
                <table class="pupil-result-table mb-5">
                    <thead>
                        <th colspan="2">Affective Area Skills</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-5">Attitude to Work</td>
                            <td>{{$report->attitude_to_work}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">Cleanliness</td>
                            <td>{{$report->cleanliness}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">Dress</td>
                            <td>{{$report->dress}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">Hair</td>
                            <td>{{$report->hair}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">Nails</td>
                            <td>{{$report->nails}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">Neatness</td>
                            <td>{{$report->neatness}}</td>
                        </tr>
                        <tr>
                            <td class="col-md-5">Punctuality</td>
                            <td>{{$report->punctuality}}</td>
                        </tr>
                        
                    </tbody>
                </table>

                {{-- Physical development section --}}
                <h4 class="text-blue mt-5 mb-2">Physical Development</h4>
                <table class="pupil-result-table col-md-8">
                    <thead>
                        <th></th>
                        <th>BEGINNING OF TERM</th>
                        <th>END OF TERM</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Height</td>
                            <td>{{$report->height_start}} m</td>
                            <td>{{$report->height_end}} m</td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td>{{$report->weight_start}} kg</td>
                            <td>{{$report->weight_end}} kg</td>
                        </tr>
                    </tbody>
                </table>

                <h4 class="text-blue mt-5 mb-2">Personal Note on {{$report->pupil->firstname}}</h4>
                <p>{{$report->personal_note}}</p>
                
                <h4 class="text-blue mt-5 mb-2">Remarks</h4>
                <table class="pupil-result-table mt-5">
                    <thead>
                        <th>Class Teacher's Remarks</th>
                        <th>Head of School's Remarks</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$report->teacher_remark}}</td>
                            <td>{{$report->head_remark}}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="pupil-result-table mt-5">
                    <tbody>
                        <tr>
                            <td class="text-center pt-5"><strong>March 7, 2022</strong></td>
                            <td class="text-center">
                                <img src="{{asset('img/signature.png')}}" width="80px" height="80px" alt="Sign" srcset="">
                                <h6>Anne Beesong</h6>
                                <p>(Head of School)</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection