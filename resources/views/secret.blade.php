<link rel="stylesheet" href="{{ URL::asset('css/secret.css') }}">
@extends('layout/app')
@section('titre','Secret')

@section('main')
    @parent
@if($numero==0)
    <form id="msform" action="secret/{{$numero+1}}" method="post">
@else
    <form id="msform" action="{{$numero+1}}" method="post">
@endif
        @csrf
        <!-- fieldsets -->
        <fieldset>

            <h2 class="fs-title">{{$enigme}}</h2>
            @if($numero<6)
            @include('shared.error_message')
            <input type="password" name="pass" placeholder="Password"/>
            <input type="hidden" name="numero" value="{{$enigme}}" >
            <input type="submit" name="submit" class="submit action-button" value="Submit"/>
            @else
                <img src="/images/logoCSGroup.png" width="408px" height="186px" alt="Logo de l'équipe"/>
            @endif
        </fieldset>
    </form>
@endsection
