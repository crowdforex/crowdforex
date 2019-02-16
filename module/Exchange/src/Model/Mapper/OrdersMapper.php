<?php
namespace Exchange\Model\Mapper;

/**
 *
 * @author Lenovo
 *        
 */
class OrdersMapper
{
    
    public $id;
    
    public $user;
    
    public $orderUser;
    
    public $amountCoin;
    
    public $priceCoin;
    
    public $amount;
    
    public $price;
    
    public $type;
    
    public $status;
    
    public $dateOpenOrder;
    
    public $dateClosedOrder;
    
    
    /**
     */
    public function __construct()
    {}
    
    public function getData(array $data)
    {
        if(is_array($data)){
            foreach($data as $key => $value){
                switch($key){
                    case 'id':
                        $this->setId($value);
                        break;
                    case 'user':
                        $this->setUser($value);
                        break;
                    case 'order_user':
                        $this->setOrderUser($value);
                        break;
                    case 'amount_coin':
                        $this->setAmountCoin($value);
                        break;
                    case 'price_coin':
                        $this->setPriceCoin($value);
                        break;
                    case 'amount':
                        $this->setAmount($value);
                        break;
                    case 'price':
                        $this->setPrice($value);
                        break;
                    case 'type':
                        $this->setType($value);
                        break;
                    case 'status':
                        $this->setStatus($value);
                        break;
                    case 'date_open_order':
                        $this->setDateOpenOrder($value);
                        break;
                    case 'date_closed_order':
                        $this->setDateClosedOrder($value);
                        break;
                }
            }
        }
    }
    
    /**
     * @param $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
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
     * @param $orderUser
     * @return self
     */
    public function setOrderUser($orderUser)
    {
        $this->orderUser = $order;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getOrderUser()
    {
        return $this->orderUser;
    }
    
    /**
     * @param $amountCoin
     * @return self
     */
    public function setAmountCoin($amountCoin)
    {
        $this->amountCoin = $amountCoin;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getAmountCoin()
    {
        return $this->amountCoin;
    }
    
    /**
     * @param $priceCoin
     * @return self
     */
    public function setPriceCoin($priceCoin)
    {
        $this->priceCoin = $priceCoin;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getPriceCoin()
    {
        return $this->priceCoin;
    }
    
    /**
     * @param $amount
     * @return self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }
    
    /**
     * @param $price
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * @param $status
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * @param $dateOpenOrder
     * @return self
     */
    public function setDateOpenOrder($dateOpenOrder)
    {
        $this->dateOpenOrder = $dateOpenOrder;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getDateOpenOrder()
    {
        return $this->dateOpenOrder;
    }
    
    /**
     * @param $dateClosedOrder
     * @return self
     */
    public function setDateClosedOrder($dateClosedOrder)
    {
        $this->dateClosedOrder = $dateClosedOrder;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getDateClosedOrder()
    {
        return $this->dateClosedOrder;
    }
}

