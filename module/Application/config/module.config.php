<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;



return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller'    => Controller\IndexController::class,
                        'action'        => 'index',

                    ],
                ],
            ],
            'registration' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/registration[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller'    => Controller\RegistrationController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
            'about' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/about',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'about',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
            Controller\RegistrationController::class => Controller\Factory\RegistrationControllerFactory::class,
        ],
    ],
    'access_filter' => [
        'options' => [

            'mode' => 'restrictive'
        ],
        'controllers' => [
            Controller\IndexController::class => [
                // Allow anyone to visit "index" and "about" actions
                ['actions' => ['index', 'about'], 'allow' => '*'],
                // Allow authorized users to visit "settings" action
                ['actions' => ['settings'], 'allow' => '@']
            ],
        ]
    ],
    'service_manager' => [
        'factories' => [
            Service\NavManager::class => Service\Factory\NavManagerFactory::class,
        ],
    ],
    'session_containers' => [
        'UserRegistration'
    ],
    'view_helpers' => [
        'factories' => [
            View\Helper\Menu::class => View\Helper\Factory\MenuFactory::class,
            View\Helper\Breadcrumbs::class => InvokableFactory::class,
        ],
        'aliases' => [
            'mainMenu' => View\Helper\Menu::class,
            'pageBreadcrumbs' => View\Helper\Breadcrumbs::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    // The following key allows to define custom styling for FlashMessenger view helper.
    'view_helper_config' => [
        'flashmessenger' => [
            'message_open_format'      => '<div%s><ul><li>',
            'message_close_string'     => '</li></ul></div>',
            'message_separator_string' => '</li><li>'
        ]
    ],   
];
