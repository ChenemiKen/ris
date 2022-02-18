@extends('layouts.base')
@section('title', 'Pupils')
@section('page-heading', 'All Pupils')

@section('page-content') 
    <div class="deshboard_booking_main_content_area">
        <div class="deshboard_booking_main_content_area_container">
            <a href="/add-pupil" class="crate_btn_area">+ Add a Pupil</a>
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
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Parent Phone</th>
                            <th>Parent Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 1.Single item area start  -->
                        <div class="container">
                            @foreach ($pupils as $pupil)
                                <tr>
                                    <td class="amdin_pay_img"><img src="{{asset('uploads/pupils/'.$pupil->photo)}}" alt=""></td>
                                    <td>{{$pupil->firstname}} {{$pupil->lastname}}</td>
                                    <td>{{$pupil->class}}</td>
                                    <td>{{$pupil->age}}</td>
                                    <td>{{$pupil->gender}}</td>
                                    <td>{{$pupil->parent_phone}}</td>
                                    <td>{{$pupil->parent_email}}</td>
                                    <td>
                                        <a href="#" class="btn-style">View</a>
                                        <a href="{{route('edit-pupil', $pupil->id)}}" class="btn-style">Edit</a>
                                        <button class="btn-style btn-style-danger" data-toggle="modal" data-target="#deletePupil{{$pupil->id}}Modal">delete</button>
                                    </td>
                                    {{-- delete confirmation --}}
                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-sm" id="deletePupil{{$pupil->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete pupil</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{$pupil->firstname}} {{$pupil->lastname}}</p>
                                                    <p>{{$pupil->admission_no}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-style btn-sm" data-dismiss="modal">Cancel</button>
                                                    <form action="{{route('delete-pupil', $pupil->id)}}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn-style btn-style-danger">delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                
                            @endforeach
                            
                        </div>
                        <!-- 2.Single item area start  -->
                    </tbody>
                </table>
            </div>
            <div class="table_pagination_area">
                <div class="table_pagination_area_left">
                    <form action="{{route('pupils')}}" method="get">
                        <div class="table_pagination_area_left_sub">
                        <p>Rows per page:</p>
                            <select name="per_page" id="per_page" onchange="this.form.submit()">
                                <option value="15" selected disabled>{{ $pupils->perpage() }}</option>
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
                        <li>{{$pupils->firstItem()}}-{{$pupils->lastItem()}} of {{$pupils->total()}}</li>
                        <li><a href="{{$pupils->previousPageUrl()}}"><i class="fas fa-angle-left"></i></a></li>
                        <li><a href="{{$pupils->nextPageUrl()}}"><i class="fas fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
