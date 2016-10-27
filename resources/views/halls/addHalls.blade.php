@extends('master')

@section('header')
    Add New Halls
@endsection
@section('content')
    <div class="form form-group">
        <form class="form-group" method="POST" action="{{ URL::to('saveHall')}}">
            <div class="form-group">
                <label>Hall Name*</label>
                <input type="text" name="hall_name" placeholder="e.g Room 1A" required="required" class="form-control" style="width:60%">
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div class="form-group">
                <label>Hall Capacity*</label>
                <input type="number" name="hall_capacity" placeholder="e.g 200" required="required" class="form-control" style="width:60%">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection
@section('title')
    Add a Hall
@endsection