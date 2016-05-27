<?php
return array(
    'Workorder' => array(
        'name' => 'Workorder',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'workorder-list'
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Workorder\Controller\Index' => 'Workorder\Controller\Factory\IndexControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array()
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'workorder-list' => array(
                'title' => 'Client Work Orders',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order',
                    'defaults' => array(
                        'controller' => 'Workorder\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-create' => array(
                'title' => 'Create Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/create',
                    'defaults' => array(
                        'controller' => 'Workorder\Controller\Create',
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
    )
);