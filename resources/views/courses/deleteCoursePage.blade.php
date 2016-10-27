@extends('master')

@section('title')
    {{App\Course::getCourseName($course->id)}}
@endsection

@section('header')
   Deleting {{App\Course::getCourseCode($course->id)}} {{App\Course::getCourseName($course->id)}}.
@endsection

@section('content')
<div class="panel panel-info">
    <p><b style="color: #006dcc">Lecturers</b>  taking this course include:</p>
    @foreach($lecturers as $lecturer)
    <p><b style="color: #C40D0D">->{{App\Lecturer::getLecturerName($lecturer)}}</b> of the faculty of <b style="color: #00b3ee">{{App\Lecturer::getLecturerFacultyName($lecturer)}}</b></p>
    @endforeach

    <p><b style="color: #006dcc">Students</b> taking the course include: </p>

    <a href="{{URL::to('deleteCourse/'.$course->id) }}" onclick="return confirm('Are you sure you want to delete this course?')"><button class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign" style="color:color"></span> Proceed >></button></a>

</div>
@endsection