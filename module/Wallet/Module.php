<?php

namespace Wallet;

use Manager\Db\DbManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Db\Adapter\Adapter;
use Manager\Config\ModuleInterface;
use Manager\Db\Sql\Sql as SqlManager;



class Module implements ModuleInterface
{
    public function onBootstrap($e)
    {
        //$e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
 
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src',
                ),
            ),
        );
    }
    
    public static function getServiceConfig($table = null)
    {
         /*$db  = new DbManager(require __DIR__ . '/../../config/autoload/global.php');
         $sql = new SqlManager($db, $table);
         return $sql;
         */
    }


}
