@extends('layouts/layout')
@section('title', 'location-timer')

@section('sidebar')
@endsection

@section('content')

@foreach ($times as $time)
<table>
    <tbody>
        <tr>
            <th>{{ $time['name'] }}</th>
            <td>{{ $time['time'] }}</td>
        </tr>
    </tbody>
</table>
@endforeach

@endsection