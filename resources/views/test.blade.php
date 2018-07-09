<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Hello Vue</title>
    <script type="text/javascript">
        window.Laravel = window.Laravel || {};
        window.Laravel.csrfToken = "{{csrf_token()}}";
    </script>
</head>
<body>
    <div id="app">
        {{--<example-component></example-component>--}}

        <div class="container">
            <p>
                <router-link to="/test/index/">Go to index</router-link>
                <router-link to="/test/hello/">Go to hello</router-link>
            </p>
            <router-view></router-view>
        </div>
    </div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>