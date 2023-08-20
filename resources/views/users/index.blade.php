@extends('layouts.app')

@section('content')
    <div class="col-12">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User Info</th>
                    <th scope="col">Category Count</th>
                    <th>Article Count</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $key => $user)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>
                            {{ $user->name }}
                            <p class="text-black-50">
                                {{ $user->email }}
                            </p>
                        </td>
                        {{-- <td> {{$user->categories->pluck('title')}} </td> --}}
                        <td class="text-center"> {{ $user->categories->count() }}</td>
                        <td class="text-center"> {{ $user->articles->count() }} </td>

                        <td>
                            {{-- >diffforhumans() //15mins ago 3hrs ago --}}
                            <p class="mb-0 small"> <i class="bi bi-clock-history"></i>
                                {{ $user->created_at->format('H:i a') }} </p>
                            <p class="mb-0 small"> <i class="bi bi-calendar-check"></i>
                                {{ $user->created_at->format('d m Y') }} </p>
                        </td>
                        <td>
                            <p class="small mb-0"> <i class="bi bi-clock-history"> </i>
                                {{ $user->updated_at->format('H:i a') }} </p>
                            <p class="small mb-0"> <i class="bi bi-calendar-check"></i>
                                {{ $user->updated_at->format('d m Y') }} </p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
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
        <div class="float-end">
            {{ $users->onEachSide(2)->links() }}
        </div>
    </div>
@endsection
