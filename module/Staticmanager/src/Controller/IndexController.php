<?php
namespace Staticmanager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Api\Helper\RequestBlockchainJsonContent;

class IndexController extends AbstractActionController
{
    
    public function __construct()
    {
        //$this->session = new SessionHelper($this);
    }
    
    public function indexAction()
    {
        return new ViewModel();
    }
    
    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function graphicsAction()
    {
        return new ViewModel();
    }
    
    public function candlesAction()
    {
        return new ViewModel();
    }
    
    public function completeCandlesAction()
    {
        return new ViewModel();
    }
    
    public function ordersAction()
    {
        return new ViewModel();
        
    }
}
