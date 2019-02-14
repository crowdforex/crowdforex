<?php
namespace Wallet\Helper;

use Wallet\Model\Wallet;

/**
 *
 * @author Lenovo
 *        
 */
class RequestWalletViewlModelHelper
{

    /**
     */
    public function __construct()
    {
        $this->wallet = new Wallet(array());
    }
    
    public function getWalletBalance()
    {
        return $this->wallet->search(array(
            'user' => $this->wallet->session->container()->user,
            'coin' => 'BTC'
        ));
    }
}

