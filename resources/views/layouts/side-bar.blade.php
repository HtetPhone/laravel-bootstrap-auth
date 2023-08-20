<div class="col-4" >
   <div class="position-sticky" style="top: 10%">
     {{-- search  --}}
     <div class="card mb-4">
        <div class="card-body">
            <form method="GET">
                <h5 class="fw-bold">Article Search</h5>
                <div class="input-group">
                    <input type="text" name="search" class="form-control" value="{{ request()->search }}">
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- category  --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-bold">
                Article Categories
            </h5>

            <ul class="list-group">
                <a href="{{ route('page.index') }}" class="list-group-item list-group-item-action"> All Categories </a>

                @foreach (App\Models\Category::all() as $category)
                    <a href="{{ route('page.categorized', ['slug' => $category->slug]) }}"
                        class="list-group-item list-group-item-action">
                        {{ $category->title }}
                    </a>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- recent articles --}}
    @include('layouts.recent-articles')

   </div>

</div>
