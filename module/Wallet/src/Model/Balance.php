<?php
namespace Wallet\Model;

use Blockchain\Model\Block;
use Keygenerator\Model\PrivateKey;
use Keygenerator\Model\PublicKey;

/**
 *
 * @author Lenovo
 *        
 */
class Balance
{

    /**
     */
    public function __construct()
    {
        $this->privateKey = new PrivateKey();
        $this->publicKey = new PublicKey();
        
    }

    public function calc($type)
    {
        $publicKey = $this->publicKey->reader('NzJhMDFiOTVjMTAwYjY2YzRjODdiZWE4M2EwYmIzOGI2MjNlMjY1YzE1ODgyODJiY2Q3ZWFiM2U2MjE3Nzk3NTlmYmY3ZmY4NTJkZDhjNDI2MDQ3Nzk0NjY5YzE2YmFkYjNkNjdkNmNkMTVjNDQ2MDlhNTQ4Y2NmM2Y0OTdlNTY=');
        $file = glob('data/blockchain/orders/'.$publicKey.'*.json');
        $balance = null;
        foreach($file as $key){
            if(file_exists($key)){
                $content = file_get_contents($key);
                $text = base64_decode($content);
                $json = json_decode($text, true);
                //$balance += $json['price'] * $json['amount'];
                
                $block = new Block();
                $block->create(array(
                    'previousHash' => $json['previous_block'],
                    'transactions' => $content
                ));
                $block = glob('data/blockchain/blocks/finalized/'.$block->mapper->getBlockHash().'.json');
                foreach($block as $key)
                    if(file_exists($key)){
                        $content = file_get_contents($key);
                        $text = base64_decode($content);
                        $json = json_decode($text, true);
                        
                        if($json['type'] == $type)
                            $balance += $json['price'];
                }
            }
        }
        
        return $balance;
    }
    
    /**
     * 
     * @return NULL|mixed
     */
    public function get()
    {
        return $this->calc('buy') - $this->calc('sell');
        
    }
}

