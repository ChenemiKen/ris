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
        <form action="{{route('create-homework')}}" method="POST">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="date">Date</label>
                            <input class="form-control" type="date" id="date" name="date" value="{{ old('date') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="class"> Class</label>
                            <select name="class" class="form-control" id="class" required>
                                <option value="" {{ old('class') == "" ? "selected" : "" }} hidden="">Select Class</option>
                                <option value="Prim 1" {{ old('class') == "Prim 1" ? "selected" : "" }}>Primary 1</option>
                                <option value="Prim 2" {{ old('class') == "Prim 2" ? "selected" : "" }}>Primary 2</option>
                                <option value="Prim 3" {{ old('class') == "Prim 3" ? "selected" : "" }}>Primary 3</option>
                                <option value="Prim 4" {{ old('class') == "Prim 4" ? "selected" : "" }}>Primary 4</option>
                                <option value="Prim 5" {{ old('class') == "Prim 5" ? "selected" : "" }}>Primary 5</option>
                                <option value="Prim 6" {{ old('class') == "Prim 6" ? "selected" : "" }}>Primary 6</option>
                        
                            
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="submission_date">Submission Date</label>
                            <input class="form-control" type="date" id="submission_date" name="submission_date" value="{{ old('submission_date') }}" required>
                        </div>
                    </div>
                        <div class="col-md-12">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="homework"><span>Homework</span></label>
                            <div class="deshboard_editor_textarea_main_area" >
                                <textarea class="form-control" name="homework" id="homework" required>{{ old('homework') }}</textarea>
                            </div>
                        </div>
                    </div>
                
                    
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Add Homework" name="edit-btn-area">
                        </div>
                    </div>


                </div>
            </div>
            <div class="deshboard_main_top_edit_area">
        </form>
    </div>
@endsection