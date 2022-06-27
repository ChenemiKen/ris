@extends('layouts.base')
@section('title', 'Move pupils')
@section('page-heading', 'Move Pupil')

@section('page-content')
    <div class="deshboard_main_edit_create_page_area">
        @if ($errors->any())
            <div >
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('move-pupil')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="pupil">Pupil’s Name</label>
                            <select name="pupil" class="form-control" id="pupil">
                                <option value="" {{ old('class') == "" ? "selected" : "" }} hidden="">Select Pupil</option>
                                @foreach($pupils as $pupil)
                                    {{-- <option value="{{$pupil->id}}">{{$pupil->firstname}}{{$pupil->lastname}}</option> --}}
                                    <option value="{{$pupil->id}}" {{ old('pupil') == $pupil->id ? "selected" : "" }}>{{$pupil->firstname}} {{$pupil->lastname}}</option>
                                @endforeach                           
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="class">New Class</label>
                            <select name="class" class="form-control" id="class" required>
                                <option value="" {{ old('class') == "" ? "selected" : "" }} hidden="">Select Class</option>
                                <option value="beacon" {{ old('class') == "beacon" ? "selected" : "" }}>Beacon</option>
                                <option value="lower_primary" {{ old('class') == "lower_primary" ? "selected" : "" }}>Lower Primary</option>
                                <option value="upper_primary" {{ old('class') == "upper_primary" ? "selected" : "" }}>Upper Primary</option>
                                <option value="nursery" {{ old('class') == "nursery" ? "selected" : "" }}>Nursery</option>
                                <option value="playgroup" {{ old('class') == "playgroup" ? "selected" : "" }}>Playgroup</option>
                            </select>
                        </div>
                    </div>    
                    <div class="col-md-2">
                        <label for="submit"></label>
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Move Pupil" name="submit">
                        </div>
                    </div>
                </div>
            </div>
            <div class="deshboard_main_top_edit_area">
        </form>
    </div>
@endsection
