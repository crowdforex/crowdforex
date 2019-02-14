<?php
namespace Exchange\Model\Mapper;

use Zend\Hydrator\ArraySerializable;
use ArrayObject;

/**
 *
 * @author Lenovo
 *        
 */
class ExchangeMapper
{

    public $user;
    
    public $type;
    
    public $coin_sell;
    
    public $coin_price;
    
    public $amount;
    
    public $price;
    
    public $command;
    
    public $status;
    /**
     */
    public function __construct()
    {}
    
    public function getConfig(array $data)
    {
        $hydrator = new ArraySerializable();
        
        $object   = new ArrayObject($data);
        
        $data     = $hydrator->extract($object);
        if(is_array($data)){
            foreach($data as $key => $value){
                switch($key){
                    case 'user':
                        $this->setUser($value);
                        break;
                    case 'type':
                        $this->setType($value);
                        break;
                    case 'coin_sell':
                        $this->setCoinSell($value);
                        break;
                    case 'coin_price':
                        $this->setCoinPrice($value);
                        break;
                    case 'amount':
                        $this->setAmount($value);
                        break;
                    case 'command':
                        $this->setCommand($value);
                        break;
                    case 'status':
                        $this->setStatus($value);
                        break;
                }
            }
        }
    }
    
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setCoinSell($coin_sell)
    {
        $this->coin_sell = $coin_sell;
        return $this;
    }
    
    public function getCoinSell()
    {
        return $this->coin_sell;
    }
    
    public function setCoinPrice($coin_price)
    {
        $this->coin_price = $coin_price;
        return $this;
    }
    
    public function getCoinPrice()
    {
        return $this->coin_price;
    }
    
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
    
    public function getAmount()
    {
        return $this->amount;
    }
    
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
    
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
    
    public function getMessage()
    {
        return $this->message;
    }
    
    public function setCommand($command)
    {
        $this->command = $command;
        return $this;
    }
    
    public function getCommand()
    {
        return $this->command;
    }
    
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
}

