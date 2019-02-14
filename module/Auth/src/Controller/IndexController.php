<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Auth\Helper\RequestAuthViewModelHelper;


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
        $this->auth = new RequestAuthViewModelHelper();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        return new ViewModel();
    }
    
    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function signinAction()
    {
        $this->auth->users->redirectToUrl($this, '/crowdforex/public/exchange');
        $this->auth->signin();
        return new ViewModel(array(
            'form' => $this->auth->authError()
        ));
    }
    
    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function signupAction()
    {
        $this->auth->signup();
        return new ViewModel(array(
            'form' => $this->auth->authError()
        ));
    }
    
    
}

