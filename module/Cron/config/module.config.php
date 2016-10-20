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
        'routes' => array()
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
    'menu' => array(),
    
    // navigation
    'navigation' => array(),
);