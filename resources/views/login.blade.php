@extends('layouts.guest')

@section('script')

<script src="{{url('js/login.js')}}" defer></script>

@endsection

@section('style')
<link rel='stylesheet' href="{{url('css/login.css')}}">
@endsection


@section('title','7thArt-Accedi!')

@section('content')
<main id="login">
                <img src="./images/SeventhArt.png" id="title">
<h3>Accedi!</h3>
                @if ($error=='wrong')
                <section class="errore">Username e/o password non validi </section>
                @endif
                
                <form name='login' method='post' action="{{ url('login') }}">
                    @csrf
                    <p class="username">
                        <label>Username <input type='text' name='username' value="{{ old('username') }}"></label>
                    </p>

                    <p class="password">
                        <label>Password <input type='password' name='password' id="password">
                          
                        </label>
                        <label>&nbsp;<input type="button" value="Mostra/nascondi password" id="password_show"></label>
                    </p>
                    <p>
                        <label>&nbsp;<input type='submit' value='Accedi'></label>
                    </p>
                </form>
                <div class="accedi">Non hai ancora un account?<a class="accedi" href="{{ url('signup') }}">Registrati</a></div>
                </main>
 @endsection