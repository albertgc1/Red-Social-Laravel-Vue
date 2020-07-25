@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card mb-4">
                    <status-form></status-form>
                </div>
                <status-list></status-list>
            </div>
        </div>
    </div>

@endsection
