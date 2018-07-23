<!DOCTYPE html>
<html lang="ja">

<head>
<title>@yield('title')</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> -->
<meta name="csrf-token" context="{{ csrf_token() }}">
<script>
    window.Laravel = {};
    window.Laravel.csrfToken = "{{ csrf_token() }}";
</script>
</head>

<body>
    @include('layouts/common-header')
    <div class="container">
        @yield('content')
    </div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>