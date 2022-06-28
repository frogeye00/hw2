@extends('layouts.main')

@section('title','7thArt-Cerca')

@section('style')
<link rel='stylesheet' href="{{url('css/search.css')}}">
@endsection

@section('script')
<script src="{{url('js/search.js')}}" defer></script>
@endsection

@section('content')
<h1 id="welcome">Ciao {{ $username }}, cerca un film attraverso il titolo per conoscerne il rating IMDb!</h1>
            <form name='search' method='post'>
                <input type="text" name="title" placeholder="Inserisci il titolo di un film" id="title_search">
                <input type='submit' value='Cerca'>
            </form>
            
            <section id="filmview">
                <article id="film">
                    <div id="button"></div>
                    <h2 id="film_title"></h2>
                    <span id="rating"></span>
                    <img id="image">
                     
                </article>
            </section>
@endsection