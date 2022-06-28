<!DOCTYPE html>
<html>

    <head>
        <script> BASE_URL="{{ url('/') }}/" </script>
        @yield('script')
        <link rel='stylesheet' href="{{url('css/main.css')}}">
        @yield('style')


        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
    </head>
    <body>
        <nav>
        <a href="{{ url('homepage') }}">Home</a>
        <a href="{{ url('search') }}">Cerca</a>
        <a href="{{ url('create') }}">Nuovo post</a>
        <a href="{{ url('favorites') }}">Preferiti</a>
        <a href="{{ url('logout') }}">Logout </a>
        </nav>
        <header>
            <div id ="overlay"></div>
            <div class ='flex-container'>
            <img id="title" src="./images/SeventhArt.png">
            </div>
        </header>
        
        <main>
            @yield('content')
        </main>
        <footer>
            <p>
                <div class ='flex-container'>
                <p id="footer">Matteo Celia <br> N°Matricola:1000001836</p>
                </div>
            </p>
        </footer>
    </body>
</html>