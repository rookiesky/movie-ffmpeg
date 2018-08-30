@include('home.layouts.header')
<body>
@include('home.layouts.nav')
@yield('content')

@include('home.layouts.footer')

@include('home.layouts.js')
@yield('script')
{!! cache('system_base')->count !!}
</body>
</html>