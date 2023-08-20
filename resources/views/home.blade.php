@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ __('You are logged in!') }}
            </div>
            <p> <i class="bi bi-person"></i> </p>
            <p> <i class="bi bi-5-circle"></i> </p>

            <p> {{ Auth::id() }} </p>
        </div>
    </div>
@endsection
