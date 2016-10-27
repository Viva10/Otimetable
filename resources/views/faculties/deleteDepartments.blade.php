@extends('master')

@section('title')
    Delete Departments
@endsection

@section('header')
<p class ="alert bg-warning"><svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg>Deleting a Department completely removes its record and that of it's <b>students</b> and <b>courses</b> from the database!!!</p>

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
                </ul>
        </div>
        <div class="table table-bordered">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>N0.</th>
                    <th>Department Name</th>
                    <th>Department Code</th>
                    <th>Department's Faculty</th>
                    <th>Date Added</th>
                    <th>Delete Faculty</th>
                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($departments as $department)
                
                    <tr style="background-color: @if($department->availability == 0) #eeeeee @endif">
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td>{{$department->department_name}}</td>
                        <td>{{$department->department_code}}</td>
                        <td>{{App\Department::getDeptFaculty($department->id)}}</td>
                        <td>{{date('F d Y H:i', strtotime($department->created_at))}}</td>
                        <td><a href="{{ URL::to('deleteDepartmentPage/'.$department->id) }}" ><button type = "button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" style="color:color"></span> Delete</button></a> </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!!$departments->render()!!}
    </div><!--/.row-->


@endsection

