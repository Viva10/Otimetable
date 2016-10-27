@extends('master')

@section('title')
    Edit a Hall
@endsection
@section('header')
<color style="color: #ff6600">Editing</color> <b style="color: blue">{{$hall->hall_name}}</b>
@endsection

@section('content')
<div class="panel panel-default">
    <div class="form form-group">
        <form class="form-group" method="POST" action="{{ URL::to('updateHall/'.$hall->id) }}">
            <div class="form-group">
                <label>Hall Name*</label>
                <input type="text" name="hall_name" value="{{$hall->hall_name}}" class="form-control" style="width:60%">
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="form-group">
                <label>Hall Capacity*</label>
                <input type="number" name="hall_capacity" value="{{$hall->hall_capacity}}" class="form-control" style="width:60%">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection