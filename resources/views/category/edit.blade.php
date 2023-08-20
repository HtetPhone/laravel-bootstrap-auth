@extends('layouts.app')

@section('content')
    <div class="col-8">
        <form method="post" action="{{ route('category.update', $category->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <a href="{{ route('category.index') }}" class="btn btn-dark"> <i class="bi bi-arrow-left-circle-fill"></i> </a>
                <hr>
                <h4>Edit Category</h4>
            </div>
            <div class="mb-3">
                <label for="name">Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title', $category->title) }}">
                @error('title')
                    <p class="text-danger fw-bold">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-outline-dark">
                Update
            </button>
        </form>
    </div>
@endsection
