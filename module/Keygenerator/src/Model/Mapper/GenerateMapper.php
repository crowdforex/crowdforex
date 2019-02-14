<?php
namespace Connections\Blockchain\Model\Mapper;

use Zend\Hydrator\ArraySerializable;
use ArrayObject;

/**
 *
 * @author Lenovo
 *        
 */
class GenerateMapper
{

    public $index;
    
    public $previousHash;
    
    public $timestamp;
    
    public $data;
    
    public $hash;
    
    
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
                    case 'index':
                        $this->setIndex($value);
                        break;
                    case 'previousHash':
                        $this->setPreviousHash($value);
                        break;
                    case 'timestamp':
                        $this->setTimestamp($value);
                        break;
                    case 'data':
                        $this->setData($value);
                        break;
                    case 'hash':
                        $this->setHash($value);
                        break;
                }
            }
        }
    }
    
    public function setIndex($index)
    {
        $this->index = $index;
        return $this;
    }
    
    /**
     *
     * @return array|unknown
     */
    public function getIndex(){
        return $this->index;
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
    
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }
    
    /**
     *
     * @return array|unknown
     */
    public function getTimestamp(){
        return $this->transactions;
    }
    
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    
    /**
     *
     * @return \Blockchain\Model\unknown
     */
    public function getData(){
        return $this->data;
    }
    
    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }
    
    /**
     *
     * @return \Blockchain\Model\unknown
     */
    public function getHash(){
        return $this->hash;
    }
}


