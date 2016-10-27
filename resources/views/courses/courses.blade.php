@extends('masterCourse')

@section('title')
    Courses
@endsection

@section('header')
    Manage Courses
@endsection
@section('link')
    
    <div class="col-sm-3"style="">
        <div class="panel panel-blue panel-widget">
            <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                    <svg class="glyph stroked male user"><use xlink:href="#stroked-male-user"/></svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large">-</div>
                            <div class="text-muted"><a href="{{ URL::to('courseStudents') }}" class="">Course Students</a></div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3"style="">
        <div class="panel panel-teal panel-widget">
            <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                    <svg class="glyph stroked clipboard-with-paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large">-</div>
                            <div class="text-muted"><a href="{{ URL::to('courseSchedulesPage') }}" class="">Course Schedules</a></div>
                    </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
<div class="row">
        <div class="panel-heading">Table of All Courses </div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort Courses
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Name</a></li>
                  <li><a href="#">code</a></li>
                  <li><a href="#">faculty</a></li>
                  <li><a href="#">student size</a></li>
                  <li><a href="#">level</a></li>
                </ul>
        </div>
        <div class="table table-bordered">
            <table class="table table-bordered table-hover" style="background: url('images/ttglogo1.jpg') center">
                <tr>
                    <th>N0.</th>
                    <th>Course Name</th>
                    <th>Code</th>
                    <th>Student Size</th>
                    <th>Period/week</th>
                    <th>Practical/Theory</th>
                    <th>Level</th>
                    <th>Students</th>
                    <th>Date Added</th>
                    <th>Edit Course</th>
                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($courses as $course)
                   
                    <tr style="background-color: @if($course->availability == 0) #eeeeee @endif">
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td><a href="{{ URL::to('courseDetail/'.$course->id) }}">{{$course->course_name}}</a></td>
                        <td><a href="{{ URL::to('courseDetail/'.$course->id) }}">{{$course->course_code}}</a></td>

                        <td>{{$course->student_size}}</td>
                        <td>{{$course->period_number}}</td>

                        <td>{{$course->type}}</td>
                        <td>{{App\Course::getCourseLevel($course->id)}}</td>
                        <td>@foreach(App\Course::getCourseStudentsName($course->id) as $stud) {{$stud}}<br/> @endforeach</td>

                        <td>{{date('F d Y H:i', strtotime($course->created_at))}}</td>
                        <td><a href="{{ URL::to('editCourses/'.$course->id) }}"><button type = "button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" style="color:color"></span> Edit</button></a> </td>
                    </tr>
        @endforeach
            </table>
        </div>
        {!!$courses->render()!!}
    </div><!--/.row-->


@endsection

