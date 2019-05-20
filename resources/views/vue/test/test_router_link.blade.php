@extends('vue/layouts/layout')
@section('title', 'test vue')

@section('content')

<div id="header">
    <test-header></test-header>
</div>
<div id="app">
    <p>
        <router-link to="/vue/test_router_link/">index</router-link>
        <router-link to="/vue/test_router_link/hello">hello</router-link>
    </p>
    <router-view></router-view>
</div>

@endsection
