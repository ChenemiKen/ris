@extends('layouts.base')
@section('title', 'New message')
@section('page-heading', 'New Message')

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
        <form action="{{route('create-message')}}" method="POST">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="parent">Parent</label>
                            <select name="parent" class="form-control" id="parent">
                                <option value="" {{ old('parent') == "" ? "selected" : "" }} hidden="">Select Parent</option>
                                @foreach($parents as $parent_id => $parent_name)
                                    <option value="{{$parent_id}}" {{ old('parent') == $parent_id ? "selected" : "" }}>{{$parent_name}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="subject">Subject</label>
                            <input class="form-control" type="text" id="subject" name="subject" value="{{ old('subject') }}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="message">Message</label>
                            <div class="deshboard_editor_textarea_main_area">
                                <textarea class="form-control" name="message" id="message" required>{{ old('message') }}</textarea>
                            </div>
                            
                        </div>
                    </div>                    
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Add Message" name="edit-btn-area">
                        </div>
                    </div>

                </div>
            </div>
            <div class="deshboard_main_top_edit_area">
        </form>
    </div>
@endsection