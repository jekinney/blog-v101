<?php

namespace App\Blogs\Queries;

use App\Queries\EloquentQueries;
use Illuminate\Http\Request;

class Articles extends EloquentQueries
{
    /**
     * Set the create validation rules
     *
     * @var array
     */
    protected $createRules = [
        'category_id' => 'nullable|exists:categories,id',
        'title' => 'required|between:6,220|string|unique',
        'body' => 'required|string',
        'header_image' => 'nullable|url',
        'is_featured' => 'nullable|boolean',
        'is_draft' => 'nullable|bloolean',
        'publish_at' => 'nullable|date',
        'expires_at' => 'nullable|date',
    ];

    /**
     * Set the update validation rules
     *
     * @var array
     */
    protected $updateRules = [
        'category_id' => 'nullable|exists:categories,id',
        'title' => "required|between:6,220|string|unique:articles,{$this->id}",
        'body' => 'required|string',
        'header_image' => 'nullable|url',
        'is_featured' => 'nullable|boolean',
        'is_draft' => 'nullable|bloolean',
        'publish_at' => 'nullable|date',
        'expires_at' => 'nullable|date',
    ];

    /**
     * Set the select list column names.
     * Convention is just a list of column names ['name', 'email']
     *
     * @var array
     */
    protected $selectList = ['id', 'title'];

    /**
     * Set the select order by.
     * Convention is the ['column name', 'asc']
     *
     * @var array
     */
    protected $selectOrder = ['title', 'asc'];

    /**
     * If we want to search columns in the DB add to the list here
     *
     * @var array
     */
    protected $searchColumns = ['title'];

     /**
     * Create a new resource
     *
     * @param  \Illuminate\Http\Request $request
     * @return Model
     */
    public function store(Request $request): Model
    {
        return User::articles()->create( $this->validate($request) );
    }
}
