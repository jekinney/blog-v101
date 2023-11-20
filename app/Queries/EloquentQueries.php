<?php

namespace App\Queries;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class Queries extends Model implements Queries
{
    /**
     * Set the create validation rules
     *
     * @var array
     */
    protected $createRules = [];

    /**
     * Set the update validation rules
     *
     * @var array
     */
    protected $updateRules = [];

    /**
     * Set the select list column names.
     * Convention is just a list of column names ['name', 'email']
     *
     * @var array
     */
    protected $selectList = [];

    /**
     * Set the select order by.
     * Convention is the ['column name', 'asc']
     *
     * @var array
     */
    protected $selectOrder = [];

    /**
     * If we want to search columns in the DB add to the list here
     *
     * @var array
     */
    protected $searchColumns = [];

    /**
     * Update a resource by put request.
     * Return a fresh copy of the model's data
     *
     * @param  \Illuminate\Http\Request $request
     * @return Model
     */
    public function put(Request $request): Model
    {
        $this->update( $this->validate($request) );

        return $this->fresh();
    }

    /**
     * Update a resource by patch request.
     * Return a fresh copy of the model's data
     *
     * @param  \Illuminate\Http\Request $request
     * @return Model
     */
    public function patch(Request $request): Model
    {
        $this->update( $this->validate($request) );

        return $this->fresh();
    }

    /**
     * Create a new resource
     *
     * @param  \Illuminate\Http\Request $request
     * @return Model
     */
    public function store(Request $request): Model
    {
        return $this->create( $this->validate($request) );
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
     * Get a list of all for admins.
     * Generally includes soft deletes or other not publicly visable data
     *
     * @param  \Illuminate\Http\Request $request
     * @return Collection
     */
    public function adminList(Request $request): Collection
    {
        return $this->setAdmin($request)->setSearch()->setPagination();
    }

    /**
     * Get a collection of data for a non-admin type user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Collection
     */
    public function adminList(Request $request): Collection
    {
        return $this->setPublic($request)->setSearch()->setPagination();
    }

    /**
     * Get a set of data for a select list
     */
    public function selectList(): Collection
    {
        if ( empty($this->selectList) && empty($this->selectOrderBy) ) {
            abort( 503, 'Select list is not implomented on the query class.' );
        }

        return $this->select( $this->selectListColumns['select'] )
            ->orderBy($this->selectOrderBy[0], $this->selectOrderBy[1])
            ->get();

    }

    /**
     * Validate incoming user input before saving to database.
     * Returns either exceptions or validated data only
     *
     * @param \Illuminate\Http\Request $request
     * @return array|Exception
     */
    protected function validation(Request $request): array|Exception
    {
        // Check if we are posting (create).
        if ( $request->method('post') ) {
            $rules = $this->getCreateRules();
        } else {
            $rules = $this->getUpdateRules();
        }

        return $request->validate( $this->getUpdateRules() )->validated();
    }

    /**
     * Set up admin list request
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function setAdmin(Request $request)
    {
        $this->setPublic($request);
        // Check for soft deletes. if so add to query
        if ( $this->hasSoftDeletes() )  {
            $this->query = $query->withTrashed();
        }
        return $this;
    }

    /**
     * Set up public list request
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function setPublic(Request $request)
    {
        $this->query = $this;
        $this->request = $request;

        return $this;
    }

    /**
     * Set up a search of the database columns if requested and allowed.
     *
     * @return void
     */
    protected function setSearch()
    {
        // Check if we have set search columns and has search
        if ( !empty($this->searchColumns) && $this->request->filled('search') ) {
            foreach( $this->searchColumns as $column ) {
                $this->query->where( $column, 'LIKE', '%'.$this->request->search.'%' );
            }
        }
        return $this;
    }

    /**
     * Check and set pagination or return entire list
     *
     * @return Collection
     */
    protected function setPagination()
    {
        if ( $this->request->filled('amount') ) {
            return $this->query->paginate( $this->request->amount );
        }
        return $this->query->get();
    }

    /**
     * Set up create validation rules or throw exception
     *
     * @return array|Exception
     */
    protected function getCreateRules(): array|Exception
    {
        if ( empty($this->createRules) ) {
            abort( 510, 'The create validation rules are set on the query class.' );
        }
        return $this->createRules;
    }

    /**
     * Set up create validation rules or throw exception
     *
     * @return array|Exception
     */
    protected function getUpdateRules(): array|Exception
    {
        if ( empty($this->updateRules) ) {
            abort( 510, 'The update validation rules are set on the query class.' );
        }
        return $this->updateRules;
    }

    /**
     * Check if we are using softdeletes trait
     *
     * @return boolean
     */
    protected function hasSoftDeletes(): bool
    {
        return in_array( 'Illuminate\Database\Eloquent\SoftDeletes', class_uses($this) );
    }
}
