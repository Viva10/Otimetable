@extends('master')

@section('title')
    Course Visibility
@endsection

@section('header')
    Manage Course Visibility
@endsection
@section('link')
<div class="row" style="margin-top: 1%">
    <div class="col-sm-3"style="margin-left: 18%">
				<div class="panel panel-blue panel-widget">
                                    <div class="row no-padding">
                                            <div class="col-sm-3 col-lg-5 widget-left">
                                                <svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg>
                                            </div>
                                            <div class="col-sm-9 col-lg-7 widget-right">
                                                    <div class="large">-</div>
                                                    <div class="text-muted"><a href="{{ URL::to('#') }}" class=""></a></div>
                                            </div>
                                    </div>
				</div>
			</div>
    
    <div class="col-sm-3">
				<div class="panel panel-teal panel-widget">
                                    <div class="row no-padding">
                                            <div class="col-sm-3 col-lg-5 widget-left">
                                                <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"/></svg>
                                            </div>
                                            <div class="col-sm-9 col-lg-7 widget-right">
                                                    <div class="large">-</div>
                                                    <div class="text-muted"><a href="{{ URL::to('#') }}" class=""></a></div>
                                            </div>
                                    </div>
				</div>
			</div>
</div>
@endsection
@section('content')
<div class="row">
        <div class="panel-heading">Table of All Courses (!!excluded courses in gray!!)</div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort Courses
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Name</a></li>
                  <li><a href="#">code</a></li>
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
                    <th>Include</th>
                    <th>Exclude</th>
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

                        <td>{{date('F d Y H:i', strtotime($course->created_at))}}</td>
                        <td>@if($course->availability == 0) <a href="{{ URL::to('includeCourse/'.$course->id) }}"><button type = "button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open" style="color:color"></span> Include</button></a> @endif </td>
                        <td>@if($course->availability == 1) <a href="{{ URL::to('excludeCourse/'.$course->id) }}"><button type = "button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-eye-close" style="color:color"></span> Exclude</button></a> @endif </td>
                   </tr>

                @endforeach
            </table>
        </div>
        {!!$courses->render()!!}
    </div><!--/.row-->


@endsection

