@extends('masterPeriod')

@section('title')
    Days & Periods
@endsection

@section('header')
    Manage Periods
@endsection

@section('content')
<div class="row">
        <div class="panel-heading">Table of Periods </div>
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
            <table class="table table-bordered table-hover">
                <tr>
                    <th>N0.</th>
                    <th>Day Name</th>
                    <th>Time Name</th>
                    <th>Date Added</th>
                </tr>
              
<!-- Controlling the color of the row if the hall is included to the scheduler or excluded-->
                @foreach($periods as $period)
                    <tr style="background-color: @if($period->availability == 0) #eeeeee @endif">
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td>{{App\Period::getDayName($period->days_id)}}</td>
                        <td>{{App\Period::getPeriodName($period->periods_id)}}</td>
                                               
                        <td>{{date('F d Y H:i', strtotime($period->created_at))}}</td>
                    </tr>
        @endforeach
            </table>
        </div>
        {!!$periods->render()!!}
    </div><!--/.row-->


@endsection

