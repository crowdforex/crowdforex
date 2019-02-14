<?php
namespace Api;

//use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
//use Manager\Db\Model;

return [
        'router' => [
            'routes' => [
                
                'api/home' => [
                    'type'    => Segment::class,
                    'options' => [
                        'route'    => '/api[/:action]',
                        'defaults' => [
                            'controller' => Controller\IndexController::class,
                            'action'     => 'index',
                        ],
                    ],
                ],
            ],
        ],
    'translator' => [
        'locale' => 'en_US',
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
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
                'api/layout'           => __DIR__ . '/../../Api/4mmview/layout/layout.phtml',
                ],
            'template_path_stack' => [
                __DIR__ . '/../view',
            ],
        ],
    
    
];

    
