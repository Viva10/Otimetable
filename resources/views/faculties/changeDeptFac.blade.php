@extends('master')

@section('title')
    Change {{$department->department_name}}'s faculty
@endsection

@section('header')
<color style="color: #ff6600">Change</color> <b style="color: blue">{{$department->department_name}}'s Faculty</b> from 
{{App\Department::getDeptFaculty($department->id)}} to ...
@endsection

@section('content')
<div class="panel panel-default">
    <div class="form form-group">
        <form class="form-group" method="POST" action="{{ URL::to('updateDeptFac/'.$department->id)}}">
           
            <input type="hidden" name="_token" value="{{csrf_token()}}"
            
            <div class="form-group">
                <label>Faculty*</label>
                <select name="faculty" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select New Faculty</option>
                    @foreach($faculties as $faculty)
                    <option name="{{$faculty->id}}" value="{{$faculty->id}}">{{$faculty->faculty_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Change Faculty</button>
            </div>
        </form>
    </div>
</div>

@endsection
