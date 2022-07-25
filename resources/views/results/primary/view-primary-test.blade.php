@extends('results.primary.base')
@section('title', 'View test')
@section('page-heading', 'View test')

@section('page-content') 
    <div class="deshboard_booking_main_content_area pt-0">
        <div class="deshboard_booking_main_content_area_container">
            <!-- Header area End  -->
            <div class="deshboard_main_edit_task_area table pt-4 pb-5">
                <h5 class="text-blue mb-5">{{$test->term->session}} {{$test->term->name}} (CA {{$test->test_no}}) REPORT</h5>
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
                                    <td><strong>Class: </strong>@title($test->pupil->subclass)-@title($test->pupil->class_group)</td>
                                    <td><strong>Term: </strong>{{$test->term->name}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Class Average Age: </strong></td>
                                    <td><strong>Date: </strong>{{$test->date}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Teacher's Name: </strong>{{$test->teacher->firstname ?? ''}} {{$test->teacher->lastname ?? ''}}</td>
                                    <td><strong>Age: </strong>{{$test->pupil->age()}}</td>
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
                        @foreach($test->primaryTestResults as $result)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$result->subject->name}}</td>
                            <td>{{$result->score}}</td>
                            <td>{{$result->grade}}</td>
                            <td>@title($result->remark)</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="pupil-result-table mt-5">
                    <tbody>
                        <tr>
                            <td class="pt-5" rowspan="2"><strong>TOTAL(max )</strong></td>
                            <td class="text-center pt-5" rowspan="2"><strong>{{\Carbon\Carbon::parse($test->date)->format('F jS, Y')}}</strong></td>
                            <td class="text-center" rowspan="2">
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