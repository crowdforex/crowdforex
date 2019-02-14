<?php
namespace Auth\Model;

use Wallet\Model\Wallet;

/**
 *
 * @author Lenovo
 *        
 */
class AuthConnect
{

    /**
     */
    public function __construct()
    {
        $this->wallet = new Wallet();
        $this->users = new Users();
    }
    
    public function signup($data)
    {
        $this->users->signup($data);
        //$this->wallet->
    }
}

