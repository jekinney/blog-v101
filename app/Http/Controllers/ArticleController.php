<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Http\Resources\Article\FullResource;
use App\Http\Resources\Article\ListResource;
use App\Http\Resources\Article\PartialResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function admin(Request $request, Article $article): AnonymousResourceCollection
    {
        return ListResource::collection($article->adminList($request));
    }

    /**
     * Display a listing of the resource.
     */
    public function public(Request $request, Article $article)
    {
        return ListResource::collection($article->publicList($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return new FullResource($article->getShow());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return new FullResource($article->getEdit());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Article $article)
    {
        return new PartialResource($article->store($request->validated()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Article $article)
    {
        return new PartialResource($article->put($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        return $article->remove();
    }
}
