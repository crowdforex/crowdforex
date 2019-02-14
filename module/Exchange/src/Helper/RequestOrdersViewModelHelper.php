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
                //'user' => 'tiagocamini',
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
            
            $this->operator->create($this->getOrder());
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
    
    public function getGraphic()
    {
        $client = new Client();
        $client->setHydrateUrl(array(
            'http://localhost'
        ));
        return $client->getGraphic();
    }
}

