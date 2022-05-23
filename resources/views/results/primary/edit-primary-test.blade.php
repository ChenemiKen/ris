@extends('results.primary.base')
@section('title', 'Edit Test Result')
@section('page-heading', 'Edit Test Result')

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
        <form action="{{route('update-primary-test', $test->id)}}" method="POST">
            @csrf
            <div class="deshboard_main_top_edit_area">
                <div class="row">
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="pupil">Pupil</label>
                            <select name="pupil" class="form-control" id="pupil">
                                <option value="" {{ old('pupil') == "" ? "selected" : "" }} hidden=""></option>
                                @foreach($pupils as $pupil)
                                    <option value={{$pupil->id}} {{ old('pupil', $test->pupil_id) == $pupil->id ? "selected" : "" }}>{{$pupil->firstname}}{{$pupil->lastname}}</option>
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
                                    <option value={{$term->id}} {{ old('term', $test->term_id) == $term->id ? "selected" : "" }}>{{$term->name}}{{$term->session}}</option>
                                @endforeach                           
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="deshboard_main_top_edit_area_single_item">
                            <label for="test_no">Test</label>
                            <select name="test_no" class="form-control" id="test_no">
                                <option value="" {{ old('test_no', $test->test_no) == "" ? "selected" : "" }} hidden=""</option>
                                <option value=1 {{ old('test_no', $test->test_no) == 1 ? "selected" : "" }}>1st test</option>
                                <option value=2 {{ old('test_no', $test->test_no) == 2 ? "selected" : "" }}>2nd test</option>
                                <option value=3 {{ old('test_no', $test->test_no) == 3 ? "selected" : "" }}>3rd test</option>
                                <option value=4 {{ old('test_no', $test->test_no) == 4 ? "selected" : "" }}>4th test</option>
                            </select>
                        </div>
                    </div>
                    @foreach($test->primaryTestResults as $testResult)
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <input class="form-control" type="number" id="{{$testResult->id}}" name="result[{{$loop->index}}][id]" value='{{old("result[{$loop->index}][id]", $testResult->id)}}' required hidden readonly aria-hidden="true" aria-readonly="true">
                                <label for="{{$testResult->subject->name}}">Subject</label>
                                <input class="form-control" type="text" id="{{$testResult->subject->name}}" name="result[{{$loop->index}}][name]" value='{{old("result[{$loop->index}][name]", $testResult->subject->name)}}' required readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$testResult->subject->name}}-score">Score</label>
                                <input class="form-control" type="number" id="{{$testResult->subject->name}}-score" name="result[{{$loop->index}}][score]" value="{{old("result[{$loop->index}][score]", $testResult->score)}}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$testResult->subject->name}}-grade">Grade</label>
                                <select name="result[{{$loop->index}}][grade]" class="form-control" id="{{$testResult->subject->name}}-grade">
                                    <option value="" {{old("result[{$loop->index}][grade]", $testResult->grade) == "" ? "selected" : "" }} hidden=""></option>
                                    <option value=B {{old("result[{$loop->index}][grade]", $testResult->grade) == 'B' ? "selected" : "" }}>B</option>
                                    <option value=A {{old("result[{$loop->index}][grade]", $testResult->grade) == 'A' ? "selected" : "" }}>A</option>
                                    <option value=C {{old("result[{$loop->index}][grade]", $testResult->grade) == 'C' ? "selected" : "" }}>C</option>
                                    <option value=D {{old("result[{$loop->index}][grade]", $testResult->grade) == 'D' ? "selected" : "" }}>D</option>
                                    <option value=E {{old("result[{$loop->index}][grade]", $testResult->grade) == 'E' ? "selected" : "" }}>E</option>
                                    <option value=F {{old("result[{$loop->index}][grade]", $testResult->grade) == 'F' ? "selected" : "" }}>F</option>
                                </select>                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="deshboard_main_top_edit_area_single_item">
                                <label for="{{$testResult->subject->name}}-remark">Remark</label>
                                <select name="result[{{$loop->index}}][remark]" class="form-control" id="{{$testResult->subject->name}}-remark">
                                    <option value="" {{old("result[{$loop->index}][remark]", $testResult->remark) == "" ? "selected" : "" }} hidden=""></option>
                                    <option value='excellent' {{old("result[{$loop->index}][remark]", $testResult->remark) == 'excellent' ? "selected" : "" }}>Excellent</option>
                                    <option value='very_good' {{old("result[{$loop->index}][remark]", $testResult->remark) == 'very_good' ? "selected" : "" }}>Very Good</option>
                                    <option value='good' {{old("result[{$loop->index}][remark]", $testResult->remark) == 'good' ? "selected" : "" }}>Good</option>
                                    <option value='fair' {{old("result[{$loop->index}][remark]", $testResult->remark) == 'fair' ? "selected" : "" }}>Fair</option>
                                    <option value='poor' {{old("result[{$loop->index}][remark]", $testResult->remark) == 'poor' ? "selected" : "" }}>Poor</option>
                                    <option value='fail' {{old("result[{$loop->index}][remark]", $testResult->remark) == 'fail' ? "selected" : "" }}>Fail</option>
                                </select>                            
                            </div>
                        </div>   
                    @endforeach
                    <div class="col-md-12">
                        <div class="deshboard_single_item_editor_btn_area">
                            <input type="submit" value="Update Test" name="edit-btn-area">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection