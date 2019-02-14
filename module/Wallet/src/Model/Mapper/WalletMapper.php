<?php
namespace Wallet\Model\Mapper;

/**
 *
 * @author Lenovo
 *        
 */
class WalletMapper
{
    
    public $user;
    
    public $balance;
    
    public $coin;
    
    public $account;
    
    public $pin;
    
    
    /**
     */
    public function __construct()
    {}
    
    public function getData(array $data)
    {
        if(is_array($data)){
            foreach($data as $key => $value){
                switch($key){
                    case 'user':
                        $this->setUser($value);
                        break;
                    case 'balance':
                        $this->setBalance($value);
                        break;
                    case 'coin':
                        $this->setCoin($value);
                        break;
                    case 'account':
                        $this->setAccount($value);
                        break;
                    case 'pin':
                        $this->setPin($value);
                        break;
                    
                }
            }
        }
    }
    
    /**
     * @param $user
     * @return self
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * @param $balance
     * @return self
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
    }
    
    /**
     * @param $coin
     * @return self
     */
    public function setCoin($coin)
    {
        $this->coin = $coin;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getCoin()
    {
        return $this->coin;
    }
    
    /**
     * @param $account
     * @return self
     */
    public function setAccount($account)
    {
        $this->account = $account;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }
    
    /**
     * @param $pin
     * @return self
     */
    public function setPin($pin)
    {
        $this->pin = $pin;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getPin()
    {
        return $this->pin;
    }
    
    
}

