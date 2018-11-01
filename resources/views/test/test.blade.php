<!DOCTYPE HTML>
<html lang="ja">

<head>
<title>@yield('title')</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<meta name="csrf-token" context="{{ csrf_token() }}">
<script>
    window.Laravel = {};
    window.Laravel.csrfToken = "{{ csrf_token() }}";
</script>
</head>
</head>

<body>
    @include('layouts/common-header')
    <div class="container">
    <h1>test</h1>
    @foreach ($data as $row)
        @foreach ($row as $col)
            <div>{{ $col }}</div>
        @endforeach
        <br/>
    @endforeach
    </div>
</body>