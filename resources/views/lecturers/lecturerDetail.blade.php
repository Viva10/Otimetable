@extends('master')

@section('title')
    {{$lecturer_name}}
@endsection
@section('header')
<b style="color: #0066ff">{{$lecturer_name}}</b> is from the Faculty of:- <b>{{App\Lecturer::getLecturerFacultyName($faculty)}}</b>
@endsection

@section('content')
<div class="panel panel-info">
    <p><b style="color: #ac2925">{{$lecturer_name}}</b> is the instructor of the following courses:</p>
    @foreach($courses as $course)
    <p><b>->{{App\Course::getCourseCode($course)}} {{App\Course::getCourseName($course)}}</b> of the faculty of <b style="color: #00b3ee">{{App\Course::getCourseFaculty($course)}}</b></p>
    @endforeach

</div>

@endsection