<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comment\{
    FullResource,
    ListResource,
    PartialResource
};
use App\Http\Requests\Comment\{
    StoreRequest,
    UpdateRequest
};
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
    public function store(StoreRequest $request, Comment $comment): PartialResource
    {
        return new PartialResource($comment->store($request->validated()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Comment $comment)
    {
        return new PartialResource($comment->put($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        return new PartialResource($comment->remove());
    }
}
