@extends('master')

@section('title')
    {{App\Course::getCourseName($course->id)}}
@endsection

@section('header')
    Details of {{App\Course::getCourseCode($course->id)}} {{App\Course::getCourseName($course->id)}}.
@endsection

@section('content')
<div class="panel panel-info">
    <p><b style="color: #006dcc">{{App\Course::getCourseCode($course->id)}} {{App\Course::getCourseName($course->id)}}</b> has been assigned the following <b>Lecturers</b>:</p>
    @foreach($lecturers as $lecturer)
    <p><b style="color: #C40D0D">->{{App\Lecturer::getLecturerName($lecturer)}}</b> of the faculty of <b style="color: #00b3ee">{{App\Lecturer::getLecturerFacultyName($lecturer)}}</b></p>
    @endforeach
    <br/>
    <h4>Students taking the course include:</h4>
    @foreach($students as $student)
    <p><b style="color: #C40D0D">->{{App\Department::getDepartmentCode($student->departments_id)}} {{App\Level::getLevelName($student->levels_id)}}
        </b> of the faculty of <b style="color: #00b3ee">{{App\Department::getDeptFaculty($student->departments_id)}}</b></p>
    @endforeach
</div>
@endsection