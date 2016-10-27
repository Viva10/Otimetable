@extends('master')

@section('title')
    {{$faculty->faculty_name}}
@endsection

@section('header')
   Deleting the faculty of {{$faculty->faculty_name}}.
@endsection

@section('content')
<div class="panel panel-info">
    <p>Before Deleting this faculty you delete all records of it's departments, department's students, and department's and it's lecturers.!!! So if you wish to conserve any of the records
    below, then go edit them and link them to some other faculty or delete them first before attempting to delete the faculty.!!!!!!!</p>
    <p><b style="color: #006dcc">Departments</b>  under this faculty include:</p>
    @foreach($departments as $department)
    <p><b style="color: #C40D0D">->{{App\Department::getDepartmentName($department)}}</b> </p>
    @endforeach<br/>
    <p><b style="color: #006dcc">Courses</b>  under this faculty include:</p>
     @foreach($courses as $course)
    <p><b style="color: #C40D0D">->{{App\Course::getCourseCode($course)}} {{App\Course::getCourseName($course)}}</b>
        from the department of {{App\Department::getDepartmentName(App\Course::getCourseDept($course))}}</p>
    @endforeach<br/>
    <p><b style="color: #006dcc">Lecturers</b>  under this faculty include:</p>    
    @foreach($lecturers as $lecturer)
    <p><b style="color: #C40D0D">->{{App\Lecturer::getLecturerName($lecturer)}}</p>
    @endforeach<br/>
    <p><b style="color: #006dcc">Student groups</b>  attached with this faculty departments include:</p>    
    @foreach($students as $student)
    <p><b style="color: #C40D0D">->{{App\Department::getDepartmentCode($student->departments_id)}} 
            {{App\Level::getLevelName($student->levels_id)}}</p>
    @endforeach
    

    <a href="{{URL::to('deleteFaculty/'.$faculty->id) }}" onclick="return confirm('Are you sure you want to delete this faculty?')"><button class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign" style="color:color"></span> Proceed >></button></a>

</div>
@endsection