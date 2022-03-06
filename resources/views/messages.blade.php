@extends('layouts.base')
@section('title', 'Messages')
@section('page-heading', 'Messages')

@section('page-content')
    <div class="deshboard_booking_main_content_area">
        <div class="deshboard_booking_main_content_area_container">
            @can('is-admin')
                <a href="{{route('add-message')}}" class="crate_btn_area">+ Add a Message</a>
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
                    @if (!$messages->isEmpty())
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Subject</th>
                                @can('is-admin')
                                    <th>To</th>
                                @endcan
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($messages as $message)
                                    <!-- 1.Single item area start  -->
                                    <tr>
                                        <td>{{\Carbon\Carbon::parse($message->date)->format('d M Y')}}</td>
                                        <td>{{$message->subject}}</td>
                                        @can('is-admin')
                                            <td>{{$message->recipient->fullname}}</td>
                                        @endcan
                                        <td class="text-center">
                                            <a href="{{route('view-message', $message->id)}}"><i class="fa-solid fa-eye fa-lg mr-4"></i></a>    
                                        </td>
                                    </tr>
                                @endforeach   
                        </tbody>
                    </table>
                    @else
                        <p class="text-center">There are no messages for you at this time.</p>
                    @endif
                </div>
                <div class="table_pagination_area">
                    <div class="table_pagination_area_left">
                        <form action="{{route('messages')}}" method="get">
                            <div class="table_pagination_area_left_sub">
                            <p>Rows per page:</p>
                                <select name="per_page" id="per_page" onchange="this.form.submit()">
                                    <option value="15" selected disabled>{{ $messages->perpage() }}</option>
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
                            <li>{{$messages->firstItem()}}-{{$messages->lastItem()}} of {{$messages->total()}}</li>
                            <li><a href="{{$messages->previousPageUrl()}}"><i class="fas fa-angle-left"></i></a></li>
                            <li><a href="{{$messages->nextPageUrl()}}"><i class="fas fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
@endsection