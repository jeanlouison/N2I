<link rel="stylesheet" href="{{ URL::asset('css/outils.css') }}">
@extends('layout/app')
@section('title','Content')


@section('main')
    @parent
    <section class="panel">
        <p><a href="/" class="arbre">Accueil</a> / <a href="/outils/categories">Forum</a> / </p>
        <article>
            @include('articles/'.$subjects->contents)
        </article>
    </section>
@endsection