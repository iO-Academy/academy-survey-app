<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\Router\Http\Method;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
            'builder' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/builder',
                    'defaults' => [
                        'controller' => Controller\BuilderController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'account' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/account',
                    'defaults' => [
                        'controller' => Controller\AccountController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => false,
                'child_routes' => [
                    'get' => [
                        'type' => Method::class,
                        'options' => [
                            'verb' => 'get',
                            'defaults' => [ 'action' => 'index'],
                        ]
                    ],
                    'post' => [
                        'type' => Method::class,
                        'options' => [
                            'verb' => 'post',
                            'defaults' => [ 'action' => 'post'],
                        ]
                    ],
                ],
            ],
            'login' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/login',
                    'defaults' => [
                        'controller' => Controller\LoginController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
            'surveySave' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/survey/create',
                    'defaults' => [
                        'controller' => Controller\SurveyController::class,
                        'action'     => 'create',
                    ],
                ],
                'may_terminate' => false,
                'child_routes' => [
                    'post' => [
                        'type' => Method::class,
                        'options' => [
                            'verb' => 'post',
                            'defaults' => [ 'action' => 'create'],
                        ]
                    ],

                ],
            ],
            'userSurveySubmit' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/survey/submit',
                    'defaults' => [
                        'controller' => Controller\SurveyController::class,
                        'action'     => 'submit',
                    ],
                ],
                'may_terminate' => false,
                'child_routes' => [
                    'post' => [
                        'type' => Method::class,
                        'options' => [
                            'verb' => 'post',
                            'defaults' => [ 'action' => 'submit'],
                        ]
                    ],

                ],
            ],
            'logout' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/logout',
                    'defaults' => [
                        'controller' => Controller\LogoutController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],
            'survey' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/survey/view/:surveyId',
                    'defaults' => [
                        'controller' => Controller\SurveyController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\BuilderController::class => Factory\BuilderControllerFactory::class,
            Controller\AccountController::class => Factory\AccountControllerFactory::class,
            Controller\SurveyController::class => Factory\SurveyControllerFactory::class,
            Controller\LoginController::class => Factory\LoginControllerFactory::class,
            Controller\LogoutController::class => InvokableFactory::class,
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
            'application/login/login' => __DIR__ . '/../view/application/login/login.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy'
        ],
    ],
    'service_manager' => [
        'factories' => [
            'pdo' => Factory\PdoFactory::class,
            Model\SurveyModel::class => Factory\SurveyModelFactory::class,
            Model\UserModel::class => Factory\UserModelFactory::class,
        ],
    ],
];
