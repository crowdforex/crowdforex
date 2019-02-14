<?php
namespace Auth\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Password;

/**
 *
 * @author Lenovo
 *        
 */
class RequestSigninForm extends Form
{
    
    public function __construct($name = null)
    {
        parent::__construct($name);
        
        $this->add(array(
            'name' => 'login',
            'type' => Text::class,
        ));
        
        $this->add(array(
            'name' => 'password',
            'type' => Password::class,
        ));
    }
}

