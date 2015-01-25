<?php


namespace AbcBank\Models;

use AbcBank\Resources\Account as Resource;

class Account {

    protected $resource;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    public function getAccounts()
    {
        $this->resource->load();
    }

}