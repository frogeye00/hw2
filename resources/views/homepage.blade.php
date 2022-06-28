@extends('layouts.main')

@section('title','7thArt-Home')

@section('style')
<link rel='stylesheet' href="{{url('css/homepage.css')}}">
@endsection

@section('script')
<script src="{{url('js/homepage.js')}}" defer></script>

@endsection

@section('content')
<h1 id="welcome">Ciao {{ $username }},benvenuto nel nostro forum di discussione su cinema, serie Tv e tanto altro!</h1>
            
            <section id="feed">
                <template id="post_template">
                    <article class="post">
                        <div class="remove_button"></div>
                        <div class="userinfo">
                            
                            <div class="username"></div>
                            <div class="time"></div>
                        </div>
                        <div class="title"></div>
                        <div class="content"></div>
                        <div class="actions">
                            <div class="like"><span></span></div>
                            <div class="comment"><span></span></div> 
                        </div>
                        <div class="comments">
                            <div class="past_messages"></div>
                            <div class="comment_form">
                                <form autocomplete="off">
                                    <input type="text" name="comment" maxlength="254" placeholder="Scrivi un commento..." required="required">
                                    <input type="submit">
                                    <input type="hidden" name="postid">
                                </form>
                            </div>
                        </div>
                    </article>
                </template>
                
            </section>
@endsection