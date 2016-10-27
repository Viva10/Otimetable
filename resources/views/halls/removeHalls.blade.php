@extends('master')

@section('title')
    Exclude a Hall
@endsection
@section('header')
<b style="color: #666666">Exclude a Hall from the Scheduler.</b>
@endsection

@section('content')
<div class="panel-heading">Table of Halls in the Scheduler @if($results == 1)<p class ="alert bg-success"><svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> {{$message}} </b>@endif
                                               @if($results == 0)<b class ="alert bg-danger"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> {{$message}} </b>@endif
                                                @if($results == 2)<b class ="alert"> {{$message}} </b>@endif</div>
        <div class="pull-right"> <input type="search" placeholder="search"> 
            <button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
            
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Sort halls
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Name</a></li>
                  <li><a href="#">Hall Capacity</a></li>
                </ul>
        </div>
        <div class="table table-bordered">
            <table class="table table-bordered table-hover" style="background: url('images/ttglogo1.jpg') center">
                <tr>
                    <th>N0.</th>
                    <th>Hall Name</th>
                    <th>Hall Capacity</th>
                    <th>Date Added</th>
                    <th>Exclude Hall</th>
                </tr>
                
                @foreach($halls as $hall)
                    <tr>
                        <td><?php $i++;
                        echo $i; ?></td>
                        <td>{{$hall->hall_name}}</td>
                        <td>{{$hall->hall_capacity}}</td>
                        <td>{{date('l, F d Y H:i', strtotime($hall->created_at))}}</td>
                        <td><a href="{{ URL::to('removeHall/'.$hall->id) }}"><button type = "button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-eye-close" style="color:color"></span> Exclude</button></a> </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!!$halls->render()!!}
    </div><!--/.row-->


@endsection