@extends('layouts.app')

@section('content')
    <div class="col-8">
        <form method="post" action="{{ route('articles.store') }}">
            @csrf
            <div class="mb-3">
                <h4>Create An Article</h4>
            </div>
            <div class="mb-3">
                <label for="name">Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                @error('title')
                    <p class="text-danger fw-bold">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="cat">Category</label>
                <select name="category_id" id="cat" class="form-select">
                    <option value="">Select Category</option>
                    @foreach (App\Models\Category::all() as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
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
                        {{ old('description') }}
                    </textarea>
                @error('description')
                    <p class="text-danger fw-bold">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-outline-primary">
                Create
            </button>
        </form>
    </div>
@endsection
