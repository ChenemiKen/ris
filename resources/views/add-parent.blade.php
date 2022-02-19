@extends('layouts.base')
@section('title', 'New Parent')
@section('page-heading', 'New Parent')

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
        <form action="{{route('add-parent')}}" method="POST">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-6">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="fullname">Full Name</label>
                            <input class="form-control" type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" required>
                        </div>
                    </div>
                        <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="phone"> Phone</label>
                            <input class="form-control" type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="email"> Email	</label>
                            <input class="form-control" type="text" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="adrress"><span>Contact Address</span></label>
                            <div class="deshboard_editor_textarea_main_area">
                                <textarea class="form-control" name="address" id="address" required>{{ old('address') }}</textarea>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Add Parent" name="edit-btn-area">
                        </div>
                    </div>


                </div>
            </div>
            <div class="deshboard_main_top_edit_area">
        </form>
    </div>
@endsection