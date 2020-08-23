@extends('layouts.app')

@section('title', 'Register')

@section('header')
    @parent
    <!--<p>This is appended to the master sidebar.</p>-->
@endsection

@section('content')
    <link rel="stylesheet" href="/dist/register.css" />
    <div id="register"></div>
    <script src="/dist/register.js"></script>
@endsection

@section('footer')
    @parent
    <!--<p>This is appended to the master sidebar.</p>-->
@endsection
