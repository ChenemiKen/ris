@extends('results.base')
@section('title', 'Add skills')
@section('page-heading', 'Add skills')

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
        <form action="{{route('create-skill')}}" method="POST">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="class">Class</label>
                            <select name="class" class="form-control" id="class" required>
                                <option value="" {{ old('class') == "" ? "selected" : "" }} hidden=""> </option>
                                <option value="nursery" {{ old('class') == 'nursery' ? "selected" : "" }}>Nursery</option>                         
                                <option value="lower_primary" {{ old('class') == 'lower_primary' ? "selected" : "" }}>Lower primary</option>                         
                                <option value="upper_primary" {{ old('class') == 'upper_primary' ? "selected" : "" }}>Upper primary</option>                         
                                <option value="beacon" {{ old('class') == 'primary_4' ? "beacon" : "" }}>Beacon</option>                         
                                <option value="playgroup" {{ old('class') == 'primary_5' ? "playgroup" : "" }}>Playgroup</option>                          
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="name">Skill Name</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="category">Category</label>
                            <select name="category" class="form-control" id="category">
                                <option value="" {{ old('category') == "" ? "selected" : "" }} hidden=""></option>
                                @foreach($categories as $category)
                                    <option value={{$category->id}} {{ old('category') == $category->id ? "selected" : "" }}>{{$category->name}}</option>
                                @endforeach                           
                            </select>
                        </div>
                        <div class="text-right mt-3"><button class="crate_btn_area border-0" data-toggle="modal" data-target="#addNewSkillCategoryModal">+ Add category</button></div>   
                    </div>
                    
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Add Skill">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- add new category --}}
        <!-- Modal -->
        <div class="modal fade bd-example-modal-sm" id="addNewSkillCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add new skill category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('create-skill-category')}}" method="post">
                            @csrf
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="new_category">new category</label>
                                <input class="form-control" type="text" id="new_category" name="new_category" required>
                            </div>
                            <div class="deshboard_single_item_editor_btn_area text-center mt-4">
                                <input type="submit" value="Add">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-style btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection