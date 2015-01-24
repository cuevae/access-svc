<?php


namespace AbcBank\Entities;

class Account {

    protected $id;
    protected $balance;

    public function __construct($id, $balance)
    {
        $this->id = $id;
        $this->balance = $balance;
    }

}