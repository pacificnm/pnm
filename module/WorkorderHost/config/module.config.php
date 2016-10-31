<?php
return array(
    'module' => array(
        'WorkorderHost' => array(
            'name' => 'WorkorderHost',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'workorder-host-create',
                    'workorder-host-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    // controllers
    'controllers' => array(
        'factories' => array(
            'WorkorderHost\Controller\CreateController' => 'WorkorderHost\Controller\Factory\CreateControllerFactory',
            'WorkorderHost\Controller\DeleteController' => 'WorkorderHost\Controller\Factory\DeleteControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'WorkorderHost\Service\WorkorderHostServiceInterface' => 'WorkorderHost\Service\Factory\WorkorderHostServiceFactory',
            'WorkorderHost\Mapper\MysqlMapperInterface' => 'WorkorderHost\Mapper\Factory\MysqlMapperFactory',
            'WorkorderHost\Form\WorkorderHostForm' => 'WorkorderHost\Form\Factory\WorkorderHostFormFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'workorder-host-create' => array(
                'title' => 'Add Host To Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/host/create',
                    'defaults' => array(
                        'controller' => 'WorkorderHost\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-host-delete' => array(
                'title' => 'Remove Host From Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/host/[:workorderHostId]/delete',
                    'defaults' => array(
                        'controller' => 'WorkorderHost\Controller\DeleteController',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'WorkorderHost' => 'WorkorderHost\View\Helper\Factory\WorkorderHostViewHelperFactory'
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            'workorder-host' => __DIR__ . '/../view'
        ),
        'template_map' => array(
            'partials/workorder-host' => __DIR__ . '/../view/workorder-host/partials/workorder-host.phtml'
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
                                'label' => 'Work Orders',
                                'route' => 'workorder-list',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'View Work Order',
                                        'route' => 'workorder-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Remove Host',
                                                'route' => 'workorder-host-delete',
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
        )
    ),
    // menu
    'menu' => array(
        'default' => array()
    ),
    // acl
    'acl' => array(
        'default' => array(
            array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    )
);