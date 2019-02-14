<?php
namespace Auth\Helper;

use Auth\Model\Users;

/**
 *
 * @author Lenovo
 *        
 */
class RequestAuthViewModelHelper
{

    /**
     */
    public function __construct()
    {
        $this->users = new Users();
    }
    
    public function getUserData()
    {
        $user = null;
        $password = null;
        $email = null;
        $name = null;
        
        if(isset($_POST['user'])){
            $user = $_POST['user'];
        }
        if(isset($_POST['password'])){
            $password = $_POST['password'];
        }
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if(isset($_POST['name'])){
            $name = $_POST['name'];
        }
        
        return array(
            'user' => $user,
            'password' => $password,
            'email' => $email,
            'name' => $name
        );
    }
    /**
     * 
     * @return \Zend\Authentication\Result
     */
    public function signin()
    {
        $data = $this->getUserData();
        
        return $this->users->authenticate(array(
            'user' => $data['user'],
            'password' => $data['password']
        ));
        
    }
    
   public function signup()
   {
       $data = $this->getUserData();
       
       if(isset($_POST['user'])){
           return $this->users->signup(array(
               'user' => $data['user'],
               'password' => $data['password'],
               'email' => $data['email'],
               'name' => $data['name']
           ));
       }
       
   }
    
    public function authError()
    {
        return $this->users->session->container()->user;
    }
}

