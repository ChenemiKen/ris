@extends('layouts.base')
@section('title', 'calendar')
@section('page-heading')
    <small class="nav-date"></small>
@stop
@section('page-extrahead')
    <!-- calender style -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/calendar_style.css')}}" />
@endsection

@section('page-content') 
    <div class="deshboard_booking_main_content_area">
        <div class="deshboard_booking_main_content_area_container">
            @can('is-admin')
            <a href="{{route('add-event')}}" class="crate_btn_area">+ Add event</a>
            @endcan
            <div class="deshboard_main_edit_task_area table">
                
                <div class="container">
                    <div class="calendar">
                        <div class="month text-center">
                            <i class="fas fa-angle-left prev"></i>
                            <div class="date">
                            <h4 class="text-blue"></h4>
                            <p class="text-blue"></p>
                            </div>
                            <i class="fas fa-angle-right next"></i>
                        </div>
                        <div class="weekdays">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div class="days"></div>
                    </div>

                    {{-- modal --}}
                    <div class="modal fade bd-example-modal-lg" id="viewEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <small class="mt-3 mx-4 " id="eventDate"></small>
                                <div class="modal-header pt-1">
                                    <h5 class="modal-title mt-0" id="eventTitle"></h5>
                                    {{-- <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close" aria-hidden="true">
                                        <span aria-hidden="true">&times;</span>
                                    </button> --}}
                                    <hr>
                                </div>
                                <div class="modal-body pt-1">
                                    <p id="eventDescription"></p>
                                </div>
                                <div class="modal-footer">
                                    {{-- <button type="button" class="btn btn-style btn-sm close-btn" data-dismiss="modal">Close</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-extrascripts')
    <script>    
        const events = {!! json_encode($events->toArray(), JSON_HEX_TAG) !!};
    </script>
    <!-- callender script -->
    <script src="{{asset('js/calendar_script.js')}}"></script>
@endsection