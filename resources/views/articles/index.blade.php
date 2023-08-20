@extends('layouts.app')

@section('content')
    <div class="col-12">
        <a href="{{ route('articles.create') }}" class="btn btn-outline-dark"> <i class="bi bi-plus-circle"> </i>Create</a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    @can('admin-only')
                        <th>Author</th>
                    @endcan
                    <th>Category</th>
                    <th scope="col">Options</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $key => $article)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>
                            {{ $article->title }}
                            <p class="text-black-50">
                                {{-- {{ Str::limit($article->description, 25, '...') }} --}}
                                {{ $article->excerpt }}
                            </p>
                        </td>
                        @can('admin-only')
                            <td>{{ $article->user->name }}</td>
                        @endcan
                        <td>
                            {{ $article->category->title ?? 'Unkown' }}
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('articles.show', $article->id) }}" class="btn btn-outline-dark"
                                    title="see details">
                                    <i class="bi bi-exclamation-diamond"></i>
                                </a>
                                @can('update', $article)
                                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-outline-dark"
                                        title="edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @endcan
                                @can('delete', $article)
                                    <button class="btn btn-outline-dark" form="deleteForm{{ $article->id }}" title="delete"
                                        onclick="return confirm('Are sure to delete?')">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                @endcan
                            </div>
                            @can('delete', $article)
                                <form method="post" id="deleteForm{{ $article->id }}"
                                    action="{{ route('articles.destroy', $article->id) }}" class="d-inline-block">
                                    @csrf
                                    @method('delete')

                                </form>
                            @endcan
                        </td>
                        <td>
                            {{-- >diffforhumans() //15mins ago 3hrs ago --}}
                            <p class="mb-0 small"> <i class="bi bi-clock-history"></i>
                                {{ $article->created_at->format('h:i a') }} </p>
                            <p class="mb-0 small"> <i class="bi bi-calendar-check"></i>
                                {{ $article->created_at->format('d m Y') }} </p>
                        </td>
                        <td>
                            <p class="small mb-0"> <i class="bi bi-clock-history"> </i>
                                {{ $article->updated_at->format('h:i a') }} </p>
                            <p class="small mb-0"> <i class="bi bi-calendar-check"></i>
                                {{ $article->updated_at->format('d m Y') }} </p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <p class="text-secondary">
                                There's no article.
                            </p>
                            <a href="{{ route('articles.create') }}"
                                class="btn btn-outline-primary inline-block mb-2">Create an article</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="float-end">
        {{ $articles->links() }}
    </div>
@endsection
