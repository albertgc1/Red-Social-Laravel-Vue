@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card">
                    <form method="post" action="{{ route('status.store') }}">
                    @csrf
                    <div class="card-body">
                        <textarea class="form-control border-0" name="body" placeholder="¿Que estas pensando Albert?"></textarea>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Publicar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

@endsection
