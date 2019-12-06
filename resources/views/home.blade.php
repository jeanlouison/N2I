<link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">
@extends('layout.app')
@section('title', 'Home')
@section('main')
    @parent
    <section class="panel index">
        <h2 role="doc-subtitle">Index</h2>
        <section class="boxChar">
            <a href="outils/categories" role="button" style="background-color: #4d429b" aria-label="Outils">Outils</a>
            <a href="forum/categories" role="button" style="background-color: #ea622a" aria-label="Forums">Forum</a>
        </section>
    </section>

    <section class="panel news">
        <h2 role="doc-subtitle">News</h2>
    </section>
@endsection
