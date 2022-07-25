@extends('layouts.base')
@section('title', 'Teachers')
@section('page-heading', 'All Teachers')

@section('page-content') 
    <div class="deshboard_booking_main_content_area">
        <div class="deshboard_booking_main_content_area_container">
            <a href="{{route('add-teacher')}}" class="crate_btn_area">+ Add a Teacher</a>
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
                            <th>Photo</th>
                            <th>Full Name</th>
                            <th>Class</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 1.Single item area start  -->
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td class="amdin_pay_img"><img src="{{asset('uploads/teachers/'.$teacher->user->photo)}}" alt=""></td>
                                <td>{{$teacher->firstname}} {{$teacher->lastname}}</td>
                                <td>@title($teacher->subclass)-@title($teacher->class_group)</td>
                                <td>{{$teacher->gender}}</td>
                                <td>{{$teacher->phone}}</td>
                                <td>{{$teacher->user->email}}</td>
                                @can('is-admin')
                                    <td class="text-center">
                                        <a href="{{route('edit-teacher', $teacher->id)}}"><i class="fa-solid fa-pen-to-square fa-lg mr-4 blue"></i></a>
                                        <span data-toggle="modal" data-target="#deleteTeacher{{$teacher->id}}Modal"><i class="fa-solid fa-trash mr-4 fa-lg red"></i></span>
                                    </td>
                                    {{-- delete confirmation --}}
                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-sm" id="deleteTeacher{{$teacher->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete teacher</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{$teacher->firstname}} {{$teacher->lastname}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-style btn-sm" data-dismiss="modal">Cancel</button>
                                                    <form action="{{route('delete-teacher', $teacher->id)}}" method="post">
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
                    <form action="{{route('pupils')}}" method="get">
                        <div class="table_pagination_area_left_sub">
                        <p>Rows per page:</p>
                            <select name="per_page" id="per_page" onchange="this.form.submit()">
                                <option value="15" selected disabled>{{ $teachers->perpage() }}</option>
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
                        <li>{{$teachers->firstItem()}}-{{$teachers->lastItem()}} of {{$teachers->total()}}</li>
                        <li><a href="{{$teachers->previousPageUrl()}}"><i class="fas fa-angle-left"></i></a></li>
                        <li><a href="{{$teachers->nextPageUrl()}}"><i class="fas fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection