@extends('layouts.base')
@section('title', 'Homeworks')
@section('page-heading', 'Homeworks')

@section('page-content')
    <div class="deshboard_booking_main_content_area">
        <div class="deshboard_booking_main_content_area_container">
            @can('is-admin')
                <a href="{{route('add-homework')}}" class="crate_btn_area">+ Add Homework</a>
            @endcan
            <!-- Header area start  -->
            <div class="deshboard_filter_area">
                <h4></h4>
                <ul>
                    <li><a href="#"><img src="{{asset('img/sort.svg')}}" alt="photos">Sort</a></li>
                    <li><a href="#"><img src="{{asset('img/filter.svg')}}" alt="photos">Filter</a></li>
                </ul>
            </div>
            <!-- Header area End  -->
            <div class="deshboard_main_edit_task_area table">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Homework</th>
                            <th>Class</th>
                            <th>Submission Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 1.Single item area start  -->
                        @foreach($homeworks as $homework)
                        <tr>
                            <td>{{$homework->date}}</td>
                            <td>{{Str::limit($homework->homework, 60)}}</td>
                            <td>{{$homework->class}}</td>
                            <td>{{$homework->submission_date}}</td>
                            <td>
                                <a href="{{route('view-homework', $homework->id)}}" class="btn-style">View</a>
                                @can('is-admin')
                                    <a href="{{route('edit-homework', $homework->id)}}" class="btn-style">Edit</a>
                                    <button class="btn-style btn-style-danger" data-toggle="modal" data-target="#deleteHomework{{$homework->id}}Modal">delete</button>
                                @endcan
                            </td>
                            @can('is-admin')
                                {{-- delete confirmation --}}
                                <!-- Modal -->
                                <div class="modal fade bd-example-modal-sm" id="deleteHomework{{$homework->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Sure to delete this homework?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"></div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-style btn-sm" data-dismiss="modal">Cancel</button>
                                                <form action="{{route('delete-homework', $homework->id)}}" method="post">
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
            </div>
            <div class="table_pagination_area">
                <div class="table_pagination_area_left">
                    <form action="{{route('homeworks')}}" method="get">
                        <div class="table_pagination_area_left_sub">
                        <p>Rows per page:</p>
                            <select name="per_page" id="per_page" onchange="this.form.submit()">
                                <option value="15" selected disabled>{{ $homeworks->perpage() }}</option>
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
                        <li>{{$homeworks->firstItem()}}-{{$homeworks->lastItem()}} of {{$homeworks->total()}}</li>
                        <li><a href="{{$homeworks->previousPageUrl()}}"><i class="fas fa-angle-left"></i></a></li>
                        <li><a href="{{$homeworks->nextPageUrl()}}"><i class="fas fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection