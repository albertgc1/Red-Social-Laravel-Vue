@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Solicitudes de amistad</h3>
    <hr>
    @foreach ($friendships as $friendship)
        <friendship-item
            :friendship="{{ $friendship }}"
        ></friendship-item>
    @endforeach
</div>

@endsection
