@extends('layouts.app')

@section('content')
    <div class="col-12">
        <a href="{{ route('category.create') }}" class="btn btn-outline-dark"> <i class="bi bi-plus-circle"> </i>
            Create</a>
        <hr>
        <h4>
            Categories
        </h4>
        <hr>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th>Author</th>
                    <th scope="col">Options</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cats as $key => $cat)
                    <tr>
                        <th scope="row">{{ $cat->id }}</th>
                        <td>
                            {{ $cat->title }}
                        </td>
                        <td>{{ $cat->user->name }}</td>
                        <td>
                            <div class="btn-group text-center">
                                @can('update', $cat)
                                    <a href="{{ route('category.edit', $cat->id) }}" class="btn btn-outline-dark"
                                        title="edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @endcan

                                @can('delete', $cat)
                                    <button class="btn btn-outline-dark" form="deleteForm{{ $cat->id }}" title="delete"
                                        onclick="return confirm('Are sure to delete?')">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                @endcan
                            </div>
                            @can('delete', $cat)
                                <form method="post" id="deleteForm{{ $cat->id }}"
                                    action="{{ route('category.destroy', $cat->id) }}" class="d-inline-block">
                                    @csrf
                                    @method('delete')

                                </form>
                            @endcan
                        </td>
                        <td>
                            {{-- >diffforhumans() //15mins ago 3hrs ago --}}
                            <p class="mb-0 small"> <i class="bi bi-clock-history"></i>
                                {{ $cat->created_at->format('h:i a') }} </p>
                            <p class="mb-0 small"> <i class="bi bi-calendar-check"></i>
                                {{ $cat->created_at->format('d m Y') }} </p>
                        </td>
                        <td>
                            <p class="small mb-0"> <i class="bi bi-clock-history"> </i>
                                {{ $cat->updated_at->format('h:i a') }} </p>
                            <p class="small mb-0"> <i class="bi bi-calendar-check"></i>
                                {{ $cat->updated_at->format('d m Y') }} </p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <p class="text-secondary">
                                There's no category.
                            </p>
                            <a href="{{ route('category.create') }}" class="btn btn-outline-primary inline-block mb-2">New
                                Category</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{-- <div class="float-end">
                        {{ $cats->links() }}
                    </div> --}}
    </div>
@endsection
