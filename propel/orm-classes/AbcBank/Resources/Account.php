<?php

namespace AbcBank\Resources;

use AbcBank\Resources\Base\Account as BaseAccount;

/**
 * Skeleton subclass for representing a row from the 'account' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Account extends BaseAccount
{

    const ACCOUNT_NUMBER_LENGTH = 12;

    public function __construct()
    {
        parent::__construct();
        $accountNumber = $this->randomNumber( static::ACCOUNT_NUMBER_LENGTH );
        $this->setAccountNumber( $accountNumber );
    }

    protected function randomNumber( $length )
    {
        $result = '';
        for($i = 0; $i < $length; $i++){
            $result .= mt_rand( 0, 9 );
        }
        return $result;
    }

    public function getBalance()
    {
        return round( $this->balance, 2, PHP_ROUND_HALF_DOWN );
    }

}
