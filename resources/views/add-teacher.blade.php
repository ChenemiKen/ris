@extends('layouts.base')
@section('title', 'Add Teacher')
@section('page-heading', 'Add Teacher')

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
        <form action="{{route('add-teacher')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="firstname">First Name</label>
                            <input class="form-control" type="text" id="firstname" name="firstname" value="{{ old('firstname')}}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="lastname">Last Name</label>
                            <input class="form-control" type="text" id="lastname" name="lastname" value="{{ old('lastname')}}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="class">Class</label>
                            <input class="form-control" type="text" id="class" name="class" value="{{ old('class')}}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="gender">Gender</label>
                            <select name="gender" class="form-control" id="gender" value="{{ old('gender')}}" required>
                                <option value="" {{ old('gender') == "" ? "selected" : "" }} hidden="">Select Gender</option>
                                <option value="F" {{ old('gender') == "F" ? "selected" : "" }}>Female</option>
                                <option value="M" {{ old('gender') == "M" ? "selected" : "" }}>Male</option>
                            
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="phone"> Phone</label>
                            <input class="form-control" type="text" id="phone" name="phone" value="{{ old('phone')}}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="email"> Email</label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ old('email')}}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="photo">Add Passport Photo</label>
                            <input class="form-control" type="file" id="photo" name="photo" value="{{ old('photo')}}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Add Teacher" name="edit-btn-area">
                        </div>
                    </div>
                </div>
            </div>
            <div class="deshboard_main_top_edit_area">
        </form>
    </div>
@endsection
                        