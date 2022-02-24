@extends('layouts.base')
@section('title', 'Edit Teacher')
@section('page-heading', 'Edit Teacher')

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
        <form action="{{route('update-teacher', $teacher->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="firstname">First Name</label>
                            <input class="form-control" type="text" id="firstname" name="firstname" value="{{ old('firstname', $teacher->firstname)}}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="lastname">Last Name</label>
                            <input class="form-control" type="text" id="lastname" name="lastname" value="{{ old('lastname', $teacher->lastname)}}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="class"> Class</label>
                            <select name="class" class="form-control" id="class" required>
                                <option value="" {{ old('class',  $teacher->class) == "" ? "selected" : "" }} hidden="">Select Class</option>
                                <option value="Primary 1" {{ old('class',  $teacher->class) == "Primary 1" ? "selected" : "" }}>Primary 1</option>
                                <option value="Primary 2" {{ old('class',  $teacher->class) == "Primary 2" ? "selected" : "" }}>Primary 2</option>
                                <option value="Primary 3" {{ old('class',  $teacher->class) == "Primary 3" ? "selected" : "" }}>Primary 3</option>
                                <option value="Primary 4" {{ old('class',  $teacher->class) == "Primary 4" ? "selected" : "" }}>Primary 4</option>
                                <option value="Primary 5" {{ old('class',  $teacher->class) == "Primary 5" ? "selected" : "" }}>Primary 5</option>
                                <option value="Primary 6" {{ old('class',  $teacher->class) == "Primary 6" ? "selected" : "" }}>Primary 6</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="gender">Gender</label>
                            <select name="gender" class="form-control" id="gender" value="{{ old('class', $teacher->class)}}" required>
                                <option value="" {{ old('gender', $teacher->gender) == "" ? "selected" : "" }} hidden="">Select Gender</option>
                                <option value="F" {{ old('gender', $teacher->gender) == "F" ? "selected" : "" }}>Female</option>
                                <option value="M" {{ old('gender', $teacher->gender) == "M" ? "selected" : "" }}>Male</option>
                            
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="phone"> Phone</label>
                            <input class="form-control" type="text" id="phone" name="phone" value="{{ old('class', $teacher->phone)}}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="email"> Email</label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ old('class', $teacher->email)}}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="photo">Add Passport Photo</label>
                            <input class="form-control" type="file" id="photo" name="photo" value="{{ old('class', $teacher->photo)}}">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Update Teacher" name="edit-btn-area">
                        </div>
                    </div>
                </div>
            </div>
            <div class="deshboard_main_top_edit_area">
        </form>
    </div>
@endsection
                        