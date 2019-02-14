<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Keygenerator;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'keygenerator' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/keygenerator[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class    => InvokableFactory::class,
            
        ],
    ],
    
    'view_manager' => [
        'template_map' => [
            'statistics/index'           => __DIR__ . '/../view/statistics/index/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
            __DIR__ . '/../view/statistics'
        ],
    ],
];
