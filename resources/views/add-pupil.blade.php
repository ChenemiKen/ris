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
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="class"> Class</label>
                            <select name="class" class="form-control" id="class" required>
                                <option value="" {{ old('class') == "" ? "selected" : "" }} hidden="">Select Class</option>
                                <option value="upper_primary" {{ old('class') == "upper_primary" ? "selected" : "" }}>Upper Primary</option>
                                <option value="lower_primary" {{ old('class') == "lower_primary" ? "selected" : "" }}>Lower Primary</option>
                                <option value="nursery" {{ old('class') == "nursery" ? "selected" : "" }}>Nursery</option>
                                <option value="beacon" {{ old('class') == "beacon" ? "selected" : "" }}>Beacon</option>
                                <option value="playgroup" {{ old('class') == "playgroup" ? "selected" : "" }}>Playgroup</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="class"> Subclass</label>
                            <select name="subclass" class="form-control" id="subclass" required>
                                <option value="" {{ old('subclass') == "" ? "selected" : "" }} hidden="">Select Subclass</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="class"> Class Group</label>
                            <select name="class_group" class="form-control" id="class_group" required>
                                <option value="" {{ old('class_group') == "" ? "selected" : "" }} hidden="">Select Class Group</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="DOB">DOB</label>
                            <input class="form-control" type="date" id="DOB" name="DOB" value="{{ old('DOB') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="gender">Gender</label>
                    
                            <select class="form-control" id="gender" type='select' name='gender' value="{{ old('gender') }}" required>
                                <option {{ old('gender') == "" ? "selected" : "" }} hidden>Choose...</option>
                                <option value="M" {{ old('gender') == "M" ? "selected" : "" }}>Male</option>
                                <option value="F" {{ old('gender') == "F" ? "selected" : "" }}>Female</option>
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
                    <div class="col-md-4 offset-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="photo">Add Passport Photo</label>
                            <input class="form-control" type="file" id="photo" name="photo" value="{{ old('photo') }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area text-center">
                            <input type="submit" value="Add Pupil" name="submit">
                        </div>
                    </div>
                </div>
            </div>
            <div class="deshboard_main_top_edit_area">
        </form>
    </div>
@endsection
@section('page-extrascripts')
<script>
    var old_subclass = {!! json_encode(old('subclass'), JSON_HEX_TAG) !!}
    var old_class_group = {!! json_encode(old('class_group'), JSON_HEX_TAG) !!}
</script>
@endsection
