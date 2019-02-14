<?php
namespace Api\Controller;

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
    
}
