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
        ),
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
            'WorkorderEmployee\Form\WorkorderEmployeeForm' => 'WorkorderEmployee\Form\Factory\WorkorderEmployeeFormFactory'
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
                        'action' => 'index',
                    ),
                ),
            ),
            'workorder-employee-delete' => array(
                'title' => 'Remove Employee from Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/employee/[:employeeId]/delete',
                    'defaults' => array(
                        'controller' => 'WorkorderEmployee\\Controller\\DeleteController',
                        'action' => 'index',
                    ),
                ),
            ),
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);