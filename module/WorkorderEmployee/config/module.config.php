<?php
return array(
    'module' => array(
        'WorkorderEmployee' => array(
            'name' => 'WorkorderEmployee',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'workorder-employee-create',
                    'workorder-employee-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'WorkorderEmployee\\Controller\\CreateController' => 'WorkorderEmployee\Controller\Factory\CreateControllerFactory',
            'WorkorderEmployee\\Controller\\DeleteController' => 'WorkorderEmployee\Controller\Factory\DeleteControllerFactory'
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'WorkorderEmployee\Mapper\WorkorderEmployeeMapperInterface' => 'WorkorderEmployee\Mapper\Factory\WorkorderEmployeeMapperFactory',
            'WorkorderEmployee\Service\WorkorderEmployeeServiceInterface' => 'WorkorderEmployee\Service\Factory\WorkorderEmployeeServiceFactory',
            'WorkorderEmployee\Form\WorkorderEmployeeForm' => 'WorkorderEmployee\Form\Factory\WorkorderEmployeeFormFactory',
            'WorkorderEmployee\Listener\WorkorderEmployeeListener' => 'WorkorderEmployee\Listener\Factory\WorkorderEmployeeListenerFactory'
        )
    ),
    // router
    'router' => array(
        'routes' => array(
            'workorder-employee-create' => array(
                'title' => 'Add Employee To Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/employee/create',
                    'defaults' => array(
                        'controller' => 'WorkorderEmployee\\Controller\\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-employee-delete' => array(
                'title' => 'Remove Employee from Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/employee/[:employeeId]/delete',
                    'defaults' => array(
                        'controller' => 'WorkorderEmployee\\Controller\\DeleteController',
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
                                                'label' => 'Remove Employee',
                                                'route' => 'workorder-employee-delete',
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