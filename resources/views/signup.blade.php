@extends('layouts.guest')

@section('script')
<script src="{{url('js/signup.js')}}" defer></script>

@endsection

@section('title','7thArt-Registrati!')

@section('content')
<main>
 <img src="./images/SeventhArt.png" id="title">
<h3>Registrati!</h3>
<form name='registration' method='post' autocomplete='off' action="/signup">
    @csrf
    <p class="name">
        <label>Nome <input type='text' name='name' value="{{ old('name') }}" ></label>
        <span>Inserire solo lettere e spazi</span>
    </p>
    <p class="surname">
        <label>Cognome <input type='text' name='surname' value="{{ old('surname') }}"></label>
        <span>Inserire solo lettere e spazi</span>
    </p>
    <p class="username">
        <label>Username <input type='text' name='username' value="{{ old('username') }}" ></label>
        <span>Sono ammessi solo lettere, numeri e underscore.Max:16</span>
    </p>
    <p class="email">
        <label>E-mail <input type='text' name='email' value="{{ old('email') }}"></label>
        <span>Email non valida</span>
    </p>
    <p class="password">
        <label>Password <input class="psw" type='password' name='password'></label>
        <label>&nbsp;<input type="button" value="Mostra/nascondi password" class="password_show"></label>
        <span>Password non valida.Min:8</span>
    </p>
    <p class="confirm_password">
        <label>Confirm Password <input class="psw" type='password' name='confirm_password'></label>
        <label>&nbsp;<input type="button" value="Mostra/nascondi password" class="password_show"></label>
        <span>Le password non coincidono</span>
    </p>
    <p>
        <label>&nbsp;<input type='submit' value='Registrati' id="submit" disabled></label>
        </p>
</form>
<div class="accedi">Hai già un account?<a class="accedi" href="{{ url('login') }}">Accedi</a></div>          
</main>
@endsection