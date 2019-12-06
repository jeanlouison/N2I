@extends('layout.app')
@section('title', 'Home')
@section('main')
    @parent
    <canvas width="1920px" height="600px" style="align-self: center; justify-self: center;" id="game"></canvas>
    <script type="text/javascript" src="{{ URL::asset('js/404.js') }}"></script>
@endsection
