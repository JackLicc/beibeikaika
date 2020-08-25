<html>
<head>
    <title>App Name - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vant@2.9/lib/index.css"/>
    <link rel="stylesheet" href="/assets/css/public.css" />
</head>
<body>
@section('header')
    <div class="header">
        <div class="logo-container">
            <div class="logo"></div>
        </div>
    </div>
@show

<div class="container">
    @yield('content')
</div>

@section('footer')
    <!-- his is the master footer. -->
@show
<!-- import script -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vant@2.9/lib/vant.min.js"></script>
</body>
</html>
