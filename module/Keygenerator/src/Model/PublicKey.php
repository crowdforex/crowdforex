<?php
namespace Keygenerator\Model;

/**
 *
 * @author Lenovo
 *        
 */
class PublicKey
{

    /**
     */
    public function __construct()
    {}
    
    /**
     * 
     * @param string $privateKey
     * @return string
     */
    public function reader($privateKey)
    {
        $privateKey = base64_decode($privateKey);
        $digest = md5($privateKey);
        $hash = hash_hmac('sha512', $privateKey, $digest);
        
        $output = crc32($hash);
        
        return base64_encode($output);
    }
    
}

