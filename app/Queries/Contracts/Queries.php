<?php

namespace App\Queries\Contracts;

use Illuminate\Http\Request;

abstract class Queries
{
    /**
     * Update a resource by put request
     *
     * @param \Illuminate\Http\Request $request
     */
    public abstract function put(Request $request);

    /**
     * Create a new resource
     *
     * @param \Illuminate\Http\Request $request
     */
    public abstract function store(Request $request);

    /**
     * Update a resource by patch request
     *
     * @param \Illuminate\Http\Request $request
     */
    public abstract function patch(Request $request);

    /**
     * Get the data to edit a resource
     *
     * @param \Illuminate\Http\Request $request
     */
    public abstract function getEdit();

    /**
     * Get the data to show a resource
     *
     * @param \Illuminate\Http\Request $request
     */
    public abstract function getShow();

    /**
     * Attempt to remove data
     *
     * @param \Illuminate\Http\Request $request
     */
    public abstract function remove();

    /**
     * Get a list of all for admins
     *
     * @param \Illuminate\Http\Request $request
     */
    public abstract function adminList(Request $request);

     /**
     * Get a list of all for admins
     *
     * @param \Illuminate\Http\Request $request
     */
    public abstract function publicList(Request $request);

    /**
     * Get a set of data for a select list
     */
    public abstract function selectList();

    /**
     * Validate incoming request objects as needed
     *
     * @param \Illuminate\Http\Request $request
     */
    protected static function validate(Request $request);
}
