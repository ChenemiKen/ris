@extends('layouts.base')
@section('title', 'Add birthday')
@section('page-heading', 'Add Birthday')

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
        <form action="{{route('create-birthday')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="date">Date</label>
                            <input class="form-control" type="date" id="date" name="date" value="{{ old('date') }}" required>
                        </div>
                    </div>
                    <div class="col-md-8">
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
                    <div class="col-md-12   ">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="photo">Add Photo</label>
                            <input class="form-control" type="file" id="photo" name="photo" value="{{ old('photo') }}" required>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Create Birthday" name="edit-btn-area">
                        </div>
                    </div>


                </div>
            </div>
            <div class="deshboard_main_top_edit_area">
        </form>
    </div>
@endsection
                       