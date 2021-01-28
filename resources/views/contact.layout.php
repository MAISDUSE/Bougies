@extends('layout/app')

@section('head')
    <style>
        body {
            background-color: beige;
        }
    </style>
@endsection

@section('content')
    <h3>This is the content section</h3>
@endsection

@section('scripts')
<script>document.querySelector('body').innerHTML += "<p>ITS ALIVE</p>"</script>
@endsection