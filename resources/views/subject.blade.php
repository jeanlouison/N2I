<link rel="stylesheet" href="{{ URL::asset('css/forum.css') }}">
@extends('layout/app')
@section('title','subject')

@section('main')
    @parent
    <section class="panel">
        <p><a href="/" class="arbre" >Accueil</a> / <a href="/forum/categories">Forum</a> / <a href="/forum/category/{{ $category}}">{{ $category}}</a> /</p>
        <section>
            <article class="message" aria-label="Post du forum">
                <p class="msg-title" aria-label="Intitulé du message">{{$subject->name}}</p>
                <p class="msg-msg" aria-label="Message">{{$subject->content}}</p>
            </article>
            @foreach ($messages as $message)
                <article class="message" aria-label="Réponse au post">
                    <p class="message" aria-label="Titre de la réponse">{{$categorie->titre}}</p>
                </article>
        @endforeach
        </section>
        <section>
            <form id="addUserForm" action="sendmessage/{{$subject->id}}" role="form" method="get">
                @csrf
                <fieldset>
                    <label class="fs_title" for="message">Répondre.</label>
                    <textarea rows="4" cols="50" id="message" role="textbox" name="content" form="addUserForm" placeholder="Message ..."></textarea>
                    <input type="submit" value="Répondre">
                </fieldset>
            </form>
        </section>
    </section>
@endsection
