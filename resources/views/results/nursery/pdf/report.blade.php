@extends('results.primary.pdf.base')
@section('title', 'View nursery report')
@section('page-heading', 'Nursery Term report')

@section('page-content') 
    <div class="deshboard_booking_main_content_area pt-0">
        <div class="deshboard_main_edit_task_area table mt-0 pt-3">
            <h5 class="text-blue mb-5">{{$report->term->session}} {{$report->term->name}} TERM REPORT</h5>
            <div class="row mb-5">
                <img src="{{public_path('uploads/pupils/'.$report->pupil->photo)}}" alt="" class="col-md-4 dtable">
                <div class="col-md-7 dtable">
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
            <div style="clear: both;">
            {{-- Attendance section --}}
            <h4 class="text-start text-blue mb-3 max-score">Term Attendance</h4>
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
            @foreach($skill_categories as $category)
                <h4 class="text-blue mt-5 mb-2">{{$category->name}}</h4>
                <table class="pupil-result-table">
                    <thead>
                        <th>S/N</th>
                        <th>SKILL</th>
                        <th>ASSESMENT</th>
                        <th>EFFORT GRADE</th>
                        <th>REMARK</th>
                    </thead>
                    <tbody>
                        @php $count = 0; @endphp
                        @foreach($report->nurserySkillResults as $skill_result)
                            <tr>
                                @if($skill_result->skill_category->id == $category->id)
                                @php $count +=1; @endphp
                                    <td>{{$count}}</td>
                                    <td>{{$skill_result->skill->name}}</td>
                                    <td>{{$skill_result->grade}}</td>
                                    <td>{{$skill_result->effort_grade}}</td>
                                    <td>@title($skill_result->remark)</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach

            {{-- Subjects table --}}
            <h4 class="text-blue mt-5 mb-2">Exam Score</h4>
            <table class="pupil-result-table">
                <thead>
                    <th>Subject</th>
                    <th>Grade</th>
                    <th>Remark</th>
                </thead>
                <tbody>
                    @foreach($report->nurserySubjectResults as $result)
                    <tr>
                        <td>{{$result->subject->name}}</td>
                        <td>{{$result->score}}</td>
                        <td>{{$result->remark}}</td>
                    </tr>
                    @endforeach
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