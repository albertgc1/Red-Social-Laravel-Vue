@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card border-0 shadow">
                <img class="card-img-top" src="{{ $user->avatar() }}" alt="{{ $user->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                </div>
                <div class="card-footer">
                    @if (auth()->id() != $user->id)
                        <friendship-btn
                            class="btn btn-primary btn-block"
                            friendship-status="{{ $friendshipStatus }}"
                            :recipient="{{ $user }}">
                        </friendship-btn>
                    @endif
                    <a href="{{ route('friendships.index') }}">Ver amigos</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <status-list
                url="{{ route('users.statuses.index', $user) }}"
            ></status-list>
        </div>
    </div>
</div>

@endsection
