<?php
namespace Wallet\Model;

use Application\DbConnection\ParentDao;
use Manager\Session\Session;
use Wallet\Model\Mapper\WalletMapper;

/**
 *
 * @author Lenovo
 *        
 */
class Wallet extends ParentDao
{

    /**
     */
    public function __construct(array $data = null)
    {
        $this->wallet = $this->connect('wallet');
        $this->mapper = new WalletMapper();
        
        $this->mapper->getData($data);
        $this->session = new Session();
    }
    
    /**
     *
     * @return string
     */
    public function myBalance($coin = null)
    {
        $select = $this->wallet->get(array(
            'user' => $this->session->container()->user,
            'coin' => $this->mapper->getCoin()
        ));
        
        foreach($select as $key){
            return $key['balance'];
        }
    }
    
    /**
     * 
     * @return string
     */
    public function getBalance($coin = null)
    {
        $select = $this->wallet->get(array(
            'user' => $this->mapper->getUser(),
            'coin' => $this->mapper->getCoin()
        ));
        
        foreach($select as $key){
            return $key['balance'];
        }
    }
    
    /**
     * 
     * @param string $data
     */
    public function credit($data)
    {
        $this->mapper->getData($data);
        
        $coin = $this->wallet->data->select(array(
            'user' => $this->mapper->getUser(),
            'coin' => $this->mapper->getCoin()
        ));
        
       
        
        $userBalance = $this->get('balance', array(
             'user' => $this->mapper->getUser(),
             'coin' => $this->mapper->getCoin()
        ));
        
        if($this->myBalance() >= '0.001' OR
           $this->myBalance() >= $this->mapper->getBalance() OR
           $this->mapper->getUser() != $this->session->container()->user OR
           $this->myBalance() != null){
               
               $credit = number_format($this->mapper->getBalance(), '8', '.', '') + number_format($userBalance, '8', '.', '');
               //echo $credit;
                   if($coin->count() > 0){
                   $this->wallet->data->update(array(
                        'balance' => $credit,
                        
                    ), array(
                        'user' => $this->mapper->getUser(),
                        'coin' => $this->mapper->getCoin()
                    ));
               }
               else{
                   
                   return $this->wallet->data->insert(array(
                       'balance' => $credit,
                       'user' => $this->mapper->getUser(),
                       'coin' => $this->mapper->getCoin()
                   ));
               }
        }
    }
    
    
    public function search($where)
    {
        $select = $this->wallet->get($where);
        return $select;
        
    }
    /**
     * 
     * @param string $field
     * @param array $where
     * @return array string
     */
    public function get($field, array $where)
    {
        $select = $this->wallet->get($where);
        
        foreach($select as $key){
            return $key[$field];
        }
    }
    
    /**
     * 
     * @param string $coin
     * @param string $value
     */
    public function debit($data)
    {
        $this->mapper->getData($data);
        
        if(//$this->getBalance() >= '0.001' &&
           $this->myBalance() >= $this->mapper->getBalance() &&
           $this->myBalance() != null){
                
               $debit = number_format($this->myBalance(), '8', '.', '') - number_format($this->mapper->getBalance(), '8', '.', '');
               
                if($debit >= '0.00000001'){
                    
                    return $this->wallet->data->update(array(
                        'balance' => number_format($debit, '8', '.', '')
                    ), array(
                        'user' => $this->session->container()->user,
                        'coin' => $this->mapper->getCoin()
                    ));
                }
        }
    }
    
}

