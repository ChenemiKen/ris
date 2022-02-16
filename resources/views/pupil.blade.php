@extends('layouts.base')
@section('title', 'Pupils')
@section('page-heading', 'All Pupils')

@section('content') 
    <div class="deshboard_booking_main_content_area">
        <div class="deshboard_booking_main_content_area_container">
            <a href="/add-pupil" class="crate_btn_area">+ Add a Pupil</a>
            <!-- Header area start  -->
            <div class="deshboard_filter_area">
                <h4></h4>
                <ul>
                    <li><a href="#"><img src="{{asset('img/sort.svg')}}" alt="photos">Sort</a></li>
                    <li><a href="#"><img src="{{asset('img/filter.svg')}}" alt="photos">Filter</a></li>
                </ul>
            </div>
            <!-- Header area End  -->
            <div class="deshboard_main_edit_task_area table">
                <table>
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Full Name</th>
                            <th>Class</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Parent Phone</th>
                            <th>Parent Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 1.Single item area start  -->
                        <tr>
                            
                            <td class="amdin_pay_img"><img src="{{asset('img/pupil.png')}}" alt=""></td>
                            <td>Ayinde Adeoluwa</td>
                            <td>Nursery 1 David</td>
                            <td>7</td>
                            <td>Female</td>
                            <td>08195061453</td>
                            <td>tnwuzor@mail.com</td>
                            <td>
                                <a href="#" class="btn-style">View</a>
                                <a href="#" class="btn-style">Edit</a>
                                <a href="#" class="btn-style btn-style-danger">delete</a>
                            </td>
                        </tr>
                        <tr>
                            
                            <td class="amdin_pay_img"><img src="{{asset('img/pupil.png')}}" alt=""></td>
                            <td>Ayinde Adeoluwa</td>
                            <td>Nursery 1 David</td>
                            <td>7</td>
                            <td>Female</td>
                            <td>08195061453</td>
                            <td>tnwuzor@mail.com</td>
                            <td>
                                <a href="#" class="btn-style">View</a>
                                <a href="#" class="btn-style">Edit</a>
                                <a href="#" class="btn-style btn-style-danger">delete</a>
                            </td>
                        </tr>
                        <tr>
                            
                            <td class="amdin_pay_img"><img src="assets/img/pupil.png" alt=""></td>
                            <td>Ayinde Adeoluwa</td>
                            <td>Nursery 1 David</td>
                            <td>7</td>
                            <td>Female</td>
                            <td>08195061453</td>
                            <td>tnwuzor@mail.com</td>
                            <td>
                                <a href="#" class="btn-style">View</a>
                                <a href="#" class="btn-style">Edit</a>
                                <a href="#" class="btn-style btn-style-danger">delete</a>
                            </td>
                        </tr>
                        <tr>
                            
                            <td class="amdin_pay_img"><img src="assets/img/pupil.png" alt=""></td>
                            <td>Ayinde Adeoluwa</td>
                            <td>Nursery 1 David</td>
                            <td>7</td>
                            <td>Female</td>
                            <td>08195061453</td>
                            <td>tnwuzor@mail.com</td>
                            <td>
                                <a href="#" class="btn-style">View</a>
                                <a href="#" class="btn-style">Edit</a>
                                <a href="#" class="btn-style btn-style-danger">delete</a>
                            </td>
                        </tr>
                        <tr>
                            
                            <td class="amdin_pay_img"><img src="assets/img/pupil.png" alt=""></td>
                            <td>Ayinde Adeoluwa</td>
                            <td>Nursery 1 David</td>
                            <td>7</td>
                            <td>Female</td>
                            <td>08195061453</td>
                            <td>tnwuzor@mail.com</td>
                            <td>
                                <a href="#" class="btn-style">View</a>
                                <a href="#" class="btn-style">Edit</a>
                                <a href="#" class="btn-style btn-style-danger">delete</a>
                            </td>
                        </tr>
                        <tr>
                            
                            <td class="amdin_pay_img"><img src="assets/img/pupil.png" alt=""></td>
                            <td>Ayinde Adeoluwa</td>
                            <td>Nursery 1 David</td>
                            <td>7</td>
                            <td>Female</td>
                            <td>08195061453</td>
                            <td>tnwuzor@mail.com</td>
                            <td>
                                <a href="#" class="btn-style">View</a>
                                <a href="#" class="btn-style">Edit</a>
                                <a href="#" class="btn-style btn-style-danger">delete</a>
                            </td>
                        </tr>
                        <!-- 2.Single item area start  -->
                    </tbody>
                </table>
            </div>
            <div class="table_pagination_area">
                <div class="table_pagination_area_left">
                    <div class="table_pagination_area_left_sub">
                        <p>Rows per page:</p>
                        <select name="value-type" id="value-type">
                        <option value="category" selected="" hidden="">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="4">5</option>
                        </select>
                    </div>
                </div>
                <div class="table_pagination_area_right">
                    <ul>
                        <li>1-6 of 100</li>
                        <li><a href="#"><i class="fas fa-angle-left"></i></a></li>
                        <li><a href="#"><i class="fas fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
