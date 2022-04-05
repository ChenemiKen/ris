@extends('results.base')
@section('title', 'View report')
@section('page-heading', 'Term report')

@section('page-content') 
    <div class="deshboard_booking_main_content_area pt-0">
        <div class="deshboard_booking_main_content_area_container">
            <!-- Header area End  -->
            <div class="deshboard_main_edit_task_area table pt-4 ">
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
                <h5 class="text-end mb-3">Maximum Score</h5>
                <table class="pupil-result-table">
                    <thead>
                        <th>Subject</th>
                        <th>1st Test</th>
                        <th>2nd Test</th>
                        <th>3rd Test</th>
                        <th>4th Test</th>
                        <th>Exam</th>
                        <th>Mark %</th>
                        <th>Grade</th>
                        <th>Effort Grade</th>
                        <th>Teacher's Comment</th>
                    </thead>
                    <tbody>
                        @foreach($report->termResults as $result)
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
                            <td>{{$result->remark}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <h5>Attendance</h5>
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
            </div>
        </div>
    </div>
@endsection
