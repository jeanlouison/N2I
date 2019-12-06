<link rel="stylesheet" href="{{ URL::asset('css/forum.css') }}">
@extends('layout/app')
@section('title','Subjects')


@section('main')
    @parent
        <section class="panel">
            <p><a href="/" class="arbre" >Accueil</a> / <a href="/forum/categories">Forum</a> / </p>
            <a href="/forum/newsubject" class="button" >Ajouter un sujet</a>
            <section>
                <ul class="liste">
                    @forelse($subjects as $subject)
                        <li style="list-style-type: none"><a href="{{$category}}/{{ $subject->id}}" class="subject" >{{ $subject->name}}</a></li>
                    @empty
                        <li class="nocontent">Pas de sujets. Soyez le premier à en publier un !</li>
                    @endforelse
                </ul>
            </section>
        </section>
@endsection
