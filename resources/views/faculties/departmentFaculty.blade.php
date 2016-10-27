@extends('master')

@section('title')
    Department's Faculty
@endsection

@section('header')
    Manage Department's Faculty
@endsection
@section('content')
<div class="row">
        <div class="panel-heading">Table of All Departments </div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort Departments
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Name</a></li>
                  <li><a href="#">code</a></li>
                </ul>
        </div>
        <div class="table table-bordered">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>N0.</th>
                    <th>Department Name</th>
                    <th>Department Code</th>
                    <th>Department Faculty</th>
                    <th>Change Faculty</th>
                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($departments as $department)
                                        
                    <tr style="background-color: @if($department->availability == 0) #eeeeee @endif">
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td><a href="{{ URL::to('departmentDetail/'.$department->id) }}">{{$department->department_name}}</a></td>
                        <td><a href="{{ URL::to('departmentDetail/'.$department->id) }}">{{$department->department_code}}</a></td>
                        <td>{{App\Department::getDeptFaculty($department->id)}}</td>
                        <td><a href="{{ URL::to('changeDeptFaculty/'.$department->id) }}"><button type = "button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" style="color:color"></span> Change Faculty</button></a> </td>
                   </tr>

                @endforeach
            </table>
        </div>
        {!!$departments->render()!!}
    </div><!--/.row-->


@endsection

