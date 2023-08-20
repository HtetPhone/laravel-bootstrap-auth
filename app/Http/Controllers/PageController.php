<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PageController extends Controller
{
    public function index()
    {
        $articles = Article::when(request()->has('search'), function ($query) {
            $query->where(function (Builder $builder) {
                $search = request()->search;
                $builder->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        })
        // ->when(request()->has('category'), function ($query) {
        //     $query->where('category_id', request()->category);
        // })
        // ->dd()
        ->latest()
        ->paginate(10)
        ->withQueryString();
        // dd($articles);
        return view('index', ['articles' => $articles]);
    }

    public function detail($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        // return $article;
        return view('detail-article', compact('article'));
    }

    public function categorized($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $articles = $category->articles()
        ->when(request()->has('search'), function($query) {
            $query->where(function (Builder $builder) {
                $search = request()->search;
                $builder->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        })
        ->paginate(10)->withQueryString();
        // dd($articles->paginate(10));
        return view('categorized', [
            'category' => $category,
            'articles' => $articles
        ]);

    }
}
