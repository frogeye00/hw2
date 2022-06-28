@extends('layouts.main')

@section('title','7thArt-Preferiti')

@section('style')
<link rel='stylesheet' href="{{url('css/favorites.css')}}">
@endsection

@section('script')
<script src="{{url('js/favorites.js')}}" defer></script>
@endsection

@section('content')

<h1 id="welcome">Ciao {{$username}}, ecco i tuoi film preferiti :</h1>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Rating</th>
                    <th></th>
                </tr>
            </table>

@endsection