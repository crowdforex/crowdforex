<?php
namespace Keygenerator\Model;

/**
 *
 * @author Lenovo
 *        
 */
class PrivateKey
{

    public $bytes = ['A', 'B', 'C', 'D', 'E', 'F', 'a', 'b', 'c', 'd', 'e', 'f', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    
    public $saltBytes = ['A', 'B', 'C', 'D', 'E', 'F', 'a', 'b', 'c', 'd', 'e', 'f', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    
    /**
     * 
     */
    public function __construct()
    {
        
        $this->saltBytes = [md5($this->saltBytes[rand(0, 21)]), crc32($this->saltBytes[rand(0, 21)]), base64_encode($this->saltBytes[rand(0, 21)])];
        $digest = md5(rand(0, 10000000000000));
        for($i = 0; $i<sizeof($this->saltBytes); $i++){
            $hash = hash_hmac('sha512', $this->saltBytes[rand(0, $i)], $digest);
            
        }
        $this->bytes = [md5($hash), crc32($hash)];
        //echo var_dump($hash);
    }
    
    /**
     * 
     * @param param $salt
     * @return string
     */
    public function create($salt = null)
    {
        if($salt == null)
            $salt = md5(base64_encode(hash('sha256', $this->bytes[0])));
        
        $salt = base64_encode(md5($salt));
        
        foreach($this->bytes as $key){
            for($i = 0; $i<sizeof($this->bytes); $i++){
                $n = random_int(0, 1);
                $random = $this->bytes[$i];
            }
        }
        
        $digest = md5($random . base64_encode($salt));
        $hash = hash_hmac('sha512', $random, $digest);
        
        return base64_encode($hash);
    }
    
}

