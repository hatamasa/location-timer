@extends('layouts/layout')
@section('title', 'Page Title')

@section('sidebar')

  <p>ここはメインのサイドバーに追加される</p>
@endsection

@section('content')
  <p>{{ $text }}</p>
@endsection