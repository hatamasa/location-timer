@extends('layouts/layout')
@section('title', 'HelloWorld!!')

@section('sidebar')

  <p>ここはメインのサイドバーに追加される</p>
@endsection

@section('content')
  <p>{{ $text }}</p>
@endsection