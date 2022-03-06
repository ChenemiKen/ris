@extends('layouts.base')
@section('title', 'View homework')
@section('page-heading', 'View Homework')

@section('page-content') 
    <div class="deshboard_booking_main_content_area pt-3">
        <div class="deshboard_booking_main_content_area_container">
            {{-- <h3>View Message</h3> --}}
            <!-- Header area End  -->
            <div class="deshboard_main_edit_task_area table ">
                <p><span><strong>Date: </strong></span><span>{{\Carbon\Carbon::parse($homework->date)->format('d M Y')}}</span></p>
                <hr class="my-4">
                <p><span><strong>Submit Date: </strong></span><span> {{\Carbon\Carbon::parse($homework->submission_date)->format('d M Y')}}</span></p>
                <hr class="my-4">
                <p class="mb-4">{{$homework->homework}}</p>
            </div>
            <div class="mt-5">
                <a href="{{route('homeworks')}}" class="dark-link font-weight-bold">
                    <strong>
                        <i class="fa-solid fa-arrow-left"></i>
                        Back to Homeworks
                    </strong>
                </a>
            </div>
        </div>
    </div>
@endsection
