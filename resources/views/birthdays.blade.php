@extends('layouts.base')
@section('title', 'Birthdays')
@section('page-heading', "Today's Birthdays")

@section('page-content') 
    <div class="deshboard_booking_main_content_area">
        <div class="deshboard_booking_main_content_area_container">
            @can('is-admin')
                <a href="{{route('add-birthday')}}" class="crate_btn_area">+ Add birthday</a>
            @endcan
            <div class="deshboard_main_edit_task_area table">
                {{$birthdays}}
                <div class="row">
                    @foreach ($birthdays as $birthday)
                    <div class="col-md-3 text-center mb-5">
                        <img class="birthday-img" src="{{asset('uploads/birthdays/'.$birthday->photo)}}" alt="img">
                        <p class="mt-2 mb-2"><Strong>Happy @th($birthday->pupil->age()) birthday to {{$birthday->pupil->firstname}}</Strong></p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection