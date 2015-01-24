<?php


namespace AbcBank\Resources;

use AbcBank\Entities\Account;


interface AccountInterface {

    /**
     * @return Account[]
     */
    public function load();

}