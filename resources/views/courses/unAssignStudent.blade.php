@extends('master')

@section('title')
    {{App\Course::getCourseName($course)}}
@endsection

@section('header')
    Unassign Students from {{App\Course::getCourseCode($course)}} {{App\Course::getCourseName($course)}}

@endsection

@section('content')
<div class="row">
        <div class="panel-heading">Table of Students offering {{App\Course::getCourseCode($course)}} {{App\Course::getCourseName($course)}}</div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort Students
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Name</a></li>
                </ul>
        </div>
        <div class="table table-bordered">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>N0.</th>
                    <th>Student Name</th>
                    <th>Department</th>
                    <th>Faculty</th>
                    <th>Unassign</th>
                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($students as $student)
                    
                    <tr>
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td>{{App\Department::getDepartmentCode($student->departments_id)}} {{App\Level::getLevelName($student->levels_id)}}</td>
                        <td>{{App\Department::getDepartmentName($student->departments_id)}}</td>
                        <td>{{App\Department::getDeptFaculty($student->departments_id)}}</td>
                        <td><a href="{{ URL::to('unAssignStudent/'.$course.'/'.$student->id) }}" onclick="return confirm('Are you sure you want to proceed?')"><button type = "button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" style="color:color"></span> Unassign</button></a> </td>
                   </tr>                   
                @endforeach
            </table>
        </div>
        
    </div><!--/.row-->


@endsection

