<div class="card mb-4">
    <div class="card-body">
        <h5 class="fw-bold">
            Recent Articles
        </h5>

        <ul class="list-group">
            {{-- {{ dd(App\Models\Article::latest()->limit(5)->get())}} --}}
            @foreach (App\Models\Article::latest()->limit(5)->get() as $article)
                <a href="{{ route('page.detail', ['slug' => $article->slug]) }}"
                    class="list-group-item list-group-item-action">
                    {{ $article->title }}
                </a>
            @endforeach
        </ul>
    </div>
</div>
