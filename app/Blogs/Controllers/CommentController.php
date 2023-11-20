<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comment\FullResource;
use App\Http\Resources\Comment\ListResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return new FullResource($comment->getShow());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return new FullResource($comment->getEdit());
    }

    /**
     * Display a listing of the resource.
     */
    public function admin(Comment $comment)
    {
        return ListResource::collection($comment->adminList());
    }

    /**
     * Display a listing of the resource.
     */
    public function public(Comment $comment)
    {
        return ListResource::collection($comment->publicList());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
