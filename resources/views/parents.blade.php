@extends('layouts.base')
@section('title', 'Parents')
@section('page-heading', 'All Parents')

@section('page-content') 
    <div class="deshboard_booking_main_content_area">
        <div class="deshboard_booking_main_content_area_container">
            <a href="{{route('add-parent')}}" class="crate_btn_area">+ Add a Parent</a>
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
                            <th>Full Name</th>
                            <th>Admission No.</th>
                            <th>Contact Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 1.Single item area start  -->
                        @foreach ($parents as $parent)
                            <tr>
                                <td>{{$parent->fullname}}</td>
                                <td>{{$parent->username}}</td>
                                <td>{{$parent->address}}</td>
                                <td>{{$parent->email}}</td>
                                <td>{{$parent->phone}}</td>
                                <td>
                                    <a href="{{route('edit-parent', $parent->id)}}" class="btn-style">Edit</a>
                                    <button class="btn-style btn-style-danger" data-toggle="modal" data-target="#deleteParent{{$parent->id}}Modal">delete</button>
                                </td>
                                {{-- delete confirmation --}}
                                <!-- Modal -->
                                <div class="modal fade bd-example-modal-sm" id="deleteParent{{$parent->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Parent</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{$parent->fullname}}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-style btn-sm" data-dismiss="modal">Cancel</button>
                                                <form action="{{route('delete-parent', $parent->id)}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn-style btn-style-danger">delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <div class="table_pagination_area">
                    <div class="table_pagination_area_left">
                        <form action="{{route('parents')}}" method="get">
                            <div class="table_pagination_area_left_sub">
                            <p>Rows per page:</p>
                                <select name="per_page" id="per_page" onchange="this.form.submit()">
                                    <option value="15" selected disabled>{{ $parents->perpage() }}</option>
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
                            <li>{{$parents->firstItem()}}-{{$parents->lastItem()}} of {{$parents->total()}}</li>
                            <li><a href="{{$parents->previousPageUrl()}}"><i class="fas fa-angle-left"></i></a></li>
                            <li><a href="{{$parents->nextPageUrl()}}"><i class="fas fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
@endsection