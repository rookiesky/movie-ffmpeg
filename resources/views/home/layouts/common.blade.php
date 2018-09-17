@include('home.layouts.header')
<body>
@include('home.layouts.nav')
@yield('content')

@include('home.layouts.footer')

@include('home.layouts.js')
@yield('script')
@if(isset(cache('system_base')->count)){!! cache('system_base')->count !!}@endif
</body>
</html>