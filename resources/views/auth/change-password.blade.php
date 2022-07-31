@extends('layouts.base')
@section('title', 'Change Password')
@section('page-heading', 'Change Password')

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
        <form action="{{route('password.change.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="old_password">Old password</label>
                            <input class="form-control" type="password" id="old_password" name="old_password" required>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="password">New password</label>
                            <input class="form-control" type="password" id=" password" name="password" required>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="password_confirmation">Confirm password</label>
                            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                 
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area text-center">
                            <input type="submit" value="Submit" name="submit">
                        </div>
                    </div>
                </div>
            </div>
            <div class="deshboard_main_top_edit_area">
        </form>
    </div>
@endsection
