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
                    'cron-index',
                    'cron-create',
                    'cron-update',
                    'cron-delete',
                    'cron-view'
                )
            )
        )
    ),
    
    'controllers' => array(
        'factories' => array(
            'Cron\Controller\ConsoleController' => 'Cron\Controller\Factory\ConsoleControllerFactory',
            'Cron\Controller\CreateController' => 'Cron\Controller\Factory\CreateControllerFactory',
            'Cron\Controller\DeleteController' => 'Cron\Controller\Factory\DeleteControllerFactory',
            'Cron\Controller\IndexController' => 'Cron\Controller\Factory\IndexControllerFactory',
            'Cron\Controller\UpdateController' => 'Cron\Controller\Factory\UpdateControllerFactory',
            'Cron\Controller\ViewController' => 'Cron\Controller\Factory\ViewControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Cron\Mapper\MysqlMapperInterface' => 'Cron\Mapper\Factory\MysqlMApperFactory',
            'Cron\Service\CronServiceInterface' => 'Cron\Service\Factory\CronServiceFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'cron-index' => array(
                'title' => 'Cron',
                'pageTitle' => 'Config',
                'pageSubTitle' => '',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'cron-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/cron',
                    'defaults' => array(
                        'controller' => 'Cron\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'cron-create' => array(
                'title' => 'New Cron',
                'type' => 'literal',
                'pageTitle' => 'New Config',
                'pageSubTitle' => '',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'cron-index',
                'options' => array(
                    'route' => '/admin/cron/create',
                    'defaults' => array(
                        'controller' => 'Cron\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'cron-update' => array(
                'title' => 'Edit Cron',
                'title' => 'Edit Cron',
                'pageTitle' => 'Cron',
                'pageSubTitle' => '',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'cron-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/cron/[:cronId]/update',
                    'defaults' => array(
                        'controller' => 'Cron\Controller\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'cron-delete' => array(
                'title' => 'Delete Cron',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/cron/[:cronId]/delete',
                    'defaults' => array(
                        'controller' => 'Cron\Controller\DeleteController',
                        'action' => 'index'
                    )
                )
            ),
            'cron-view' => array(
                'title' => 'View Cron',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/cron/[:cronId]/view',
                    'defaults' => array(
                        'controller' => 'Cron\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    'console' => array(
        'router' => array(
            'routes' => array(
                // cron run see Module.php
                'cron-run' => array(
                    'options' => array(
                        'route' => 'cron --run',
                        'defaults' => array(
                            'controller' => 'Cron\Controller\ConsoleController',
                            'action' => 'index'
                        )
                    )
                ),
                'cron-list' => array(
                    'options' => array(
                        'route' => 'cron --list',
                        'defaults' => array(
                            'controller' => 'Cron\Controller\ConsoleController',
                            'action' => 'list'
                        )
                    )
                ),
                'cron-running' => array(
                    'options' => array(
                        'route' => 'cron --running',
                        'defaults' => array(
                            'controller' => 'Cron\Controller\ConsoleController',
                            'action' => 'running'
                        )
                    )
                ),
                'cron-running' => array(
                    'options' => array(
                        'route' => 'cron --kill --pid=',
                        'defaults' => array(
                            'controller' => 'Cron\Controller\ConsoleController',
                            'action' => 'kill'
                        )
                    )
                )
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
                'title' => 'Admin',
                'icon' => 'fa fa-gears',
                'route' => 'admin-index',
                'subMenu' => array(
                    array(
                        'title' => 'Cron',
                        'icon' => 'fa fa-gears',
                        'route' => 'cron-index'
                    )
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
                        'label' => 'Cron',
                        'route' => 'cron-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New',
                                'route' => 'cron-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'View',
                                'route' => 'cron-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'cron-delete',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Edit',
                                        'route' => 'cron-update',
                                        'useRouteMatch' => true
                                    )
                                )
                            )
                        )
                    )
                )
            )
        )
    )
);