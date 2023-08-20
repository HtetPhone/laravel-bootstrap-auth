@extends('layouts.app')

@section('content')
    <div class="col-8">
        <a href="{{ url()->previous() }}" class="btn btn-dark"><i class="bi bi-arrow-left-circle-fill"></i></a>
        <hr>
        <h3> {{ $article->title }}</h3>
        <hr>
        <div>
            <p class="badge bg-dark">
                {{ $article->category_id }}
            </p>
        </div>
        <p class="text-black-50">
            {{ $article->description }}
        </p>
    </div>
@endsection
