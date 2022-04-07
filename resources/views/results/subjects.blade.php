@extends('results.base')
@section('title', 'Subjects')
@section('page-heading', 'Subjects')

@section('page-content')
    <div class="deshboard_booking_main_content_area">
        <div class="deshboard_booking_main_content_area_container">
            @can('is-admin')
                <div class="text-right"><a href="{{route('add-subject')}}" class="crate_btn_area">+ Add subject</a></div>
            @endcan
            <!-- Header area start  -->
            <form action={{route('subjects')}} name="filter-form" method="get">
                @csrf
                <img src="{{asset('img/filter.svg')}}" width="25px" height="25px" alt="photos">
                <div class="deshboard_main_top_edit_area_single_item col-md-4" style="display:inline-block">
                    <select name="class" class="form-control" onchange="this.form.submit()">
                        <option value="" selected hidden="">Select Class</option>
                        <option value="all" {{ request('class') == 'all' ? "selected" : "" }}>All Classes</option>
                        <option value="primary_1" {{ request('class') == 'primary_1' ? "selected" : "" }}>Primary 1</option>
                        <option value="primary_2" {{ request('class') == 'primary_2' ? "selected" : "" }}>Primary 2</option>
                        <option value="primary_3" {{ request('class') == 'primary_3' ? "selected" : "" }}>Primary 3</option>
                        <option value="primary_4" {{ request('class') == 'primary_4' ? "selected" : "" }}>Primary 4</option>
                        <option value="primary_5" {{ request('class') == 'primary_5' ? "selected" : "" }}>Primary 5</option>
                        <option value="primary_6" {{ request('class') == 'primary_6' ? "selected" : "" }}>Primary 6</option>
                    </select>                                
                </div>
            </form>
            <!-- Header area End  -->
            <div class="deshboard_main_edit_task_area table">
                @if (!$subjects->isEmpty())
                <table>
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Subjects</th>
                            <th>Maximum Score</th>
                            <th><strong>Action</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subjects as $subject)
                            <!-- 1.Single item area start  -->
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$subject->name}}</td>
                                <td>{{$subject->max_score}}</td>
                                <td class="text-center">
                                    @can('is-admin')
                                        <a href="{{route('edit-subject', $subject->id)}}"><i class="fa-solid fa-pen-to-square fa-lg mr-4 blue"></i></a>
                                        <span data-toggle="modal" data-target="#deleteSubject{{$subject->id}}Modal"><i class="fa-solid fa-trash fa-lg red"></i></span>
                                    @endcan
                                </td>
                                @can('is-admin')
                                    {{-- delete confirmation --}}
                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-sm" id="deleteSubject{{$subject->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Subject?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{$subject->name}}</p>
                                                    <p><strong>Max Score: </strong>{{$subject->max_score}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-style btn-sm" data-dismiss="modal">Cancel</button>
                                                    <form action="{{route('delete-subject', $subject->id)}}" method="post">
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
                    <p class="text-center">There are no subjects available.</p>
                @endif
            </div>
            <div class="table_pagination_area">
                <div class="table_pagination_area_left">
                    <form action="{{route('subjects')}}" method="get">
                        <div class="table_pagination_area_left_sub">
                        <p>Rows per page:</p>
                            <select name="per_page" id="per_page" onchange="this.form.submit()">
                                <option value="15" selected disabled>{{ $subjects->perpage() }}</option>
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
                        <li>{{$subjects->firstItem()}}-{{$subjects->lastItem()}} of {{$subjects->total()}}</li>
                        <li><a href="{{$subjects->previousPageUrl()}}"><i class="fas fa-angle-left"></i></a></li>
                        <li><a href="{{$subjects->nextPageUrl()}}"><i class="fas fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection