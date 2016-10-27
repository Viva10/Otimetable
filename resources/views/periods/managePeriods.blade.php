@extends('master')

@section('title')
    Manage Periods
@endsection

@section('header')
    Manage Periods
@endsection

@section('content')
<div class="form form-group">
        <form class="form-group" method="POST" action="{{ URL::to('savePeriod')}}">
            <label>**Create New Period**</label>
            <div class="form-group">
                <label>Day*</label>
                <select name="day" class="dropdown form-control" required="required" style="width: 60%">
                    <option name="" value="">Select Day</option>
                    @foreach($days as $day)
                    <option name="{{$day->id}}" value="{{$day->id}}">{{$day->day_name}}</option>
                    @endforeach
                </select>
            </div>
 
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="form-group">
                <label>Time*</label>
                <select name="time" id="levels" class="dropdown form-control" required="" style="width: 60%">
                    <option name="" value="">Select Time</option>
                     @foreach($times as $time)
                    <option name="{{$time->id}}" value="{{$time->id}}">{{$time->period_start}} {{$time->period_end}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Period</button>
            </div>
        </form>
    </div>

<div class="row">
        <div class="panel-heading">Table of All Periods </div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort Periods
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
                    <th>Day Name</th>
                    <th>Time Name</th>
                    <th>Date Added</th>
                    <th>Include</th>
                    <th>Exclude</th>
                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($periods as $period)
                    <tr style="background-color: @if($period->availability == 0) #eeeeee @endif">
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td>{{App\Period::getDayName($period->days_id)}}</td>
                        <td>{{App\Period::getPeriodName($period->periods_id)}}</td>
                                               
                        <td>{{date('F d Y H:i', strtotime($period->created_at))}}</td>
                         <td>@if($period->availability == 0) <a href="{{ URL::to('includePeriod/'.$period->id) }}"><button type = "button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open" style="color:color"></span> Include</button></a> @endif </td>
                        <td>@if($period->availability == 1) <a href="{{ URL::to('excludePeriod/'.$period->id) }}"><button type = "button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-eye-close" style="color:color"></span> Exclude</button></a> @endif </td>

                   </tr>

                @endforeach
            </table>
        </div>
          {!!$periods->render()!!}
    </div><!--/.row-->


@endsection

