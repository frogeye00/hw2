<!doctype html>
<html>
    <head>
        <script> BASE_URL="{{ url('/') }}/" </script>
        @yield('script')
        <link rel='stylesheet' href="{{url('css/guest.css')}}">
        @yield('style')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 

        <title>@yield('title')</title>
    </head>
    <body>
        @yield('navbar')
        <div id="regdiv">
            
                @yield('content')
            
        </div>
       
    </body>
</html>