<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('viewAny', Category::class);
        // dd(Category::latest()->get());
        $cats = Category::latest()->get();
        return view('category.index', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Category::class);
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //authorzation
        // if($request->user()->cannot('create', Category::class)) {
        //     abort(403);
        // }
        // $this->authorize('create', Category::class);

        $formData = $request->validated();
        $formData['author_id'] = auth()->id();
        $formData['slug'] = Str::slug($formData['title']);

        Category::create($formData);

        return redirect()->route('category.index')->with(['message' => 'New Category Created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return abort('403', "unauthorized action");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('update', $category);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //authorization
        // Gate::authorize('update', $category);

        // if($request->user()->cannot('update', $category)) {
        //     abort(403);
        // }
        // $this->authorize('update', $category);


        $formData = $request->validated();
        $formData['slug'] = Str::slug($formData['title']);
        $category->update($formData);

        return back()->with(['message' => 'Category Updated']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // $this->authorize('delete', $category);
        $category->delete();
        return redirect()->route('category.index')->with(['message' => 'Successfully deleted']);
    }
}
