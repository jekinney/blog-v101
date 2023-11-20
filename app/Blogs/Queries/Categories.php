<?php


abstract class Categories extends EloquentQueries
{
     /**
     * Set the create validation rules
     *
     * @var array
     */
    protected $createRules = [
        'name' => 'required|between:3,120|string|unique:categories',
    ];

    /**
     * Set the update validation rules
     *
     * @var array
     */
    protected $updateRules = [
        'name' => "required|between:6,220|string|unique:categories,{$this->id}",
    ];

    /**
     * Set the select list column names.
     * Convention is just a list of column names ['name', 'email']
     *
     * @var array
     */
    protected $selectList = ['id', 'name'];

    /**
     * Set the select order by.
     * Convention is the ['column name', 'asc']
     *
     * @var array
     */
    protected $selectOrder = ['name', 'asc'];

    /**
     * If we want to search columns in the DB add to the list here
     *
     * @var array
     */
    protected $searchColumns = ['name'];

    /**
     * Attempt to remove a category
     *
     * @return bool
     */
    public function remove(): bool
    {
        if ($this->articles_count > 0) {
            return abort(500, 'Unable to remove a category with articles attached.');
        }

        return $this->delete();
    }
}
