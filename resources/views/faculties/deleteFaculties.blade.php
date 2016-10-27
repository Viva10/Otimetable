@extends('master')

@section('title')
    Delete Faculties
@endsection

@section('header')
<p class ="alert bg-warning"><svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg>Deleting a Faculty completely removes its record and that of it's <b>departments</b>,<b>students</b> and <b>courses</b> from the database!!!</p>

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
            <table class="table table-bordered table-hover">
                <tr>
                    <th>N0.</th>
                    <th>Faculty Name</th>
                    <th>Faculty's Departments</th>
                    <th>Date Added</th>
                    <th>Delete Faculty</th>
                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($faculties as $faculty)
                   
                    <tr style="background-color: @if($faculty->availability == 0) #eeeeee @endif">
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td>{{$faculty->faculty_name}}</td>
                        <td>@foreach($depts as $dept){{App\Department::getDepartmentName($dept)}}<br/> @endforeach</td>
                        <td>{{date('F d Y H:i', strtotime($faculty->created_at))}}</td>
                        <td><a href="{{ URL::to('deleteFacultyPage/'.$faculty->id) }}" ><button type = "button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" style="color:color"></span> Delete</button></a> </td>
                    </tr>
        @endforeach
            </table>
        </div>
        {!!$faculties->render()!!}
    </div><!--/.row-->


@endsection

