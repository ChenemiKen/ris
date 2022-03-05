@extends('layouts.base')
@section('title', 'Create event')
@section('page-heading', 'Create Event')

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
        <form action="{{route('create-event')}}" method="POST">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="date">Date</label>
                            <input class="form-control" type="date" id="date" name="date" value="{{ old('date') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="description"><span>Description</span></label>
                            <div class="deshboard_editor_textarea_main_area" >
                                <textarea class="form-control" name="description" id="description" required>{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Add Event" name="submit">
                        </div>
                    </div>


                </div>
            </div>
            <div class="deshboard_main_top_edit_area">
        </form>
    </div>
@endsection
