@extends('results.base')
@section('title', 'Test Results')
@section('page-heading', 'Test Results')

@section('page-content')
    <div class="deshboard_booking_main_content_area">
        <div class="deshboard_booking_main_content_area_container">
            @can('is-admin')
                <div class="text-right">
                    <a href="{{route('add-test')}}" class="crate_btn_area">+ Add Test Result</a>
                </div>
            @endcan
            <!-- Header area start  -->
            <form action={{route('tests')}} name="filter-form" method="get">
                @csrf
                <img src="{{asset('img/filter.svg')}}" width="25px" height="25px" alt="photos">
                <div class="deshboard_main_top_edit_area_single_item col-md-6" style="display:inline-block">
                    <div class="row">
                        <div class="col">
                            <select name="term" class="form-control" onchange="this.form.submit()">
                                <option value="" selected hidden="">Select Term</option>
                                <option value="all" {{ request('term') == 'all' ? "selected" : "" }}>All terms</option>
                                @foreach($terms as $term)
                                    <option value={{$term->id}} {{request('term') == $term->id ? "selected" : "" }}>{{$term->name}}{{$term->session}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select name="test" class="form-control" onchange="this.form.submit()" class="col">
                                <option value="" selected hidden="">Select Class</option>
                                <option value="all" {{ request('test') == 'all' ? "selected" : "" }}>All tests</option>
                                <option value="1" {{ request('test') == '1' ? "selected" : "" }}>1st test</option>
                                <option value="2" {{ request('test') == '2' ? "selected" : "" }}>2nd test</option>
                                <option value="3" {{ request('test') == '3' ? "selected" : "" }}>3rd test</option>
                                <option value="4" {{ request('test') == '4' ? "selected" : "" }}>4th test</option>
                            </select>
                        </div>
                    </div>                                                            
                </div>
            </form>
            <!-- Header area End  -->
            <div class="deshboard_main_edit_task_area table">
                @if (!$tests->isEmpty())
                <table>
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Pupil</th>
                            <th>Admission No.</th>
                            <th>Test</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tests as $test)
                            <!-- 1.Single item area start  -->
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$test->pupil->firstname}} {{$test->pupil->lastname}}</td>
                                <td>{{$test->pupil->admission_no}}</td>
                                <td>{{$test->term->name}} Term-@th($test->test_no)</td>
                                <td class="text-center">
                                    <a href="{{route('view-test',$test->id)}}"><i class="fa-solid fa-eye fa-lg mr-4"></i></a>
                                    @can('is-admin')
                                        <a href="{{route('edit-test', $test->id)}}"><i class="fa-solid fa-pen-to-square fa-lg mr-4 blue"></i></a>
                                        <span data-toggle="modal" data-target="#deleteTest{{$test->id}}Modal"><i class="fa-solid fa-trash fa-lg red"></i></span>
                                    @endcan
                                </td>
                                @can('is-admin')
                                    {{-- delete confirmation --}}
                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-sm" id="deleteTest{{$test->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Test result for</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{$test->pupil->firstname}} {{$test->pupil->lastname}}</p>
                                                    <p>{{$test->pupil->admission_no}}</p>
                                                    <p>{{$test->term->name}} Term</p>
                                                    <p>@th($test->test_no) test</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-style btn-sm" data-dismiss="modal">Cancel</button>
                                                    <form action="{{route('delete-test', $test->id)}}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn-style btn-style-danger">delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p class="text-center">There are no results added for {{Auth::user()->username}} at this time.</p>
                @endif
            </div>
            <div class="table_pagination_area">
                <div class="table_pagination_area_left">
                    <form action="{{route('tests')}}" method="get">
                        <div class="table_pagination_area_left_sub">
                        <p>Rows per page:</p>
                            <select name="per_page" id="per_page" onchange="this.form.submit()">
                                <option value="15" selected disabled>{{ $tests->perpage() }}</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="table_pagination_area_right">
                    <ul>
                        <li>{{$tests->firstItem()}}-{{$tests->lastItem()}} of {{$tests->total()}}</li>
                        <li><a href="{{$tests->previousPageUrl()}}"><i class="fas fa-angle-left"></i></a></li>
                        <li><a href="{{$tests->nextPageUrl()}}"><i class="fas fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection