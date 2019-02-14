<?php
namespace Blockchain\Model\Mapper;

use Zend\Hydrator\ArraySerializable;
use ArrayObject;

/**
 *
 * @author Lenovo
 *        
 */
class BlockchainMapper
{

    public $previousHash;
    
    public $transactions = array();
    
    public $blockHash;
    
    public $path;
    
    public $content;
    
    public $tx = array();
    
    public $publicKey;
    
    public $blockchainTransaction;
    
    
    /**
     */
    public function __construct()
    {}
    
    public function getData(array $data)
    {
        $hydrator = new ArraySerializable();
        
        $object   = new ArrayObject($data);
        
        $data     = $hydrator->extract($object);
        if(is_array($data)){
            foreach($data as $key => $value){
                switch($key){
                    case 'previousHash':
                        $this->setPreviousHash($value);
                        break;
                    case 'blockHash':
                        $this->setBlockHash($value);
                        break;
                    case 'transactions':
                        $this->setTransactions($value);
                        break;
                    case 'path':
                        $this->setPath($value);
                        break;
                    case 'content':
                        $this->setContent($value);
                        break;
                    case 'tx':
                        $this->setTx($value);
                        break;
                    case 'publicKey':
                        $this->setPublicKey($value);
                        break;
                    case 'blockchainTransaction':
                        $this->setBlockchainTransaction($value);
                        break;
                }
            }
        }
    }
    
    public function setPreviousHash($previousHash)
    {
        $this->previousHash = $previousHash;
        return $this;
    }
    
    
    /**
     *
     * @return unknown
     */
    public function getPreviousHash()
    {
        return $this->previousHash;
    }
    
    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;
        return $this;
    }
    
    /**
     *
     * @return array|unknown
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
    
    public function setBlockHash($blockHash)
    {
        $this->blockHash = $blockHash;
        return $this;
    }
    
    /**
     *
     * @return \Blockchain\Model\unknown
     */
    public function getBlockHash()
    {
        return $this->blockHash;
    }
    
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }
    
    /**
     *
     * @return \Blockchain\Model\unknown
     */
    public function getPath()
    {
        return $this->path;
    }
    
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
    
    /**
     *
     * @return \Blockchain\Model\unknown
     */
    public function getContent()
    {
        return $this->content;
    }
    
    public function setTx($tx)
    {
        $this->tx = $tx;
        
        
        return $this;
    }
    
    /**
     *
     * @return \Blockchain\Model\unknown
     */
    public function getTx()
    {
        return $this->tx;
    }
    
    public function setPublicKey($publicKey)
    {
        $this->publicKey = $publicKey;
        return $this;
    }
    
    /**
     *
     * @return \Blockchain\Model\unknown
     */
    public function getPublicKey(){
        return $this->publicKey;
    }
    
    public function setBlockchainTransaction($blockchainTransaction)
    {
        $this->blockchainTransaction = $blockchainTransaction;
        return $this;
    }
    
    /**
     *
     * @return \Blockchain\Model\unknown
     */
    public function getBlockchainTransaction()
    {
        return $this->blockchainTransaction;
    }
}
