@extends('results.primary.base')
@section('title', 'View report')
@section('page-heading', 'Term report')

@section('page-content') 
    <div class="deshboard_booking_main_content_area pt-0">
        <div class="deshboard_booking_main_content_area_container">
            <!-- Header area End  -->
            <div class="deshboard_main_edit_task_area table pt-4 pb-5">
                <h5 class="text-blue mb-5">{{$report->term->session}} {{$report->term->name}} TERM REPORT</h5>
                <div class="row mb-5">
                    <img src="{{asset('uploads/pupils/'.$report->pupil->photo)}}" alt="" class="col-md-4">
                    <div class="col-md-8">
                        <table class='pupil-details-table'>
                            <tbody> 
                                <tr>
                                    <td><strong>Pupil's Name: </strong>{{$report->pupil->lastname}} {{$report->pupil->firstname}}</td>
                                    <td><strong>Admission Number: </strong>{{$report->pupil->admission_no}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Class: </strong>@title($report->pupil->subclass)-@title($report->pupil->class_group)</td>
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
                <h5 class="text-end mb-3">Maximum Score</h5>
                <table class="pupil-result-table">
                    <thead>
                        <th>Subject</th>
                        <th>1st Test</th>
                        <th>2nd Test</th>
                        <th>3rd Test</th>
                        <th>4th Test</th>
                        <th>Exam <br>(max 60)</th>
                        <th>Mark % <br>(max 100)</th>
                        <th>Grade</th>
                        <th>Effort Grade</th>
                        <th>Teacher's Comment</th>
                    </thead>
                    <tbody>
                        @foreach($report->primaryTermResults as $result)
                        <tr>
                            <td>{{$result->subject->name}}</td>
                            <td>{{$result->test_1}}</td>
                            <td>{{$result->test_2}}</td>
                            <td>{{$result->test_3}}</td>
                            <td>{{$result->test_4}}</td>
                            <td>{{$result->exam}}</td>
                            <td>{{$result->percentage}}</td>
                            <td>{{$result->grade}}</td>
                            <td>{{$result->effort_grade}}</td>
                            <td>@title($result->remark)</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <h6 class="text-blue mt-5 mb-2">ATTENDANCE</h6>
                <table class="pupil-result-table">
                    <thead>
                        <th></th>
                        <th>SCHOOL</th>
                        <th>SPORTS</th>
                        <th>OTHER ORGANIZED ACTIVITIES</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>No. of times school opened</td>
                            <td>{{$report->times_school_opened}}</td>
                            <td>{{$report->sports_1}}</td>
                            <td>{{$report->other_event_1}}</td>
                        </tr>
                        <tr>
                            <td>No. of times present</td>
                            <td>{{$report->times_present}}</td>
                            <td>{{$report->sports_2}}</td>
                            <td>{{$report->other_event_2}}</td>
                        </tr>
                        <tr>
                            <td>No. of times punctual</td>
                            <td>{{$report->times_punctual}}</td>
                            <td>{{$report->sports_3}}</td>
                            <td>{{$report->other_event_3}}</td>
                        </tr>
                    </tbody>
                </table>
                <h6 class="text-blue mt-5 mb-2">CONDUCT</h6>
                <table class="pupil-result-table">
                    <thead>
                        <th>GOOD</th>
                        <th>BAD CONDUCT</th>
                        <th>EXAMPLARY CONDUCT</th>
                        <th>COMMENTS</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$report->conduct_good}}</td>
                            <td>{{$report->conduct_bad}}</td>
                            <td>{{$report->conduct_exemplary}}</td>
                            <td>{{$report->conduct_comment}}</td>
                        </tr>
                    </tbody>
                </table>
                <h6 class="text-blue mt-5 mb-2">PHYSICAL DEVELOPMENT, HEALTH AND CLEANLINESS</h6>
                <table class="pupil-result-table">
                    <thead>
                        <th></th>
                        <th>BEGINING OF TERM</th>
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
                        <tr>
                            <td>No. of times absent due to illness</td>
                            <td>{{$report->illness_days}}</td>
                            <td>{{$report->nature_of_illness}}</td>
                        </tr>
                        <tr>
                            <td>Cleanliness Rating</td>
                            <td colspan="2">{{$report->cleanliness_rating}}</td>
                        </tr>
                        <tr>
                            <td>Remarks</td>
                            <td colspan="2">@title($report->cleanliness_remark)</td>
                        </tr>
                    </tbody>
                </table>
                <h6 class="text-blue mt-5 mb-2">SPORTS</h6>
                <table class="pupil-result-table">
                    <thead>
                        <th>EVENTS</th>
                        <th>BALL GAMES</th>
                        <th>TRACKS</th>
                        <th>JUMPS</th>
                        <th>THROWS</th>
                        <th>SWIMMING</th>
                        <th>OTHERS</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Level attained</td>
                            <td>@title($report->ball_games)</td>
                            <td>@title($report->tracks)</td>
                            <td>@title($report->jumps)</td>
                            <td>@title($report->throws)</td>
                            <td>@title($report->swimming)</td>
                            <td>@title($report->others)</td>
                        </tr>
                    </tbody>
                </table>
                <h6 class="text-blue mt-5 mb-2">CLUBS</h6>
                <table class="pupil-result-table">
                    <thead>
                        <th>ORGANISATION</th>
                        <th>OFFICE HELD</th>
                        <th>SIGNIFICANT CONTRIBUTION</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$report->organisation}}</td>
                            <td>{{$report->organisation_office}}</td>
                            <td>{{$report->organisation_contribution}}</td>
                        </tr>
                    </tbody>
                </table>
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
                                <img src="{{asset('img/signature.png')}}" width="80px" height="80px" alt="Sign" srcset="">
                                <h6>Anne Beesong</h6>
                                <p>(Head of School)</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row"><div class="col mt-3"><a href="{{route('download-primary-report', $report->id)}}" class="btn btn-disable float-right">Download PDF</a></div></div>
    </div>
@endsection