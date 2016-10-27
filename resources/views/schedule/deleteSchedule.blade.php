@extends('master')

@section('title')
    Delete Schedules
@endsection

@section('header')
    Delete Schedules
@endsection

@section('content')
<div class="row">
        <div class="panel-heading">Table of All Schedule Versions</div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort Schedules
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
                    <th>Version Name</th>
                    <th>Online Status</th>
                    <th>Delete</th>
                    <th>Date Added</th>
                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($allSchedules as $row)
                    
                    <tr>
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td><a href="{{URL::to('schedules/'.$row->id)}}">{{$row->version_name}}</a></td>
                        <td>@if($row->current_status == 1)
                            Online
                        @endif
                        </td>
                        <td>{{date('l, F d Y H:i', strtotime($row->created_at))}}</td>
                        <td><a href="{{ URL::to('deleteSchedule/'.$row->id) }}" onclick="return confirm('Are you sure you want to delete this Schedule?')"><button type = "button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" style="color:color"></span> Delete</button></a> </td>
                    </tr>
          
                @endforeach
            </table>
        </div>
        {!!$allSchedules->render()!!}
    </div><!--/.row-->


@endsection
