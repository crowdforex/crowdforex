<?php
namespace Exchange\Helper;

use Exchange\Model\Orders;
use Wallet\Model\Wallet;
use Crowdforex\Api\Client;
use Exchange\Model\TradeOperator;

/**
 *
 * @author Lenovo
 *        
 */
class RequestOrdersViewModelHelper
{

    /**
     */
    public function __construct()
    {
        
        $this->operator = new TradeOperator();
        
    }
    
    public function getOrder()
    {
        if(isset($_POST['amount_coin']) &&
           isset($_POST['price_coin']) &&
           isset($_POST['amount']) &&
           isset($_POST['price']) &&
           isset($_POST['type']) &&
           isset($_POST['status'])
            ){
            
            return array(
                'amount_coin' => $_POST['amount_coin'],
                'price_coin' => $_POST['price_coin'],
                'amount' => $_POST['amount'],
                'price' => $_POST['price'],
                'type' => $_POST['type'],
                'status' => $_POST['status'],
                //'date_open_order' => date('Y-m-d H:i:s')
            );
        }
        //return array();
    }
    
    /**
     * 
     */
    public function operate()
    {
        if(isset($_POST['amount_coin']) &&
            isset($_POST['price_coin']) &&
            isset($_POST['amount']) &&
            isset($_POST['price']) &&
            isset($_POST['type']) &&
            isset($_POST['status'])
            ){
                if($_GET['price_coin'] != $_GET['amount_coin']){
                    
                    $this->operator->create($this->getOrder());
                
                }
        }
    }
    
    /**
     * 
     */
    public function cancel()
    {
        $id = null;
        
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $this->operator->cancel($id);
        }
    }
    
    /**
     * 
     * @return mixed
     */
    public function getAllOrders()
    {
        if(isset($_GET['price_coin']) &&
           isset($_GET['amount_coin'])
            ){
                return $this->operator->getAllOrders($_GET['price_coin'], $_GET['amount_coin']);
        }
    }
    
    public function approveUserOrder()
    {
        //$id = null;
        if(isset($_POST['id'])){
            $id = $_POST['id'];
                
        
        return $this->operator->closeTrade(array(
                    'id' => $id
                ));
        }
    }
    
    public function getGraphic()
    {
        $client = new Client();
        $client->setHydrateUrl(array(
            'http://localhost'
        ));
        return $client->getGraphic();
    }
    
    public function getUserToDeposit()
    {
        if(isset($_POST['price'])){
            // $this->exchange->operate();
            if($_GET['price_coin'] == $_GET['amount_coin']){
                if($this->operator->orders->getOrder('user') != null){
                    
                    $select = $this->operator->create($this->getOrder());
                    
                    foreach($select as $key){
                        $msg = "Deposit the value to: " . $key['user'] . "" . PHP_EOL;
                        //$msg .= "Deposit the value to: " . $key['user'] . "" . PHP_EOL;
                        $msg .= "<p>".$this->operator->orders->getOrder('price_coin').": " . $key['account'] . "</p>" . PHP_EOL;
                        
                        return $msg;
                    }
                }
                else{
                    $select = $this->operator->create($this->getOrder());
                    
                    $msg = "On moment exist'nt seller to this balance, but you be positioned on next sell, be patient ";
                    //$msg .= "Deposit the value to: " . $key['user'] . "" . PHP_EOL;
                    //$msg .= "<p>".$this->operator->orders->getOrder('price_coin').": " . $key['account'] . "</p>" . PHP_EOL;
                    
                    return $msg;
                }
            }
        }
    }
}

