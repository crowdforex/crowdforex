<?php
namespace Blockchain\Model\Consensus;

/**
 *
 * @author Lenovo
 *        
 */
class Transaction
{

    /**
     */
    public function __construct()
    {}
    
    public function checkcsumPrivateKey($privateKey)
    {
        $checksum = md5($privateKey);
        
        if($privateKey)
        
    }
    
    public function balance()
    {
        
    }
}

