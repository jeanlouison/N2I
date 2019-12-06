<link rel="stylesheet" href="{{ URL::asset('css/sign.css') }}">

@extends('layout.app')
@section('title', 'Signin')
@section('main')
    @parent
    <form id="connectUserForm" action="authenticate" role="form" method="post">
        @csrf
        <fieldset>
            <label class="fs_title" for="login">Identifiez-vous</label>
            @include('shared.error_message')
            <input type="text" name="login" id="login" placeholder="Pseudo ou mail" aria-label="Nom d'utilisateur" autofocus required>
            <input type="password" name="password" placeholder="Mot de passe" aria-label="Mot de passe" required>
            <input type="submit" value="Login">
        </fieldset>
    </form>

@endsection
