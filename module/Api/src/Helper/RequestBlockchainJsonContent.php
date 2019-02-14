<?php
namespace Api\Helper;

use Blockchain\Model\Blocks;
use Blockchain\Model\HashTx;
use Network\Model\Peers;

/**
 *
 * @author Lenovo
 *        
 */
class RequestBlockchainJsonContent
{

    /**
     */
    public function __construct()
    {
        $this->blocks = new Blocks();
        $this->hashTx = new HashTx();
        $this->peers = new Peers();
    }
    
    /*
     * 
     */
    public function getBlocksOnJson()
    {
        $select = $this->blocks->blocks->get(array());
        
        foreach($select as $key){
            $json = json_encode($key);
            echo $json.', '.PHP_EOL;
        }
    }
    
    /*
     *
     */
    public function getHashTxOnJson()
    {
        $select = $this->hashTx->hashTx->get(array());
        
        foreach($select as $key){
            $json = json_encode($key);
            echo $json;
        }
    }
    
    public function getPeersOnJson()
    {
        $select = $this->peers->peers->get(array());
        
        foreach($select as $key){
            $json = json_encode($key);
            echo $json.', '.PHP_EOL;
        }
    }
}

