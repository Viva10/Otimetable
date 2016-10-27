@extends('master')

@section('title')
    {{$dept}} {{$level}}
@endsection

@section('header')
   Deleting {{$dept}} {{$level}} of {{$faculty}}.
@endsection

@section('content')
<div class="panel panel-info">
    <p><b style="color: #006dcc">{{$dept}} {{$level}}</b>  students are taking the following courses:</p>
    @foreach($courses as $course)
    <p><b style="color: #C40D0D">->{{App\Course::getCourseCode($course)}} {{App\Course::getCourseName($course)}}</b> 
        from the faculty of <b style="color: #00b3ee">{{App\Course::getCourseFaculty($course)}}</b></p>
    @endforeach

    <a href="{{URL::to('deleteStudent/'.$stud.'/'.$page) }}" onclick="return confirm('Are you sure you want to delete this student group?')"><button class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign" style="color:color"></span> Proceed >></button></a>

</div>
@endsection