@extends('results.playgroup.base')
@section('title', 'Playgroup Term Reports')
@section('page-heading', 'Playgroup Term Reports')

@section('page-content')
    <div class="deshboard_booking_main_content_area">
        <div class="deshboard_booking_main_content_area_container">
            @can('is-staff')
                <div class="text-right">
                    <a href="{{route('add-playgroup-report')}}" class="crate_btn_area">+ Add Term Report</a>
                </div>
            @endcan
            <!-- Header area start  -->
            <form action={{route('playgroup-reports')}} name="filter-form" method="get">
                @csrf
                <img src="{{asset('img/filter.svg')}}" width="25px" height="25px" alt="photos">
                <div class="deshboard_main_top_edit_area_single_item col-md-4" style="display:inline-block">
                    <div class="row">
                        <div class="col">
                            <select name="term" class="form-control" onchange="this.form.submit()">
                                <option value="" selected hidden="">Select Term</option>
                                <option value="all" {{ request('term') == 'all' ? "selected" : "" }}>All terms</option>
                                @foreach($terms as $term)
                                    <option value={{$term->id}} {{request('term') == $term->id ? "selected" : "" }}>{{$term->name}} {{$term->session}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                                                            
                </div>
            </form>
            <!-- Header area End  -->
            <div class="deshboard_main_edit_task_area table">
                @if (!$reports->isEmpty())
                <table>
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Pupil</th>
                            <th>Admission No.</th>
                            <th>Report</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                            <!-- 1.Single item area start  -->
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$report->pupil->firstname}} {{$report->pupil->lastname}}</td>
                                <td>{{$report->pupil->admission_no}}</td>
                                <td>{{$report->term->name}} Term Report</td>
                                <td class="text-center">
                                    <a href="{{route('view-playgroup-report',$report->id)}}"><i class="fa-solid fa-eye fa-lg mr-4"></i></a>
                                    @can('is-staff')
                                        <a href="{{route('edit-playgroup-report', $report->id)}}"><i class="fa-solid fa-pen-to-square fa-lg mr-4 blue"></i></a>
                                        <span data-toggle="modal" data-target="#deleteReport{{$report->id}}Modal"><i class="fa-solid fa-trash fa-lg red"></i></span>
                                    @endcan
                                </td>
                                @can('is-staff')
                                    {{-- delete confirmation --}}
                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-sm" id="deleteReport{{$report->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Term report for</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>{{$report->pupil->firstname}} {{$report->pupil->lastname}}</p>
                                                    <p>{{$report->pupil->admission_no}}</p>
                                                    <p>{{$report->term->name}} Term</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-style btn-sm" data-dismiss="modal">Cancel</button>
                                                    <form action="{{route('delete-playgroup-report', $report->id)}}" method="post">
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
                    <form action="{{route('playgroup-reports')}}" method="get">
                        <div class="table_pagination_area_left_sub">
                        <p>Rows per page:</p>
                            <select name="per_page" id="per_page" onchange="this.form.submit()">
                                <option value="15" selected disabled>{{ $reports->perpage() }}</option>
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
                        <li>{{$reports->firstItem()}}-{{$reports->lastItem()}} of {{$reports->total()}}</li>
                        <li><a href="{{$reports->previousPageUrl()}}"><i class="fas fa-angle-left"></i></a></li>
                        <li><a href="{{$reports->nextPageUrl()}}"><i class="fas fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection