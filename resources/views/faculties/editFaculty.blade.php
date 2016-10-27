@extends('master')

@section('title')
    Edit Faculty
@endsection
@section('header')
<color style="color: #ff6600">Editing</color> <b style="color: blue">{{$faculty->faculty_name}}</b>
@endsection

@section('content')
<div class="panel panel-default">
    <div class="form form-group">
        <form class="form-group" method="POST" action="{{ URL::to('updateFaculty/'.$faculty->id) }}">
            <div class="form-group">
                <label>Faculty Name*</label>
                <input type="text" name="faculty_name" value="{{$faculty->faculty_name}}" class="form-control" style="width:60%">
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Faculty</button>
            </div>
        </form>
    </div>
</div>

@endsection