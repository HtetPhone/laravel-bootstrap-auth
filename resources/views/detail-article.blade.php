@extends('layouts.app')

@section('content')
    <div class="col-8">
        <div class="mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-dark"> <i class="bi-arrow-left"></i> </a>
            {{-- <p class="text-danger"> {{ route('page.index')}} </p> --}}
        </div>


        <div class="card mb-4">
            <div class="card-body">
                <h4> {{ $article->title }} </h4>
                <span class="badge bg-dark"> {{ $article->category->title }} </span>
                <span class="badge bg-dark"> {{ $article->created_at->diffforhumans() }} </span>
                <span class="badge bg-dark"> By {{ $article->user->name }} </span>

                <hr>
                <div class="text-black-50 mb-3">
                    {{ $article->description }}
                </div>
            </div>
        </div>

        @include('layouts.comment-box')
    </div>
    @include('layouts.side-bar')
    @vite(['resources/js/reply.js'])
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
