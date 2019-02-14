<?php
namespace Exchange\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Exchange\Model\Orders;
use Exchange\Helper\RequestOrdersViewModelHelper;
use Wallet\Model\Wallet;
use Auth\Model\Users;


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
    {
        $this->exchange = new RequestOrdersViewModelHelper();
        $this->users = new Users();
        //$this->redirect()->;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->users->redirectToAuthUrl($this, 'account/auth/signin');
        $this->exchange->operate();
        
        return new ViewModel(array(
            'orders' => $this->exchange->getAllOrders(),
            'graphic' => $this->exchange->getGraphic()
        ));
    }
    
    /**
     * 
     * @return mixed
     */
    public function cancelAction()
    {
        $this->exchange->cancel();
        $this->redirect()->toUrl('/crowdforex/public/exchange');
    }
    
    /**
     * 
     */
    public function ordersAction()
    {
        return new ViewModel(array(
            'orders' => $this->exchange->getAllOrders()
        ));
    }
    
}

