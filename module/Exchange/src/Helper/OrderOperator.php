<?php
namespace Exchange\Helper;

use Exchange\Model\Orders;
use Wallet\Model\Wallet;

/**
 *
 * @author Lenovo
 *        
 */
class OrderOperator
{

    /**
     */
    public function __construct()
    {
        $this->orders = new Orders();
        $this->wallet = new Wallet();
    }
    
    //public function 
    
    
}

