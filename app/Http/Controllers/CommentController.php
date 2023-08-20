<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $formData = $request->validated();
        // return $formData;
        $formData['user_id'] = Auth()->id();
        if($request->has('parent_id')) {
            $formData['parent_id'] = $request->parent_id;
        }

        Comment::create($formData);

        return back()->with(['message' => 'Your Comment has been sent!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        
        $replies = Comment::whereNotNull('parent_id')->get();
        // return $replies->parent;
        foreach($replies as $reply){
            if($reply->parent_id == $comment->id) {
                $reply->delete();
            }
        }
        // return request();

        return redirect()->back()->with(['message' => 'Your comment has been deleted']);
    }
}
