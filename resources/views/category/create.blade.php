@extends('layouts.app')

@section('content')
    <div class="col-12">
        <form method="post" action="{{ route('category.store') }}">
            @csrf
            <div class="mb-3">
                <h4>Create Category</h4>
            </div>
            <div class="mb-3">
                <label for="name">Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                @error('title')
                    <p class="text-danger fw-bold">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-outline-primary">
                Create
            </button>
        </form>
    </div>
@endsection
