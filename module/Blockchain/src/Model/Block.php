<?php
namespace Blockchain\Model;

use Blockchain\Model\Mapper\BlockchainMapper;
use Blockchain\Api\Blockchain;
use Application\DbConnection\ParentDao;

//use Blockchain\Model\Mapper\BlockchainMapper;

/**
 *
 * @author Lenovo
 *        
 */
class Block extends ParentDao
{
    
    public $previousHash;
    
    public $transactions = array();
    
    public $blockHash;
    /**
     * 
     * @var string
     */
    public $algo = 'sha512';
      
    /**
     * 
     * @param unknown $previousHash
     * @param unknown $transactions
     */
    public function __construct()
    {
        $this->blocks = $this->connect('blocks');
        $this->mapper = new BlockchainMapper();
        
        
    }          
    
    public function create($data)
    {
        $this->mapper->getData($data);
        
        $contents = [$this->getHash(serialize($this->mapper->getTransactions())), $this->mapper->getPreviousHash()];
        $this->mapper->setBlockHash($this->getHash(serialize($contents)));
    }
    
    /**
     * 
     * @param unknown $value
     * @return string
     */
    public function getHash($value)
    {
        $keys = array(
            $this->mapper->getPreviousHash(),
            $this->mapper->getTransactions()
        );
        
        foreach($keys as $key)
            return hash_hmac($this->algo, $value, $key);
    }
       
    /**
     * 
     * @param param $data
     * @return number
     */
    public function generator($data)
    {
        
        
    }
    
    
    
    

}

