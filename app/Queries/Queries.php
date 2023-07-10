<?php

namespace App\Queries;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

abstract class Queries extends Model
{
    /**
     * Setting the $requested const for filtering use
     *
     * @var object
     */
    protected $requested = null;

    /**
     * Update a resource by put request
     *
     * @param  array $data
     * @return Model
     */
    public function put(array $data): Model
    {
        $this->update($data);

        return $this->fresh();
    }

    /**
     * Create a new resource
     *
     * @param  array $data
     * @return Model
     */
    public function store(array $data): Model
    {
        return $this->create($data);
    }

    /**
     * Get the data to edit a resource
     *
     * @return Model
     */
    public function getEdit(): Model
    {
        return $this;
    }

    /**
     * Get the data to show a resource
     *
     * @return Model
     */
    public function getShow(): Model
    {
        return $this;
    }

    /**
     * Attempt to remove data
     *
     * @return bool|Model
     */
    public function remove(): bool|Model
    {
        if ($this->softDeletes()) {
            if ($this->trashed()) {
                $this->restore();
            } else {
                $this->delete();
            }
            return $this->fresh();
        }
        return $this->delete();
    }

    /**
     * Get a list of all for admins
     *
     * @param  Request $request
     * @return Collection
     */
    public function adminList(Request $request): Collection
    {
        return $this->setRequestData( $request )
                ->checkToSortBy()
                ->checkToPaginate();
    }

    /**
     * Get a list for public use (non admins)
     *
     * @param  Request $request
     * @return Collection
     */
    public function publicList(Request $request): Collection
    {
        return $this->setRequestData( $request )
                ->checkToSortBy()
                ->checkToPaginate();
    }

    /**
     * Get a set of data for a select list
     *
     * @return Collection
     */
    public function selectList(): Collection
    {
        return $this->select(['id', 'name'])
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * Set the request object to const for use
     *
     * @param  Request $request
     * @return Model
     */
    protected function setRequestData(Request $request): Model
    {
        $this->requested = $request;

        return $this;
    }

    /**
     * Check to set pagination if an amount was passed in
     *
     * @return Collection
     */
    protected function checkToPaginate(): Collection
    {
        if ($this->requested->has('amount')) {
            return $this->paginate($this->requested->amount);
        }

        return $this->get();
    }

    /**
     * Set a query to add order by and direction to sort results
     *
     * @return Model
     */
    protected function checkToSortBy(): Model
    {
        if ($this->requested->has('sortby') && Schema::hasColumn('sortby')) {
            return $this->orderBy($this->requested->sortby, $this->requested->dir?? 'asc');
        }

        return $this;
    }

    /**
     * Check if we have soft deletes enabled
     *
     * @return bool
     */
    protected function softDeletes(): bool
    {
        return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($this)) && ! $this->forceDeleting;
    }
}
