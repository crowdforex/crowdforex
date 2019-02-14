<?php
namespace Keygenerator\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Keygenerator\Model\PublicKey;
use Keygenerator\Model\PrivateKey;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $publicKey = new PublicKey();
        $privateKey = new PrivateKey();
        
        echo var_dump($privateKey->create('GHughjkHJGYUT6ghIUY8giYUIY789huiy98HU8y7huIYiyUIHGjiuGYUgyutYGugyuYUIhuihuihuihuugtydrR6GYIMK;MkhIUY8'));
        echo var_dump($publicKey->reader($privateKey->create('GHughjkHJGYUT6ghIUY8giYUIY789huiy98HU8y7huIYiyUIHGjiuGYUgyutYGugyuYUIhuihuihuihuugtydrR6GYIMK;MkhIUY8')));
        echo var_dump($publicKey->reader('NzJhMDFiOTVjMTAwYjY2YzRjODdiZWE4M2EwYmIzOGI2MjNlMjY1YzE1ODgyODJiY2Q3ZWFiM2U2MjE3Nzk3NTlmYmY3ZmY4NTJkZDhjNDI2MDQ3Nzk0NjY5YzE2YmFkYjNkNjdkNmNkMTVjNDQ2MDlhNTQ4Y2NmM2Y0OTdlNTY='));
        
        return new ViewModel();
    }
}
