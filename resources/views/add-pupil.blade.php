@extends('layouts.base')
@section('title', 'New pupil')
@section('page-heading', 'New Pupil')

@section('content')
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
        <form action="{{route('add-pupil')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="firstname">First Name</label>
                            <input class="form-control" type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="lastname">Last Name</label>
                            <input class="form-control" type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="class">Class</label>
                            <input class="form-control" type="text" id="class" name="class" value="{{ old('class') }}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="DOB">DOB</label>
                            <input class="form-control" type="date" id="DOB" name="DOB" value="{{ old('DOB') }}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="age">Age</label>
                            <input class="form-control" type="number" id="age" name="age" value="{{ old('age') }}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="gender">Gender</label>
                    
                            <select class="form-control" id="gender" type='select' name='gender' value="{{ old('gender') }}" required>
                                <option selected disabled>Choose...</option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                                </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="parent_phone">Parent Phone	</label>
                            <input class="form-control" type="text" id="parent_phone" name="parent_phone" value="{{ old('parent_phone') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="parent_email">Parent Email	</label>
                            <input class="form-control" type="email" id="parent_email" name="parent_email" value="{{ old('parent_email') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="admission_no">Admission No.		</label>
                            <input class="form-control" type="text" id="admission_no" name="admission_no" value="{{ old('admission_no') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="entry_date">Entry Date		</label>
                            <input class="form-control" type="date" id="entry_date" name="entry_date" value="{{ old('entry_date') }}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="photo">Add Passport Photo</label>
                            <input class="form-control" type="file" id="photo" name="photo" value="{{ old('photo') }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Add Pupil" name="submit">
                        </div>
                    </div>


                </div>
            </div>
            <div class="deshboard_main_top_edit_area">
        </form>
    </div>
@endsection
