<link rel="stylesheet" href="{{ URL::asset('css/sign.css') }}">
@extends('layout.app')
@section('title', 'New Subject')
@section('main')
    @parent
    <form action="createsubject" method="post" id="addUserForm" title="Créez un nouveau sujet" aria-label="Créer un nouveau sujet de discussion" role="form">
        @csrf
        <fieldset>
            <label class="fs_title" for="titre">Créez un nouveau sujet</label>
            @include('shared.error_message')
            <input type="text" name="name" id="titre" placeholder="Titre du sujet" role="textbox" autofocus required>
            <label style="text-align: center" for="category" aria-label="Choisir une catégorie">Choisir une catégorie</label>
            <select style="margin-top: 1vh; margin-bottom: 1vh; margin-left: 100px" name="category" id ="category" required>
                @forelse ($categories as $category)
                    <option style="list-style-type: none" form="addUserForm" value="{{$category->name}}">
                        {{$category->name}}
                    </option>
                @empty
                    <li>No categories</li>
                @endforelse
            </select>
            <label style="text-align: center" for="add-user-form" aria-label="Entrez votre message">Entrez votre message</label>
            <textarea rows="4" cols="50" name="content" id="add-user-form" form="addUserForm" placeholder="Votre message..." role="textbox"></textarea>
            <input type="submit" value="Valider" form="addUserForm">
        </fieldset>
    </form>
    <script type="text/javascript" src="{{ URL::asset('js/passwordFormat.js') }}"></script>
@endsection
