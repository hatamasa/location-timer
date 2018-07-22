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
    <div id="header">
        <test-header></test-header>
    </div>
    <div id="app">
        <p>
            <router-link to="/vue/spa/">index</router-link>
            <router-link to="/vue/spa/hello">hello</router-link>
        </p>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
    <div id="todo">
        <todo></todo>
    </div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>