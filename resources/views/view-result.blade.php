@extends('layouts.base')
@section('title', 'View result')
@section('page-heading', 'View result')

@section('page-content') 
    <div class="deshboard_booking_main_content_area pt-0">
        <div class="deshboard_booking_main_content_area_container">
            {{-- <h3>View Message</h3> --}}
            <!-- Header area End  -->
            <div class="deshboard_main_edit_task_area table pt-4 ">
                <div class="row">
                    <p class="col-md-4"><span><strong>Name: </strong></span><span> {{$pupil->firstname}} {{$pupil->lastname}}</span></p>
                    <p class="col-md-4"><span><strong>Term: </strong></span><span> {{$result->term}}</span></p>
                </div>
                <hr class="my-1">
                <p class="mb-2 text-center">{{$result->data}}</p>
                <hr class="my-1">
                <div class="row justify-content-center">
                    <iframe src="{{asset('uploads/results/'.$result->file)}}" width="85%" height="700">
                            This browser does not support PDFs. Please download the PDF to view it: <a href="{{asset('uploads/results/'.$result->file)}}">Download PDF</a>
                    </iframe>
                </div>
            </div>
            <div class="mt-5">
                <a href="{{route('results')}}" class="dark-link font-weight-bold">
                    <strong>
                        <i class="fa-solid fa-arrow-left"></i>
                        Back to Results
                    </strong>
                </a>
            </div>
        </div>
    </div>
@endsection
