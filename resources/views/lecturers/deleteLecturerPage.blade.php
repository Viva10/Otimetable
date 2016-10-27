@extends('master')

@section('title')
    {{$lecturer_name}}
@endsection
@section('header')
Faculty of Lecturer:- {{$lecturer_faculty}}
@endsection

@section('content')
<div class="panel panel-info">
    <p><b style="color: #ac2925">{{$lecturer_name}}</b> has been assigned the following courses:</p>
    @foreach($lecturer_courses as $course)
    <p><b>->{{App\Course::getCourseCode($course)}} {{App\Course::getCourseName($course)}}</b> of the faculty of <b style="color: #00b3ee">{{App\Course::getCourseFaculty($course)}}</b></p>
    @endforeach
    <p class="alert bg-warning"><span class="glyphicon glyphicon-warning-sign" style="color:color"></span> Deleting the lecturer will make these courses have no lecturers!!!</p>
</div>
<a href="{{URL::to('deleteLecturer/'.$id) }}" onclick="return confirm('Are you sure you want to delete this lecturer?')"><button class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign" style="color:color"></span> Proceed >></button></a>
@endsection