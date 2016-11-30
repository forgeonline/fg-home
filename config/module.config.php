<?php
/**
 * Zend Backend (http://forge.co.nz/)
 *
 * Config
 *
 * PHP version 5
 *
 * @category Module
 * @package  FgHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://forge.co.nz
 * @link     http://forge.co.nz
 */

namespace FgHome;

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
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/login',
                    'defaults' => [
                        'controller'    => Controller\LoginController::class,
                        'action'        => 'process',
                    ],
                ],
				'may_terminate' => true,
				'child_routes' => [
					'logout' => [
						'type' => Literal::class,
						'options' => [
							'route' => '/logout',
							'defaults' => [
								'action' => 'logout',
							]
						],
					],
				],
            ],
            'dashboard' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/dashboard',
                    'defaults' => [
                        'controller'    => Controller\DashboardController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
			Controller\AdminController::class => 'FgHome\Factory\AdminControllerFactory',
            Controller\IndexController::class => 'FgHome\Factory\IndexControllerFactory',
            Controller\LoginController::class => 'FgHome\Factory\LoginControllerFactory',
			Controller\DashboardController::class => 'FgHome\Factory\DashboardControllerFactory',
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
            'fg-home/index/index'     => 
            __DIR__ . '/../view/application/index/index.phtml',
			'fg-home/dashboard/index' =>
			__DIR__ . '/../view/error/404.phtml',
            'login/process/layout'    => 
            __DIR__ . '/../view/layout/empty.phtml',
            'dashboard/index/layout'  => 
            __DIR__ . '/../view/layout/dashboard.phtml',
			'fg-home/dashboard/index'  => 
            __DIR__ . '/../view/layout/content/dashboard.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
			'admin/footer'			  => __DIR__ . '/../view/layout/footer.phtml',
			'admin/header'			  => __DIR__ . '/../view/layout/adminheader.phtml',
			'admin/sidebar/menu'	  => __DIR__ . '/../view/layout/sidebar/menu.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
