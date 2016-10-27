@extends('master')

@section('title')
    {{App\Course::getCourseName($course)}}
@endsection

@section('header')
    Unassign Lecturers from {{App\Course::getCourseCode($course)}} {{App\Course::getCourseName($course)}}

@endsection

@section('content')
<div class="row">
        <div class="panel-heading">Table of Lecturers teaching {{App\Course::getCourseCode($course)}} {{App\Course::getCourseName($course)}} @if($results == 1) <b class ="alert bg-success"><svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> {{$message}} </b> @endif
                                               @if($results == 0) <b class ="alert bg-danger"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> {{$message}} </b> @endif
                                                @if($results == 2) <b class ="alert"> {{$message}} </b>  @endif  </div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort Lecturers
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
                    <th>Lecturer Name</th>
                    <th>Faculty</th>
                    <th>Unassign</th>
                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($lecturers as $lecturer)
                    
                    <tr>
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td>{{App\Lecturer::getLecturerName($lecturer)}}</td>
                        <td>{{App\Lecturer::getLecturerFacultyName($lecturer)}}</td>

                        <td><a href="{{ URL::to('unAssignLecturer/'.$course.'/'.$lecturer) }}" onclick="return confirm('Are you sure you want to proceed?')"><button type = "button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" style="color:color"></span> Unassign</button></a> </td>
                   </tr>                   
                @endforeach
            </table>
        </div>
        
    </div><!--/.row-->


@endsection

