<!DOCTYPE html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<title>Hello Vue</title>
<meta name="csrf-token" context="{{ csrf_token() }}">
<script>
        window.Laravel = {};
        window.Laravel.csrfToken = "{{ csrf_token() }}";
    </script>
</head>
<body>
    <div id="app">
        <p>
            <router-link to="/">index</router-link>
            <router-link to="/hello">hello</router-link>
        </p>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>