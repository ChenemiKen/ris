@extends('results.primary.base')
@section('title', 'Add Test Result')
@section('page-heading', 'Add Test Result')

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
        <form action="{{route('create-primary-test')}}" method="POST">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="pupil">Pupil</label>
                            <select name="pupil" class="form-control" id="pupil">
                                <option value="" {{ old('pupil') == "" ? "selected" : "" }} hidden=""></option>
                                @foreach($pupils as $pupil)
                                    <option value={{$pupil->id}} {{ old('pupil') == $pupil->id ? "selected" : "" }}>{{$pupil->firstname}} {{$pupil->lastname}}</option>
                                @endforeach                           
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="term">Term</label>
                            <select name="term" class="form-control" id="term">
                                <option value="" {{ old('term') == "" ? "selected" : "" }} hidden=""></option>
                                @foreach($terms as $term)
                                    <option value={{$term->id}} {{ old('term') == $term->id ? "selected" : "" }}>{{$term->name}}{{$term->session}}</option>
                                @endforeach                           
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="test_no">Test</label>
                            <select name="test_no" class="form-control" id="test_no">
                                <option value="" {{ old('test_no') == "" ? "selected" : "" }} hidden=""</option>
                                <option value=1 {{ old('test_no') == 1 ? "selected" : "" }}>1st test</option>
                                <option value=2 {{ old('test_no') == 2 ? "selected" : "" }}>2nd test</option>
                                <option value=3 {{ old('test_no') == 3 ? "selected" : "" }}>3rd test</option>
                                <option value=4 {{ old('test_no') == 4 ? "selected" : "" }}>4th test</option>
                            </select>
                        </div>
                    </div>
                    @foreach($subjects as $subject)
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="number" id="{{$subject->id}}" name="subject[{{$loop->index}}][id]" value='{{old("subject[{$loop->index}][id]", $subject->id)}}' required hidden readonly aria-hidden="true" aria-readonly="true">
                                <label for="{{$subject->name}}">Subject</label>
                                <input class="form-control" type="text" id="{{$subject->name}}" name="subject[{{$loop->index}}][name]" value='{{old("subject[{$loop->index}][name]", $subject->name)}}' required readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$subject->name}}-score">Score</label>
                                <input class="form-control" type="number" id="{{$subject->name}}-score" name="subject[{{$loop->index}}][score]" value="{{old("subject[{$loop->index}][score]")}}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$subject->name}}-grade">Grade</label>
                                <select name="subject[{{$loop->index}}][grade]" class="form-control" id="{{$subject->name}}-grade">
                                    <option value="" {{old("subject[{$loop->index}][grade]") == "" ? "selected" : "" }} hidden=""></option>
                                    <option value=A {{old("subject[{$loop->index}][grade]") == 'A' ? "selected" : "" }}>A</option>
                                    <option value=B {{old("subject[{$loop->index}][grade]") == 'B' ? "selected" : "" }}>B</option>
                                    <option value=C {{old("subject[{$loop->index}][grade]") == 'C' ? "selected" : "" }}>C</option>
                                    <option value=D {{old("subject[{$loop->index}][grade]") == 'D' ? "selected" : "" }}>D</option>
                                    <option value=E {{old("subject[{$loop->index}][grade]") == 'E' ? "selected" : "" }}>E</option>
                                    <option value=F {{old("subject[{$loop->index}][grade]") == 'F' ? "selected" : "" }}>F</option>
                                </select>                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$subject->name}}-remark">Remark</label>
                                <select name="subject[{{$loop->index}}][remark]" class="form-control" id="{{$subject->name}}-remark">
                                    <option value="" {{old("subject[{$loop->index}][remark]") == "" ? "selected" : "" }} hidden=""></option>
                                    <option value='excellent' {{old("subject[{$loop->index}][remark]") == 'excellent' ? "selected" : "" }}>Excellent</option>
                                    <option value='very_good' {{old("subject[{$loop->index}][remark]") == 'very_good' ? "selected" : "" }}>Very Good</option>
                                    <option value='good' {{old("subject[{$loop->index}][remark]") == 'good' ? "selected" : "" }}>Good</option>
                                    <option value='fair' {{old("subject[{$loop->index}][remark]") == 'fair' ? "selected" : "" }}>Fair</option>
                                    <option value='poor' {{old("subject[{$loop->index}][remark]") == 'poor' ? "selected" : "" }}>Poor</option>
                                    <option value='fail' {{old("subject[{$loop->index}][remark]") == 'fail' ? "selected" : "" }}>Fail</option>
                                </select>                            
                            </div>
                        </div>   
                    @endforeach
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Add Test" name="edit-btn-area">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection