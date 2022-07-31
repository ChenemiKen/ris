@extends('results.base')
@section('title', 'Skills')
@section('page-heading', 'Skills')

@section('page-content')
    <div class="deshboard_booking_main_content_area">
        <div class="deshboard_booking_main_content_area_container">
            @can('is-admin')
                <div class="text-right"><a href="{{route('add-skill')}}" class="crate_btn_area">+ Add skill</a></div>
            @endcan
            <!-- Header area start  -->
            <form action={{route('skills')}} name="filter-form" method="get">
                @csrf
                <img src="{{asset('img/filter.svg')}}" width="25px" height="25px" alt="photos">
                <div class="deshboard_main_top_edit_area_single_item col-md-4" style="display:inline-block">
                    <select name="class" class="form-control" onchange="this.form.submit()">
                        <option value="" selected hidden="">Select Class</option>
                        <option value="all" {{ request('class') == 'all' ? "selected" : "" }}>All Classes</option>
                        <option value="nursery" {{ request('class') == 'nursery' ? "selected" : "" }}>Nursery</option>
                        <option value="lower_primary" {{ request('class') == 'lower_primary' ? "selected" : "" }}>Lower primary</option>
                        <option value="upper_primary" {{ request('class') == 'upper_primary' ? "selected" : "" }}>Upper primary</option>
                        <option value="beacon" {{ request('class') == 'beacon' ? "selected" : "" }}>Beacon</option>
                        <option value="playgroup" {{ request('class') == 'playgroup' ? "selected" : "" }}>Playgroup</option>
                    </select>                                
                </div>
            </form>
            <!-- Header area End  -->
            <div class="deshboard_main_edit_task_area table">
                @if (!$skills->isEmpty())
                <table>
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Skills</th>
                            <th>Category</th>
                            <th>Class</th>
                            <th><strong>Action</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($skills as $skill)
                            <!-- 1.Single item area start  -->
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$skill->name}}</td>
                                <td>{{$skill->skill_category->name}}</td>
                                <td>{{$skill->class}}</td>
                                <td class="text-center">
                                    @can('is-admin')
                                        <a href="{{route('edit-skill', $skill->id)}}"><i class="fa-solid fa-pen-to-square fa-lg mr-4 blue"></i></a>
                                        <span data-toggle="modal" data-target="#deleteSkill{{$skill->id}}Modal"><i class="fa-solid fa-trash fa-lg red"></i></span>
                                    @endcan
                                </td>
                                @can('is-admin')
                                    {{-- delete confirmation --}}
                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-sm" id="deleteSkill{{$skill->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Skill?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{$skill->name}}</p>
                                                    <p><strong>Category: </strong>{{$skill->skill_category->name}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-style btn-sm" data-dismiss="modal">Cancel</button>
                                                    <form action="{{route('delete-skill', $skill->id)}}" method="post">
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
                    <p class="text-center">There are no skills available.</p>
                @endif
            </div>
            <div class="table_pagination_area">
                <div class="table_pagination_area_left">
                    <form action="{{route('subjects')}}" method="get">
                        <div class="table_pagination_area_left_sub">
                        <p>Rows per page:</p>
                            <select name="per_page" id="per_page" onchange="this.form.submit()">
                                <option value="15" selected disabled>{{ $skills->perpage() }}</option>
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
                        <li>{{$skills->firstItem()}}-{{$skills->lastItem()}} of {{$skills->total()}}</li>
                        <li><a href="{{$skills->previousPageUrl()}}"><i class="fas fa-angle-left"></i></a></li>
                        <li><a href="{{$skills->nextPageUrl()}}"><i class="fas fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection