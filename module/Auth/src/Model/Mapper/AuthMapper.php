<?php
namespace Auth\Model\Mapper;

/**
 *
 * @author Lenovo
 *        
 */
class AuthMapper
{

    public $name;
    
    public $user;
    
    public $email;
    
    public $password;
    
    public $message;
    
    
    /**
     */
    public function __construct()
    {}
    
    public function getData(array $data)
    {
        if(is_array($data)){
            foreach($data as $key => $value){
                switch($key){
                    case 'name':
                        $this->setName($value);
                        break;
                    case 'user':
                        $this->setUser($value);
                        break;
                    case 'email':
                        $this->setEmail($value);
                        break;
                    case 'password':
                        $this->setPassword($value);
                        break;
                }
            }
        }
    }
    
    /**
     * @param $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * @param $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param $password
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @param $message
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
    
    
    /**
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}

