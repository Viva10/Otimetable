@extends('master')

@section('title')
    Departments
@endsection

@section('header')
    Manage Departments
@endsection

@section('content')

<div class="panel form form-group" style="background-color: #eeeeee">
      <form class="form-group" method="POST" action="{{ URL::to('saveDepartment')}}">
          <div class="form">
            <h4 style="color: #2b669a">Add New Department!</h4>
            <div class="form-group">
                <label>Faculty*</label>
                <select name="faculty" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Faculty</option>
                    @foreach($faculties as $faculty)
                    <option name="{{$faculty->id}}" value="{{$faculty->id}}">{{$faculty->faculty_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Department Name*</label>
                <input type="text" name="department_name" placeholder="department name" required="" class="form-control" style="width:60%" />
            </div>
            <div class="form-group">
                <label>Department Code*</label>
                <input type="text" name="code" placeholder="XXX" required="" class="form-control" style="width:60%" />
            </div>
              <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Department</button>
            </div>
            
      </form>
  </div>
  </div>
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
                  <li><a href="#">Faculty</a></li>
                </ul>
        </div>
        <div class="table table-bordered">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>N0.</th>
                    <th>Department Name</th>
                    <th>Department Code</th>
                    <th>Department Faculty</th>
                    <th>Date Added</th>
                    <th>Edit</th>
                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($departments as $department)
                                        
                    <tr>
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td>{{$department->department_name}}</td>
                        <td>{{App\Department::getDepartmentCode($department->id)}}</td>
                        <td>{{App\Department::getDeptFaculty($department->id)}}</td>
                        <td>{{date('F d Y H:i', strtotime($department->created_at))}}</td>
                        <td><a href="{{ URL::to('editDepartment/'.$department->id) }}" ><button type = "button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" style="color:color"></span> Edit</button></a></td>
                   </tr>

                @endforeach
            </table>
        </div>
        {!!$departments->render()!!}
    </div><!--/.row-->


@endsection

