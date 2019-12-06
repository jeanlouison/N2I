<link rel="stylesheet" href="{{ URL::asset('css/outils.css') }}">
@extends('layout/app')
@section('title','outils')


@section('main')
    @parent
    <section class="panel">
        <p><a href="/" class="arbre">Accueil</a> / </p>
        <section>
            <ul class="liste">
                @forelse ($categories as $category)
                    <li style="list-style-type: none"><a href="category/{{ $category->name}}" class="category" >{{ $category->name}}</a></li>
                @empty
                    <li>No categories</li>
                @endforelse
            </ul>
        </section>
    </section>
@endsection