<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::when(request()->has('search'), function($query) {
            $query->where(function(Builder $builder) {
                $search = request()->search;
                $builder->where('title', 'like', '%'. $search . '%')
                ->orWhere('description', 'like', '%'. $search . '%');
                });
        })
        ->when(Auth::user()->role != 'admin', function ($query) {
            $author_id = Auth::id();
            $query->where('author_id', $author_id);
        })
        // ->dd()
        ->latest()->paginate(10)->withQueryString();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $formData = $request->validated();
        $formData['slug'] = Str::slug($formData['title']);
        $formData['excerpt'] = Str::words($formData['description'], 10, "...");
        $formData['author_id'] = Auth::id();

        Article::create($formData);

        return redirect()->route('articles.index')->with(['message' => "Successfully Created"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        // $this->authorize('view', $article);
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // Gate::authorize('article-update', $article);
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //authorization
        // if(!Gate::allows('article-update', $article)){
        //     abort(403);
        // }

        // if(Gate::denies('article-update', $article)) {
        //     abort(403);
        // }

        // Gate::authorize('article-update', $article);
        $this->authorize('update', $article);

        $formData = $request->validated();
        $formData['slug'] = Str::slug($formData['title']);
        $formData['excerpt'] = Str::words($formData['description'], 25, "...");
        $article->update($formData);

        return back()->with(['message' => "Successfully Updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Gate::authorize('article-delete', $article);
        $this->authorize('delete', $article);

        $article->delete();

        return back()->with(['message' => 'Successfully Deleted']);
    }
}
