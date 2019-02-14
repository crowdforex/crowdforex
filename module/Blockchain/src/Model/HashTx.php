<?php
namespace Blockchain\Model;

use Blockchain\Model\Mapper\BlockchainMapper;
use Application\DbConnection\ParentDao;

/**
 *
 * @author Lenovo
 *        
 */
class HashTx extends ParentDao
{
    
    public $algo = 'sha512';

    /**
     */
    public function __construct()
    {
        $this->hashTx = $this->connect('hash_tx');
        $this->block = new Block();
        $this->mapper = new BlockchainMapper();
        
    }
    
    /**
     *  
     * @return string
     */
    public function create(array $data)
    {
        $this->mapper->getData($data);
        
        $json = json_encode($this->mapper->getContent());
        $encode = base64_encode($json);
        $decode = base64_decode($encode);
        $decode = json_decode($decode, true);
        $this->block->create(array(
            'previousHash' => $decode['previous_block'],
            'transactions' => $encode
        ));
        
        
        
        if($this->get('address', array(
            'address' => $decode['address']
        )) == null)
             $hashTx = $this->hashTx->data->insert(array(
                 'transaction_hash' => $this->encode(),
                 'address' => $decode['address'],
                 'data' => $encode
             ));
         else
             $hashTx = $this->get('data');
        
         return $hashTx;
            
    }
    
    /**
     *
     * @param unknown $field
     * @param array $where
     * @return unknown
     */
    public function get($field, $where = array())
    {
        
        $select = $this->hashTx->get($where);
        
        foreach($select as $key){
            $id = $key[$field];
            
        }
        
        return $id;
    }
    
    /**
     * 
     * @param unknown $tx
     * @return unknown
     */
    public function seachByTx($tx)
    {
        $select = $this->hashTx->get(array(
            'transaction_hash' => $tx
        ));
        
        foreach($select as $key){
            $id = $key[$tx];
        }
        
        return $id;
    }
    
    
    /**
     *
     * @return mixed
     */
    public function getHashTxContent($hashTx)
    {
        $json = null;
        
        $hash = $this->get('data', array(
            'transaction_hash' => $hashTx
        ));
        $decode = base64_decode($hash);
        $json = json_decode($decode, true);
        
        return $json;
    }
    
    /**
     *
     * @return string
     */
    public function encode()
    {
        $hash = hash_hmac(
            $this->algo, 
            $this->mapper->getTx(), 
            crc32($this->mapper->getTx())
        );
        
        $digest = md5($hash);
        
        return $digest;
    }
}

