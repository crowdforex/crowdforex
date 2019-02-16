<?php
namespace Exchange\Model;

use Application\DbConnection\ParentDao;
use Exchange\Model\Mapper\OrdersMapper;
use Manager\Session\Session;

/**
 *
 * @author Lenovo
 *        
 */
class Orders extends ParentDao
{

    /**
     */
    public function __construct()
    {
        $this->orders = $this->connect('orders');
        $this->mapper = new OrdersMapper();
        $this->session = new Session();
    }
    
    /**
     * 
     */
    public function create($data)
    {
        $this->mapper->getData($data);
        
        if($this->session->container()->user != $this->getOrder('user') //&&
            // &&
            //$this->mapper->getOrderUser() !=
            ){
                $this->execute();
        }
    }
    
    /**
     * 
     * @param string $field
     */
    public function getOrder($field)
    {
        $order = $this->get($field, array(
            //'user' => $this->mapper->getUser(),
            'amount_coin' => $this->mapper->getAmountCoin(),
            'price_coin' => $this->mapper->getPriceCoin(),
            //'amount' => $this->mapper->getAmount(),
            'price' => $this->mapper->getPrice(),
            //'type' => $this->mapper->getType(),
            'status' => $this->mapper->getStatus(),
        ));
        
        return $order;
    }
    
    /**
     *
     * @param string $field
     */
    public function getOrderByDeposit($field)
    {
        $order = $this->get($field, array(
            'id' => $this->mapper->getId(),
            'user' => $this->session->container()->user,
            'status' => 'open',
            'partial' => 'y'
        ));
        
        return $order;
    }
    
    /**
     * 
     * @param array string $where
     * @return mixed
     */
    public function search($where)
    {
        $select = $this->orders->get($where);
        return $select;
        
    }
    
    /**
     * 
     */
    public function get($field, array $where)
    {
        $select = $this->orders->data->select($where);
        
        foreach($select as $key){
            return $key[$field];
        }
    }
    
    /**
     * 
     * @param string $field
     * @param string number $id
     * @return mixed
     */
    public function getMyOrderById($field, $id)
    {
        return $this->get($field, array(
            'id' => $id,
            'status' => 'open',
            'user' => $this->session->container()->user
        ));
    }
    
    /**
     * 
     * @param number string $id
     * @return mixed
     */
    public function cancel($id)
    {
        return $this->orders->data->delete(array(
            'id' => $id,
            'status' => 'open',
            'user' => $this->session->container()->user
        ));
    }
    
    /**
     * @return mixed
     */
    public function execute()
    {
        echo var_dump($this->getOrder('amount'));
        if($this->getOrder('id') != null OR
           $this->getOrder('amount_coin') != $this->mapper->getPriceCoin() OR
           $this->mapper->getType() != $this->getOrder('type') &&
           $this->mapper->getStatus() == $this->getOrder('status') ){
               if($this->mapper->getAmount() < $this->getOrder('amount') &&
                  $this->getOrder('partial') == 'n'){
                   $status = 'open';
                   $date = date('Y-m-d H:i:s');
                   $amount = number_format($this->getOrder('amount'), '8', '.', '') - number_format($this->mapper->getAmount(), '8', '.', '');
                   
                   
                   $this->orders->data->insert(array(
                       'user' => $this->getOrder('user'),
                       'amount_coin' => $this->getOrder('amount_coin'),
                       'price_coin' => $this->getOrder('price_coin'),
                       'amount' => $amount,
                       'price' => $this->getOrder('price'),
                       'type' => $this->getOrder('type'),
                       'status' => $status,
                       'partial' => 'n',
                       'date_open_order' => date('Y-m-d H:i:s'),
                       'date_closed_order' => null
                   ));
                   $this->orders->data->update(array(
                       'order_user' => $this->session->container()->user,
                       'status' => 'closed',
                       'date_closed_order' => $date,
                       'amount' => number_format($amount, '8', '.', ''),
                       'partial' => 'y'
                   ), array(
                       'id' => $this->getOrder('id'),
                       'partial' => 'n'
                   ));
                   
               }
               
               else if($this->getOrder('amount') == $this->mapper->getAmount() && $this->mapper->getStatus() == $this->getOrder('status') && $this->getOrder('partial') == 'n'){
                   $status = 'closed';
                   $date = date('Y-m-d H:i:s');
                   $amount = 0;
                   $this->orders->data->update(array(
                       'order_user' => $this->session->container()->user,
                       'status' => $status,
                       'date_closed_order' => $date,
                       //'amount' => number_format($amount, '8', '.', '')
                   ), array(
                       'id' => $this->getOrder('id')
                   ));
               }
               
               
               
               
               
               
        }
        else{
            $this->orders->data->insert(array(
                'user' => $this->session->container()->user,
                'amount_coin' => $this->mapper->getAmountCoin(),
                'price_coin' => $this->mapper->getPriceCoin(),
                'amount' => $this->mapper->getAmount(),
                'price' => $this->mapper->getPrice(),
                'type' => $this->mapper->getType(),
                'status' => $this->mapper->getStatus(),
                'date_open_order' => date('Y-m-d H:i:s'),
                'date_closed_order' => $this->mapper->getDateClosedOrder()
            ));
        }
    }
    
    public function insertOrder()
    {
        if($this->getOrder('user') != $this->session->container()->user){
            return $this->orders->data->insert(array(
                'user' => $this->session->container()->user,
                'amount_coin' => $this->mapper->getAmountCoin(),
                'price_coin' => $this->mapper->getPriceCoin(),
                'amount' => $this->mapper->getAmount(),
                'price' => $this->mapper->getPrice(),
                'type' => $this->mapper->getType(),
                'status' => $this->mapper->getStatus(),
                'date_open_order' => date('Y-m-d H:i:s'),
                'date_closed_order' => $this->mapper->getDateClosedOrder()
            ));
        }
    }
    
    public function approveTrade($data)
    {
        //$this->mapper->getData($data);
        
        $status = 'closed';
        $date = date('Y-m-d H:i:s');
        $amount = 0;
        echo var_dump($this->getOrderByDeposit('id'));
        $this->orders->data->update(array(
            //'order_user' => $this->session->container()->user,
            'status' => $status,
            'date_closed_order' => $date,
            //'partial' => 'y'
            //'amount' => number_format($amount, '8', '.', '')
        ), array(
            'id' => $this->mapper->getId(),
            'user' => $this->session->container()->user,
            'partial' => 'y'
        ));
    }
    
    /**
     * 
     */
    public function partialExecution()
    {
        if($this->getOrder('amount') == $this->mapper->getAmount() && $this->mapper->getStatus() == $this->getOrder('status') && $this->getOrder('partial') == 'n' && $this->mapper->getAmountCoin() == $this->mapper->getPriceCoin()){
            $status = 'open';
            $date = date('Y-m-d H:i:s');
            $amount = 0;
            $this->orders->data->update(array(
                'order_user' => $this->session->container()->user,
                'status' => $status,
                'date_closed_order' => $date,
                'partial' => 'y'
                //'amount' => number_format($amount, '8', '.', '')
            ), array(
                'id' => $this->getOrder('id')
            ));
        }
    }
}

