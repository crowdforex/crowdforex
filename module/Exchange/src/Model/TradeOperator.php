<?php
namespace Exchange\Model;

use Wallet\Model\Wallet;

/**
 *
 * @author Lenovo
 *        
 */
class TradeOperator
{

    /**
     */
    public function __construct()
    {
        $this->orders = new Orders();
        $this->wallet = new Wallet(array());
    }
    
    /**
     * 
     * @param array $order
     */
    public function create(array $order)
    {
            $this->orders->mapper->getData($order);
            
            $amount = $order['amount'];
            $price = $order['price'];
            if($this->orders->mapper->getType() == 'buy'){
                $value = number_format($amount, '8', '.', '') * number_format($price, '8', '.', '');
                $coin = $order['price_coin'];
                $balance = $amount * $price;
            }
            if($this->orders->mapper->getType() == 'sell'){
                $value = number_format($amount, '8', '.', '');
                $coin = $order['amount_coin'];
                $balance = $amount;
            }
            $this->wallet->mapper->setCoin($coin);
            
            if($this->wallet->myBalance() >= $balance){
                if($this->orders->session->container()->user != $this->orders->getOrder('user')){
                    if($this->orders->getOrder('amount') == $order['amount'] OR
                        $this->orders->getOrder('status') == $order['status']
                        ){
                            //$this->orders->create($order);
                            $this->wallet->debit(array(
                                //'user' => $this->wallet->session->container()->user,
                                'balance' => $value,
                                'coin' => $coin
                            ));
                            $this->wallet->credit(array(
                                'user' => $this->orders->getOrder('user'),
                                'coin' => $coin,
                                'balance' => $value
                            ));
                            
                            $this->orders->create($order);
                    }else{
                        
                        $this->wallet->debit(array(
                            //'user' => $this->wallet->session->container()->user,
                            'balance' => $value,
                            'coin' => $coin
                        ));
                        $this->orders->create($order);
                    }
                }
            }
    }
    
    /**
     *
     */
    public function cancel($id)
    {
        $type = $this->orders->getMyOrderById('type', $id);
        $orderId = $this->orders->getMyOrderById('id', $id);
        $price = $this->orders->getMyOrderById('price', $id);
        $amount = $this->orders->getMyOrderById('amount', $id);
        if($type == 'sell'){
            $priceCoin = $this->orders->getMyOrderById('amount_coin', $id);
            $value = number_format($amount, '8', '.', '');
            
        }
        if($type == 'buy'){
            $priceCoin = $this->orders->getMyOrderById('price_coin', $id);
            $value = number_format($price, '8', '.', '') * number_format($amount, '8', '.', '');
            
        }
        //$value = number_format($price, '8', '.', '') * number_format($amount, '8', '.', '');
        
        if($orderId == $id){
            $this->wallet->credit(array(
                'user' => $this->orders->session->container()->user,
                'coin' => $priceCoin,
                'balance' => number_format($value, '8', '.', '')
            ));
        }
        
        return $this->orders->cancel($id);
        
    }
    
    /**
     * 
     * @return mixed
     */
    public function getAllOrders($priceCoin, $amountCoin)
    {
        return $this->orders->search(array(
            'price_coin' => $priceCoin,
            'amount_coin' => $amountCoin
        ));
    }
}

