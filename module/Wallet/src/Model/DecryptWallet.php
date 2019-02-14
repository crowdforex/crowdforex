<?php
namespace Wallet\Model;

use Crypt\Algo\AES;

/**
 *
 * @author Lenovo
 *        
 */
class DecryptWallet
{

    /**
     */
    public function __construct()
    {}
    
    /**
     * 
     * @param param $data
     */
    public static function reader($privateKey, $key)
    {
        $decryptKey = new AES(md5($key));
        
        $privateKey = $decryptKey->decrypt($privateKey);
        
        return $privateKey;
    }
}

