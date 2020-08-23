<html>
<head>
    <title>App Name - @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vant@2.9/lib/index.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
@section('header')
    <!-- his is the master header. -->
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
