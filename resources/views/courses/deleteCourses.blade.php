@extends('master')

@section('title')
    Delete a Course
@endsection
@section('header')
<p class ="alert bg-warning"><svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg>Deleting a Course completely removes it from the database.</p>
@endsection

@section('content')
<div class="row">
        <div class="panel-heading">Table of All Courses</div>
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
                </ul>
        </div>
        <div class="table table-bordered">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>N0.</th>
                    <th>Course Name</th>
                    <th>Code</th>
                    <th>Student Size</th>
                    <th>Period per week</th>
                    <th>Practical/Theory</th>
                    <th>Date Added</th>
                    <th>Edit Course</th>
                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($courses as $course)
                   
                    <tr style="background-color: @if($course->availability == 0) #eeeeee @endif">
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td>{{$course->course_name}}</td>
                        <td>{{$course->course_code}}</td>
                        <td>{{$course->student_size}}</td>
                        <td>{{$course->period_number}}</td>

                        <td>{{$course->practical}}</td>

                        <td>{{date('F d Y H:i', strtotime($course->created_at))}}</td>
                        <td><a href="{{ URL::to('deleteCoursePage/'.$course->id) }}" ><button type = "button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" style="color:color"></span> Delete</button></a> </td>
                    </tr>
        @endforeach
            </table>
        </div>
        {!!$courses->render()!!}
    </div><!--/.row-->

@endsection