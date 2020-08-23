@extends('layouts.app')

@section('title', 'Login')

@section('header')
    @parent
    <!--<p>This is appended to the master sidebar.</p>-->
@endsection

@section('content')
    <link rel="stylesheet" href="/dist/login.css" />
    <div id="login"></div>
    <script src="/dist/login.js"></script>
@endsection

@section('footer')
    @parent
    <!--<p>This is appended to the master sidebar.</p>-->
@endsection
