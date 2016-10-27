@extends('master')

@section('title')
    {{$department_name}}
@endsection

@section('header')
   Deleting the department of {{$department_name}}.
@endsection

@section('content')
<div class="panel panel-info">
    <p>Before Deleting this department you must first delete all records of the department's students and courses.!!! So if you wish to conserve any of the records
    below, then go edit them and link them to some other faculty or delete them first before attempting to delete this department.!!!!!!!</p>
   
    <p><b style="color: #006dcc">Courses</b>  under this department include:</p>
     @foreach($courses as $course)
    <p><b style="color: #C40D0D">->{{App\Course::getCourseCode($course)}} {{App\Course::getCourseName($course)}}</b>
        from the department of {{App\Department::getDepartmentName(App\Course::getCourseDept($course))}}</p>
    @endforeach<br/>
    
    <p><b style="color: #006dcc">Student groups</b>  attached with this faculty departments include:</p>    
    @foreach($students as $student)
    <p><b style="color: #C40D0D">->{{App\Department::getDepartmentCode($student->departments_id)}} 
            {{App\Level::getLevelName($student->levels_id)}}</p>
    @endforeach
    

    <a href="{{URL::to('deleteDepartment/'.$id) }}" onclick="return confirm('Are you sure you want to delete this department?')"><button class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign" style="color:color"></span> Proceed >></button></a>

</div>
@endsection