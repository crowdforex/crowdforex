<?php
namespace Wallet\Helper;

use Exchange\Model\TradeOperator;
use Wallet\Model\Wallet;
use Exchange\Helper\RequestOrdersViewModelHelper;

/**
 *
 * @author Lenovo
 *        
 */
class RequestWalletViewlModelHelper
{

    /**
     */
    public function __construct()
    {
        $this->wallet = new Wallet(array());
        $this->operator = new TradeOperator();
        $this->exchange = new RequestOrdersViewModelHelper();
    }
    
    public function getWalletBalance()
    {
        return $this->wallet->search(array(
            'user' => $this->wallet->session->container()->user,
            //'coin' => 'BTC'
        ));
    }
    
    public function getUserToDeposit()
    {
        if(isset($_POST['price'])){
      // $this->exchange->operate();
            if($this->operator->orders->getOrder('user') != null){
                
                $select = $this->operator->deposit($this->exchange->getOrder());
                
                foreach($select as $key){
                    $msg = "Deposit the value to: " . $key['user'] . "" . PHP_EOL;
                    //$msg .= "Deposit the value to: " . $key['user'] . "" . PHP_EOL;
                    $msg .= "<p>".$this->operator->orders->getOrder('price_coin').": " . $key['account'] . "</p>" . PHP_EOL;
                    
                    return $msg;
                }
            }
            else{
                $select = $this->operator->deposit($this->exchange->getOrder());
                
                $msg = "On moment exist'nt seller to this balance, but you be positioned on next sell, be patient ";
                //$msg .= "Deposit the value to: " . $key['user'] . "" . PHP_EOL;
                //$msg .= "<p>".$this->operator->orders->getOrder('price_coin').": " . $key['account'] . "</p>" . PHP_EOL;
                
                return $msg;
            }
        }
    }
}

