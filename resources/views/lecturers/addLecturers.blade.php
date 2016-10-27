@extends('master')

@section('header')
    Add New Lecturers
@endsection
@section('content')
<div class="form form-group" style="background-color: #fffff">
    <form class="form-group" method="POST"action="{{ URL::to('saveLecturers')}}">
            <div class="form-group">
                <label>Lecturer's Name*</label>
                <input type="text" name="lecturer_name" placeholder="name" required="required" class="form-control" style="width:60%">
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Gender</option>
                    <option name="male" value="1">Male</option>
                    <option name="female" value="0">Female</option>
                </select>
            </div>
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Status</option>
                    <option name="male" value="male">Full time</option>
                    <option name="female" value="male">Part time</option>
                </select>
            </div>
            <div class="form-group">
                <label>email*</label>
                <input type="email" name="email"placeholder="email" required="required" class="form-control" style="width:60%">
            </div>
            <div class="form-group">
                <label>contact*</label>
                <input type="number" name="contact"placeholder="67777777" required="required" class="form-control" style="width:60%">
            </div>
            <div class="form-group">
                <label>Faculty*</label>
                <select name="faculty" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Faculty</option>
                    @foreach($faculties as $faculty)
                    <option name="{{$faculty->id}}" value="{{$faculty->id}}">{{$faculty->faculty_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection
@section('title')
    Add a Lecturer
@endsection