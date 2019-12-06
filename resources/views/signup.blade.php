<link rel="stylesheet" href="{{ URL::asset('css/sign.css') }}">
@extends('layout.app')
@section('title', 'Signup')
@section('main')
    @parent
    <form action="adduser" method="post" id="addUserForm">
        @csrf
        <fieldset>
            <h2 class="fs_title">Sign up</h2>
            @include('shared.error_message')
            <input type="email" name="email" placeholder="Votre E-Mail" autofocus required>
            <input type="text" id="pseudo" name="pseudo" placeholder="Votre Pseudo" required>
            <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirmez votre mot de passe" required>
            <input type="number" id="age" name="age" placeholder="Age" required>
            <input type="text" id="formation" name="formation" placeholder="formation" required>
            <input type="text" id="city" name="city" placeholder="city" required>
            <textarea rows="4" cols="50" name="description" form="addUserForm" placeholder="Votre description..."></textarea>
            <input type="submit" value="Sign Up" form="addUserForm">
        </fieldset>
    </form>
    <script type="text/javascript" src="{{ URL::asset('js/passwordFormat.js') }}"></script>
@endsection
