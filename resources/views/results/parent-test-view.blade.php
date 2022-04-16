@extends('results.parent-view-base')
@section('title', 'View test')
@section('page-heading', 'View test')

@section('page-content') 
    <div class="deshboard_booking_main_content_area ">
        <div class="deshboard_booking_main_content_area_container">
            <div class="row">
                <div class="sidebar-brand col-4">
                    <a href="index.html">
                        <span class="logo-name"><img class="mb-0" src="{{asset('img/logo.png')}}"  width="70px"/></span>
                    </a>
                </div>
                <h4 class="text-blue my-auto col-7"><strong>{{$test->term->session}} {{$test->term->name}} (CA {{$test->test_no}}) REPORT</strong></h4>
            </div>
            <!-- Header area End  -->
            <div class="deshboard_main_edit_task_area table mt-5 pb-5">
                <div class="row mb-5">
                    <img src="{{asset('uploads/pupils/'.$test->pupil->photo)}}" alt="" class="col-md-4">
                    <div class="col-md-8">
                        <table class='pupil-details-table'>
                            <tbody> 
                                <tr>
                                    <td><strong>Pupil's Name: </strong>{{$test->pupil->lastname}} {{$test->pupil->firstname}}</td>
                                    <td><strong>Admission Number: </strong>{{$test->pupil->admission_no}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Class: </strong>{{$test->pupil->class}}</td>
                                    <td><strong>Term: </strong>{{$test->term->name}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Class Average Age: </strong></td>
                                    <td><strong>Date: </strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Teacher's Name: </strong></td>
                                    <td><strong>Age: </strong>{{$test->pupil->age}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <h6 class="text-end text-blue mb-3">Maximum Score</h6>
                <table class="pupil-result-table">
                    <thead>
                        <th>S/N</th>
                        <th>SUBJECT</th>
                        <th>SCORE</th>
                        <th>GRADE</th>
                        <th>REMARK</th>
                    </thead>
                    <tbody>
                        @foreach($test->testResults as $result)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$result->subject->name}}</td>
                            <td>{{$result->score}}</td>
                            <td>{{$result->grade}}</td>
                            <td>{{$result->remark}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="pupil-result-table mt-5">
                    <tbody>
                        <tr>
                            <td><strong>TOTAL(max )</strong></td>
                            <td><strong></strong></td>
                            <td class="text-center pt-5" rowspan="2"><strong>March 7 2022</strong></td>
                            <td class="text-center" rowspan="2">
                                <img src="{{asset('img/signature.png')}}" width="80px" height="80px" alt="Sign" srcset="">
                                <h6>Anne Beesong</h6>
                                <p>(Head of School)</p>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>PERCENTAGE TOTAL(max %)</strong></td>
                            <td><strong></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection