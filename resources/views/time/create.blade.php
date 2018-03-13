@extends('layouts/layout')
@section('title', 'location-timer')

@section('sidebar')
@endsection

@section('content')

<h1>add country</h1>
<form method="post" action="/create">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="countryNameInput">country name</label>
        <input type="text" class="form-control" id="countryNameInput" name="country_name">
    </div>
    <div class="form-group">
        <label for="utcDiffInput">diff from utc</label>
        <input type="text" class="form-control" id="utcDiffInput" name="utc_diff">
    </div>
    <div class="form-group">
        <label for="timezoneInput">timezone</label>
        <input type="text" class="form-control" id="timezoneInput" name="timezone">
    </div>

    <button type="submit" class="btn btn-primary">save</button>
</form>

@endsection