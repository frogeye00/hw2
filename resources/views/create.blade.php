@extends('layouts.guest')

@section('script')

<script src="{{url('js/create.js')}}" defer></script>

@endsection

@section('style')
<link rel='stylesheet' href="{{url('css/create.css')}}">
@endsection


@section('title','7thArt-Crea un post')

@section('navbar')
<nav>
        <a href="{{ url('homepage') }}">Home</a>
        <a href="{{ url('search') }}">Cerca</a>
        <a href="{{ url('create') }}">Nuovo post</a>
        <a href="{{ url('favorites') }}">Preferiti</a>
        <a href="{{ url('logout') }}">Logout </a>
        </nav> 
@endsection

@section('content')

<main id="new_post">
                <img src="./images/SeventhArt.png" id="title">
                <h3>Ciao {{ $username }},crea un nuovo post!</h3>
                <form name='newpost' method='post' >
                    <p class="title">
                        <label>Titolo <textarea rows="3" cols="65" name='title' maxlength="31" placeholder="Inserisci un titolo..." required="required" value="{{ old('title') }}"></textarea></label>
                    </p>

                    <p class="content">
                        <label>Contenuto <textarea rows="20" cols="65" name='content' maxlength="500" placeholder="Inserisci del testo..." required="required" value="{{ old('content') }}"></textarea></label>
                    </p>
                    <p>
                        <label>&nbsp;<input type='submit' value='Crea post'></label>
                    </p>
                </form>
            </main>
@endsection