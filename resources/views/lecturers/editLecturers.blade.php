@extends('master')

@section('title')
    Edit {{$lecturer->lecturer_name}}
@endsection

@section('header')
<color style="color: #ff6600">Editing</color> <b style="color: blue">{{$lecturer->lecturer_name}}</b>
@endsection

@section('content')
<div class="panel panel-default">
    <div class="form form-group">
        <form class="form-group" method="POST" action="{{ URL::to('updateLecturer/'.$lecturer->id)}}">
            <div class="form-group">
                <label>Lecturer's Name*</label>
                <input type="text" style="color: #cc0000" name="lecturer_name"value="{{$lecturer->lecturer_name}}" required="required" class="form-control" style="width:60%">
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Gender</option>
                    <option name="male" value="male">Male</option>
                    <option name="female" value="female">Female</option>
                </select>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}"
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Status</option>
                    <option name="male" value="1">Full time</option>
                    <option name="female" value="0">Part time</option>
                </select>
            </div>
            <div class="form-group">
                <label>email*</label>
                <input type="email" name="email" style="color: #cc0000" value="{{$lecturer->email}}" required="required" class="form-control" style="width:60%">
            </div>
            <div class="form-group">
                <label>contact*</label>
                <input type="number" name="contact"style="color: #cc0000" value="{{$lecturer->contact}}" required="required" class="form-control" style="width:60%">
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
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection
