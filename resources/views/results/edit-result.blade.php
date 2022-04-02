@extends('layouts.base')
@section('title', 'New pupil')
@section('page-heading', 'New Pupil')

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
        <form action="{{route('update-result', $result->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="date">Date</label>
                            <input class="form-control" type="date" id="date" name="date" value="{{ old('date', $result->date)}}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="pupil">Pupil’s Name</label>
                            <select name="pupil" class="form-control" id="pupil" disabled>
                                <option value="" {{ old('pupil',  $result->pupil->id) == "" ? "selected" : "" }} hidden="">Select Pupil</option>
                                @foreach($pupils as $pupil)
                                    {{-- <option value="{{$pupil->id}}">{{$pupil->firstname}}{{$pupil->lastname}}</option> --}}
                                    <option value="{{$pupil->id}}" {{ old('pupil',  $result->pupil_id) == $pupil->id ? "selected" : "" }}>{{$pupil->firstname}}{{$pupil->lastname}}</option>
                                @endforeach                           
                            </select>
                        </div>
                    </div>
                        <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="term">Term</label>
                            <input class="form-control" type="text" id="term" name="term" value="{{ old('term', $result->term)}}" required>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-12">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="data"><span>Result Data</span></label>
                            <div class="deshboard_editor_textarea_main_area">
                                <textarea class="form-control" name="data" id="data" required>{{ old('data', $result->data)}}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="file">Add File</label>
                            <input class="form-control" type="file" id="file" name="file" value="{{ old('file', $result->file)}}">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Update Result" name="edit-btn-area">
                        </div>
                    </div>
                </div>
            </div>
            <div class="deshboard_main_top_edit_area">
        </form>
    </div>
@endsection