@extends('results.base')
@section('title', 'Add subjects')
@section('page-heading', 'Add Subjects')

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
        <form action="{{route('create-subject')}}" method="POST">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="class">Class</label>
                            <select name="class" class="form-control" id="class" required>
                                <option value="" {{ old('class') == "" ? "selected" : "" }} hidden=""> </option>
                                <option value="primary_1" {{ old('class') == 'primary_1' ? "selected" : "" }}>Primary 1</option>                         
                                <option value="primary_2" {{ old('class') == 'primary_2' ? "selected" : "" }}>Primary 2</option>                         
                                <option value="primary_3" {{ old('class') == 'primary_3' ? "selected" : "" }}>Primary 3</option>                         
                                <option value="primary_4" {{ old('class') == 'primary_4' ? "selected" : "" }}>Primary 4</option>                         
                                <option value="primary_5" {{ old('class') == 'primary_5' ? "selected" : "" }}>Primary 5</option>                         
                                <option value="primary_6" {{ old('class') == 'primary_6' ? "selected" : "" }}>Primary 6</option>                         
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="name">Subject Name</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="max_score">Maximum Score</label>
                            <input class="form-control" type="number" id="max_score" name="max_score" value="{{ old('max_score') }}" required>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Add Subject" name="edit-btn-area">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection