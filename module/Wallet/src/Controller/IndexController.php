<?php
namespace Wallet\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Wallet\Model\Balance;
use Wallet\Helper\RequestWalletViewlModelHelper;


/**
 *
 * @author Lenovo
 *        
 */
class IndexController extends AbstractActionController
{

    /**
     */
    public function __construct()
    {}
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $wallet = new RequestWalletViewlModelHelper();
        return new ViewModel(array(
            'balances' => $wallet->getWalletBalance()
        ));
    }
    
    
}

