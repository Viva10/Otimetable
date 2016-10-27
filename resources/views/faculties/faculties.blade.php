@extends('masterFaculty')

@section('title')
    Faculty & Departments
@endsection

@section('header')
    Manage Faculties
@endsection
@section('link')
    
    <div class="col-sm-3"style="">
        <div class="panel panel-teal panel-widget">
            <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                    <svg class="glyph stroked male user"><use xlink:href="#stroked-male-user"/></svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large">-</div>
                            <div class="text-muted"><a href="{{ URL::to('departmentFaculty') }}" class="">Department's Faculty</a></div>
                    </div>
            </div>
        </div>
    </div>
     <div class="col-sm-3"style="">
        <div class="panel panel-red panel-widget">
            <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                    <svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large">-</div>
                            <div class="text-muted"><a href="{{ URL::to('deleteDepartments') }}" class="">Delete Department</a></div>
                    </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
<div class="row">
        <div class="panel-heading">Table of All Faculties </div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort Facultiess
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Name</a></li>
                </ul>
        </div>
        <div class="table table-bordered">
            <table class="table table-bordered table-hover" style="background: url('images/ttglogo1.jpg') center">
                <tr>
                    <th>N0.</th>
                    <th>Faculty Name</th>
                    <th>Faculty's Departments</th>
                    <th>Date Added</th>
                    <th>Edit Faculty</th>
                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($faculties as $faculty)
                   <?php $depts = App\Faculty::getFacultyDepartments($faculty->id) ?>
                    <tr style="background-color: @if($faculty->availability == 0) #eeeeee @endif">
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td>{{$faculty->faculty_name}}</td>
                        
                        <td>@foreach($depts as $dept){{App\Department::getDepartmentName($dept)}}<br/> @endforeach</td>
                        
                        <td>{{date('F d Y H:i', strtotime($faculty->created_at))}}</td>
                        <td><a href="{{ URL::to('editFaculty/'.$faculty->id) }}"><button type = "button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" style="color:color"></span> Edit</button></a> </td>
                    </tr>
        @endforeach
            </table>
        </div>
        {!!$faculties->render()!!}
    </div><!--/.row-->


@endsection

