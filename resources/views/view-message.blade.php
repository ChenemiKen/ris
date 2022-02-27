@extends('layouts.base')
@section('title', 'View message')
@section('page-heading', 'View Message')

@section('page-content') 
    <div class="deshboard_booking_main_content_area">
        <div class="deshboard_booking_main_content_area_container">
            {{-- <h3>View Message</h3> --}}
            <!-- Header area End  -->
            <div class="deshboard_main_edit_task_area table ">
                <p><span><strong>Date: </strong></span><span> {{$message->date}}</span></p>
                <hr class="my-4">
                <p><span><strong>Subject: </strong></span><span> {{$message->subject}}</span></p>
                <hr class="my-4">
                <p class="mb-4">{{$message->message}}</p>
            </div>
            <div class="mt-5">
                <a href="{{route('messages')}}" class="dark-link font-weight-bold">
                    <strong>
                        <i class="fa-solid fa-arrow-left"></i>
                        Back to Messages
                    </strong>
                </a>
            </div>
        </div>
    </div>
@endsection
