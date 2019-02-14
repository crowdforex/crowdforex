<?php

namespace Exchange;

use Manager\Config\ModuleInterface;
use Zend\Mvc\ModuleRouteListener;



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
