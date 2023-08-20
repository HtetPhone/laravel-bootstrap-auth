@extends('layouts.app')

@section('content')
    <div class="col-8">
        {{-- @if (request()->has('search'))
            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="fw-bold">Search results by <span class="text-info">"{{ request()->search }}"</span> </p>
                <a href="{{ route('page.index') }}" class="btn btn-sm btn-outline-danger">
                    Clear
                </a>
            </div>
        @else --}}

        {{-- @endif --}}

        @forelse ($articles as $article)
            <div class="card mb-4">
                <div class="card-body">
                    <h4>
                        <a href="{{ route('page.detail', ['slug' => $article->slug]) }}"
                            class="text-decoration-none text-dark fw-bold">{{ $article->title }}</a>
                    </h4>
                    <span class="badge bg-dark"> {{ $article->category->title }} </span>
                    <span class="badge bg-dark"> {{ $article->created_at->diffforhumans() }} </span>
                    <span class="badge bg-dark"> By {{ $article->user->name }} </span>

                    <hr>
                    <div class="text-black-50 mb-3">
                        {{ Str::limit($article->description, 100, '...') }}
                    </div>
                    <a href="{{ route('page.detail', ['slug' => $article->slug]) }}" class="btn btn-dark">View More</a>
                </div>
            </div>
        @empty
            <p class="text-warning fw-bold">There's no article to view</p>
        @endforelse

    </div>
    @include('layouts.side-bar')

    <div class="col-12 mt-4">
        <p class="float-end">
            {{ $articles->links() }}
        </p>
    </div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
