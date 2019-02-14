<?php
namespace Auth\Model;

use Application\DbConnection\ParentDao;
use Auth\Model\Mapper\AuthMapper;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;
use Zend\Db\Adapter\Adapter;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthAdapter;
use Zend\Session\Container;
use Zend\Session\SessionManager;
use Zend\Session\Config\StandardConfig;
use Zend\Session\Storage\SessionStorage;
use Manager\Session\Session;
use Manager\Db\DbManager;
use Zend\Authentication\Adapter\DbTable;

/**
 *
 * @author Lenovo
 *        
 */
class Users extends ParentDao
{

    /**
     */
    public function __construct()
    {
        $this->users = $this->connect('users');
        $this->mapper = new AuthMapper();
        $this->session = new Session();
        //$sessionManager = $container->get(SessionManager::class);
        
        //$authStorage = new SessionStorage('Auth', 'session', new SessionManager());
        $this->filter = new PasswordFilterHash();
        $this->dbManager = new DbManager(require __DIR__ . '/../../../../config/autoload/global.php');
        
        $this->authAdapter = new AuthAdapter(
            $this->dbManager->dbAdapter(),
            'users',
            'username',
            'password'
            );
        
        
        
        //$this->auth = new AuthenticationService($authStorage, $this->authAdapter);
        //
    }
    
    
    
    /**
     * 
     * @return unknown
     */
    public function signup($data)
    {
        $this->mapper->getData($data);
        
        $user = $this->users->data->select(array(
            'user' => $this->mapper->getUser()
        ));
        
        $email = $this->users->data->select(array(
            'email' => $this->mapper->getEmail()
        ));
        
        if($user->count() > 0){
            return $this->mapper->setMessage('User existing');
        }
        
        if($email->count() > 0){
            return $this->mapper->setMessage('Email existing');
        }
        
        //if($this->filter-> == )
        
        return $this->users->data->insert(array(
            'name' => $this->mapper->getName(),
            'user' => $this->mapper->getUser(),
            'email' => $this->mapper->getEmail(),
            'password' => $this->filter->create($this->mapper->getPassword()),
            
        ));
    }
    
    /**
     * 
     */
    public function authenticate($data)
    {
        $this->mapper->getData($data);
        
        
        
        
        $this->authAdapter();
        
        // Perform the authentication query, saving the result
        
    }
    
    public function authAdapter()
    {
        // Configure the instance with constructor parameters:
        $authAdapter = new AuthAdapter(
            $this->dbManager->dbAdapter(),
            'users',
            'username',
            'password'
            );
        
        
        $authAdapter
        ->setTableName('users')
        ->setIdentityColumn('user')
        ->setCredentialColumn('password');
        
        $authAdapter
        ->setIdentity($this->mapper->getUser())
        ->setCredential($this->mapper->getPassword());
        
        $user = $this->users->data->select(array(
            'user' => $this->mapper->getUser()
        ))->count();
        
        $credential = $this->users->data->select(array(
            'user' => $this->mapper->getUser(),
            
        ))->toArray();
        
        $passwordFilterHash = new PasswordFilterHash();
        foreach($credential as $key){
            $password = $passwordFilterHash->verify($this->mapper->getPassword(), $key['password']);
            
            if($user == 0 OR
                $key['user'] != $this->mapper->getUser() OR
                $password != true){
                    return $this->mapper->setMessage('Invalid Password');
                    
            }else{
                $this->session->container()->user = $authAdapter->getIdentity();
                return $authAdapter->authenticate();
            }
        }
        
    }
    
    public function logout()
    {
        // Allow to log out only when user is logged in.
        if ($this->authService->getIdentity()==null) {
            throw new \Exception('The user is not logged in');
        }
        
        // Remove identity from session.
        $this->auth->clearIdentity();
    }
}

