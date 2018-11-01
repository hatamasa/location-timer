<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div id="app">
        <navbar></navbar>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>