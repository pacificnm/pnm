<?php
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
                'employee' => array(
                    'workorder-call-log-index',
                    'workorder-call-log-create',
                    'workorder-call-log-update',
                    'workorder-call-log-delete',
                    'workorder-call-log-view'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    
    'controllers' => array(
        'factories' => array(
            'WorkorderCallLog\Controller\CreateController' => 'WorkorderCallLog\Controller\Factory\CreateControllerFactory',
            'WorkorderCallLog\Controller\DeleteController' => 'WorkorderCallLog\Controller\Factory\DeleteControllerFactory',
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'WorkorderCallLog\Mapper\MysqlMapperInterface' => 'WorkorderCallLog\Mapper\Factory\MysqlMapperFactory',
            'WorkorderCallLog\Service\WorkorderCallLogServiceInterface' => 'WorkorderCallLog\Service\Factory\WorkorderCallLogServiceFactory',
            'WorkorderCallLog\Form\WorkorderCallLogForm' => 'WorkorderCallLog\Form\Factory\WorkorderCallLogFormFactory',
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'workorder-call-log-index' => array(
                'title' => 'Call Log',
                'pageTitle' => 'Call Log',
                'pageSubTitle' => '',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'workorder-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/call-log',
                    'defaults' => array(
                        'controller' => 'WorkorderCallLog\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-call-log-create' => array(
                'title' => 'Call Log',
                'pageTitle' => 'Call Log',
                'pageSubTitle' => '',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'call-log-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/call-log/create-workorder/[:callLogId]',
                    'defaults' => array(
                        'controller' => 'WorkorderCallLog\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-call-log-delete' => array(
                'title' => 'Delete Call Log',
                'pageTitle' => 'Delete Call Log',
                'pageSubTitle' => '',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'call-log-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/call-log/delete-workorder/[:workorderCallLogId]',
                    'defaults' => array(
                        'controller' => 'WorkorderCallLog\Controller\DeleteController',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    'view_helpers' => array(
        'factories' => array(
            'getWorkorderCallLog' => 'WorkorderCallLog\View\Helper\Factory\GetWorkorderCallLogFactory',
            'GetCallLogWorkorder' => 'WorkorderCallLog\Service\Factory\GetCallLogWorkorderFactory'
        )  
    ),
    
    // menu
    'menu' => array(
        'default' => array(
            array(
                'title' => 'Client',
                'icon' => 'fa fa-something',
                'route' => 'client-index',
                'subMenu' => array(
                    array(
                        'title' => 'Call Log',
                        'icon' => 'fa fa-phone',
                        'route' => 'call-log-index',
                    )
                )
            )
        )
    ),
    
    // navigation
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Clients',
                'route' => 'client-index',
                'resource' => 'client-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'View Client',
                        'route' => 'client-view',
                        'resource' => 'client-view',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Call Log',
                                'route' => 'call-log-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'View',
                                        'route' => 'call-log-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Delete Work Order',
                                                'route' => 'workorder-call-log-delete',
                                                'useRouteMatch' => true,
                                            )
                                        )
                                    ),
                                    array(
                                        'label' => 'Work Order',
                                        'route' => 'workorder-call-log-create',
                                        'useRouteMatch' => true,
                                    ),
                                    
                                )
                            )
                        )
                    )
                )
            )
            
        )
    )
    
);