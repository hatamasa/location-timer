@extends('layouts/layout')
@section('title', 'location-timer')

@section('sidebar')
@endsection

@section('content')

<h1>timezone lists</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">country_name</th>
            <th scope="col">timezone</th>
            <th scope="col">Y/m/d D  H:i:s</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($country_times as $time)
        <tr>
            <th scope="row">{{ $time['id'] }}</th>
            <th scope="row">{{ $time['country_name'] }}</th>
            <th scope="row">{{ $time['timezone'] }}</th>
            <td>{{ $time['time'] }}</td>
            <td><a href="/edit/{{ $time['id'] }}">edit</a></td>
            <td><a href="/delete/{{ $time['id'] }}">delete</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection