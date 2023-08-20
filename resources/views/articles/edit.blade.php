@extends('layouts.app')

@section('content')
    <div class="col-8">
        <form method="post" action="{{ route('articles.update', $article->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <a href="{{ route('articles.index') }}" class="btn btn-dark"> <i class="bi bi-arrow-left-circle-fill"></i> </a>
                <hr>
                <h4>Edit Article</h4>
            </div>
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title', $article->title) }}">
                @error('title')
                    <p class="text-danger fw-bold">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Category</label>
                <select name="category_id" id="" class="form-select">
                    <option value="">Select Category</option>
                    @foreach (App\Models\Category::all() as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $article->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->title }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-danger fw-bold">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="" cols="30" rows="7" class="form-control">
                        {{ old('description', $article->description) }}
                    </textarea>
                @error('description')
                    <p class="text-danger fw-bold">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-outline-dark">
                Update
            </button>
        </form>
    </div>
@endsection
