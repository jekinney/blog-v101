<?php

namespace App\Queries;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class Queries extends Model
{
    /**
     * Update a resource by put request
     */
    public function put(array $request): Model
    {
        $this->update($request);

        return $this->fresh();
    }

    /**
     * Create a new resource
     */
    public function store(array $request): Model
    {
        return $this->create($request);
    }

    /**
     * Get the data to edit a resource
     */
    public function getEdit(): Model
    {
        return $this;
    }

    /**
     * Get the data to show a resource
     */
    public function getShow(): Model
    {
        return $this;
    }

    /**
     * Attempt to remove data
     */
    public function remove(): bool
    {
        return $this->delete();
    }

    /**
     * Get a list of all for admins
     */
    public function adminList(Request $request): Collection
    {
        if ($request->has('amount')) {
            return $this->paginate($request->amount);
        }

        return $this->get();
    }

    /**
     * Get a set of data for a select list
     */
    public function selectList(): Collection
    {
        return $this->select(['id', 'name'])
            ->orderBy('name', 'asc')
            ->get();
    }
}
