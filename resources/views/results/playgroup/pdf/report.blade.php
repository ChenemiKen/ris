@extends('results.primary.pdf.base')
@section('title', 'View playgroup report')
@section('page-heading', 'Playgroup Term report')

@section('page-content') 
    <div class="deshboard_booking_main_content_area pt-0">
        <div class="deshboard_main_edit_task_area table mt-0 pt-3">
            <h5 class="text-blue mb-5">{{$report->term->session}} {{$report->term->name}} TERM REPORT</h5>
            <div class="row mb-5">
                <img src="{{public_path('uploads/pupils/'.$report->pupil->photo)}}" alt="" class="col-md-4 dtable" height=300>
                <div class="col-md-7 dtable">
                    <table class='pupil-details-table'>
                        <tbody> 
                            <tr>
                                <td><strong>Pupil's Name: </strong>{{$report->pupil->lastname}} {{$report->pupil->firstname}}</td>
                                <td><strong>Admission Number: </strong>{{$report->pupil->admission_no}}</td>
                            </tr>
                            <tr>
                                <td><strong>Class: </strong>@title($report->pupil->class)</td>
                                <td><strong>Term: </strong>{{$report->term->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>Class Average Age: </strong></td>
                                <td><strong>Date: </strong>{{$report->date}}</td>
                            </tr>
                            <tr>
                                <td><strong>Teacher's Name: </strong>{{$report->teacher->firstname ?? ''}} {{$report->teacher->lastname ?? ''}}</td>
                                <td><strong>Age: </strong>{{$report->pupil->age()}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="clear: both;">
            {{-- Attendance section --}}
            <h5 class="text-start text-blue mb-3 max-score">Term Attendance</h5>
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
                        <td class="col-4">Comment here on ability to concentrate</td>
                        <td class="col-7">{{$report->ability_to_concentrate}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">C.R.K</td>
                        <td class="col-7">{{$report->crk}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">Colouring & Art</td>
                        <td class="col-7">{{$report->colouring_art}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">Games</td>
                        <td class="col-7">{{$report->games}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">Language development & Vocabulary</td>
                        <td class="col-7">{{$report->lang_dev_vocab}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">Number Work</td>
                        <td class="col-7">{{$report->number_work}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">Other Activities</td>
                        <td class="col-7">{{$report->other_activities}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">Pencil play/Pencil activities</td>
                        <td class="col-7">{{$report->pencil_play_activities}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">Phonics</td>
                        <td class="col-7">{{$report->phonics}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">Project work(General Knowledge)</td>
                        <td class="col-7">{{$report->project_work}}</td>
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
                        <td class="col-4">Attitude to Work</td>
                        <td class="col-7">{{$report->attitude_to_work}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">Cleanliness</td>
                        <td class="col-7">{{$report->cleanliness}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">Dress</td>
                        <td class="col-7">{{$report->dress}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">Hair</td>
                        <td class="col-7">{{$report->hair}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">Nails</td>
                        <td class="col-7">{{$report->nails}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">Neatness</td>
                        <td class="col-7">{{$report->neatness}}</td>
                    </tr>
                    <tr>
                        <td class="col-4">Punctuality</td>
                        <td class="col-7">{{$report->punctuality}}</td>
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
                        <td>{{$report->height_start}} cm</td>
                        <td>{{$report->height_end}} cm</td>
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
                        <td class="text-center pt-5"><strong>{{\Carbon\Carbon::parse($report->date)->format('F jS, Y')}}</strong></td>
                        <td class="text-center">
                            <img src="{{public_path('img/signature.png')}}" width="80px" height="80px" alt="Sign" srcset="">
                            <h6>Anne Beesong</h6>
                            <p>(Head of School)</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection