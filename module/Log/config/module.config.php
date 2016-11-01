<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
return array(
    'module' => array(
        'Cron' => array(
            'name' => 'Cron',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'log-index',
                    'log-view'
                )
            )
        )
    ),
    
    'controllers' => array(
        'factories' => array(
            'Log\Controller\IndexController' => 'Log\Controller\Factory\IndexControllerFactory',
            'Log\Controller\ViewController' => 'Log\Controller\Factory\ViewControllerFactory',
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Log\Service\LogServiceInterface' => 'Log\Service\Factory\LogServiceFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'log-index' => array(
                'title' => 'Logs',
                'pageTitle' => 'Logs',
                'pageSubTitle' => '',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'log-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/log',
                    'defaults' => array(
                        'controller' => 'Log\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'log-view' => array(
                'title' => 'View Log',
                'pageTitle' => 'Log',
                'pageSubTitle' => '',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'log-view',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/log/view/[:file]',
                    'defaults' => array(
                        'controller' => 'Log\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            ),
        )
    ),
    
    // console
    'console' => array(
        'router' => array(
            'routes' => array(
                
            )
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'factories' => array(),
        'invokables' => array()
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    
    // menu
    'menu' => array(
        'default' => array(
            'admin' => array(
                array(
                    'label' => 'Logs',
                    'icon' => 'fa fa-file',
                    'route' => 'log-index',
                    'resource' => 'log-index',
                    'order' => 10
                )
            )
        )
    ),
    
    // navigation
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Admin',
                'route' => 'admin-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Logs',
                        'route' => 'log-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'View',
                                'route' => 'log-view',
                                'useRouteMatch' => true,
                            )
                        )
                    )
                )
           ),
        ),
    )
);