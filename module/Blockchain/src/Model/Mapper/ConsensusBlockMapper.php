<?php
namespace Blockchain\Model\Mapper;

use Zend\Hydrator\ArraySerializable;
use ArrayObject;

/**
 *
 * @author Lenovo
 *        
 */
class ConsensusBlockMapper
{

    public $previousHash;
    
    public $transactions = array();
    
    public $blockHash;
    
    public $path;
    
    public $content;
    
    public $order = array();
    
    public $publicKey;
    
    
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
                    case 'transactions':
                        $this->setTransactions($value);
                        break;
                    case 'path':
                        $this->setPath($value);
                        break;
                    case 'content':
                        $this->setContent($value);
                        break;
                    case 'order':
                        $this->setOrder($value);
                        break;
                    case 'publicKey':
                        $this->setPublicKey($value);
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
    public function getPreviousHash(){
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
    public function getTransactions(){
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
    public function getBlockHash(){
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
    public function getPath(){
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
    public function getContent(){
        return $this->content;
    }
    
    public function setOrder($order)
    {
        $this->order = $order;
        foreach($this->order as $key)
            $this->order = $key;
        
        return $this;
    }
    
    /**
     *
     * @return \Blockchain\Model\unknown
     */
    public function getOrder(){
        return $this->order;
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
}
