@extends('master')

@section('title')
    Edit Department
@endsection
@section('header')
<color style="color: #ff6600">Editing</color> <b style="color: blue">{{$department->department_name}}</b>
@endsection

@section('content')
<div class="panel panel-default">
    <div class="form form-group">
        <form class="form-group" method="POST" action="{{ URL::to('updateDepartment/'.$department->id) }}">
            <div class="form-group">
                <label>Department Name*</label>
                <input type="text" name="department_name" value="{{$department->department_name}}" class="form-control" style="width:60%">
            </div>
            <div class="form-group">
                <label>Department Code*</label>
                <input type="text" name="department_code" value="{{$department->department_code}}" class="form-control" style="width:60%">
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Department</button>
            </div>
        </form>
    </div>
</div>

@endsection