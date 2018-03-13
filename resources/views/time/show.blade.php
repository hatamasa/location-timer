@extends('layouts/layout')
@section('title', 'location-timer')

@section('sidebar')
@endsection

@section('content')

<h1>delete comfirm</h1>

<form method="post" action="/delete">
    {{ csrf_field() }}
    <input type="hidden" class="form-control" name="id" value="{{ $time->id }}">
    <div class="form-group">
        <label for="countryNameInput">country name</label>
        <input type="text" readonly class="form-control" id="countryNameInput" name="country_name" value="{{ $time->country_name }}">
    </div>
    <div class="form-group">
        <label for="utcDiffInput">diff from utc</label>
        <input type="text" readonly class="form-control" id="utcDiffInput" name="utc_diff" value="{{ $time->utc_diff }}">
    </div>
    <div class="form-group">
        <label for="timezoneInput">timezone</label>
        <input type="text" readonly class="form-control" id="timezoneInput" name="timezone" value="{{ $time->timezone }}">
    </div>

    <button type="submit" class="btn btn-primary">delete</button>
</form>

@endsection