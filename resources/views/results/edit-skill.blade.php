@extends('results.base')
@section('title', 'Edit skill')
@section('page-heading', 'Edit skill')

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
        <form action="{{route('update-skill' , $skill->id)}}" method="POST">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="class">Class</label>
                            <select name="class" class="form-control" id="class" required>
                                <option value="" {{ old('class') == "" ? "selected" : "" }} hidden=""> </option>
                                <option value="nursery" {{ old('class', $skill->class) == 'nursery' ? "selected" : "" }}>Nursery</option>                         
                                <option value="lower_primary" {{ old('class', $skill->class) == 'lower_primary' ? "selected" : "" }}>Lower primary</option>                         
                                <option value="upper_primary" {{ old('class', $skill->class) == 'upper_primary' ? "selected" : "" }}>Upper primary</option>                         
                                <option value="beacon" {{ old('class', $skill->class) == 'beacon' ? "selected" : "" }}>Beacon</option>                         
                                <option value="playgroup" {{ old('class', $skill->class) == 'playgroup' ? "selected" : "" }}>Playgroup</option>                         
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="name">Skill Name</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $skill->name) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="category">Category</label>
                            <select name="category" class="form-control" id="category">
                                <option value="" {{ old('category') == "" ? "selected" : "" }} hidden=""></option>
                                @foreach($categories as $category)
                                    <option value={{$category->id}} {{ old('category', $skill->skill_category_id) == $category->id ? "selected" : "" }}>{{$category->name}}</option>
                                @endforeach                           
                            </select>                        
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Update Skill" name="edit-btn-area">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection