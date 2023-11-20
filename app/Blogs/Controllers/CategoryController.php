<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Resources\Category\FullResource;
use App\Http\Resources\Category\PartialResource;
use App\Http\Resources\Category\SelectResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Category $category): FullResource
    {
        return new FullResource($category->getShow());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): FullResource
    {
        return new FullResource($category->getEdit());
    }

    /**
     * Display a listing of the resource.
     */
    public function admin(Request $request, Category $category): AnonymousResourceCollection
    {
        return PartialResource::collection($category->adminList($request));
    }

    /**
     * Display a listing of the resource.
     */
    public function public(Request $request, Category $category): AnonymousResourceCollection
    {
        return PartialResource::collection($category->publicList($request));
    }

    /**
     * Display a listing of the resource.
     */
    public function select(Category $category): AnonymousResourceCollection
    {
        return SelectResource::collection($category->selectList());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Category $category): PartialResource
    {
        return new PartialResource($category->store($request->validated()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category): PartialResource
    {
        return new PartialResource($category->put($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): bool
    {
        return $category->remove();
    }
}
