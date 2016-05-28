<?php
return array(
    'Workorder' => array(
        'name' => 'Workorder',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'workorder-list',
                'workorder-create',
                'workorder-delete',
                'workorder-update',
                'workorder-view',
                'workorder-print',
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Workorder\Controller\Create' => 'Workorder\Controller\Factory\CreateControllerFactory',
            'Workorder\Controller\Delete' => 'Workorder\Controller\Factory\DeleteControllerFactory',
            'Workorder\Controller\Index' => 'Workorder\Controller\Factory\IndexControllerFactory',
            'Workorder\Controller\Update' => 'Workorder\Controller\Factory\UpdateControllerFactory',
            'Workorder\Controller\View' => 'Workorder\Controller\Factory\ViewControllerFactory',
            'Workorder\Controller\Print' => 'Workorder\Controller\Factory\PrintControllerFactory'
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
            ),
            'workorder-delete' => array(
                'title' => 'Delete Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/delete/[:workorderId]',
                    'defaults' => array(
                        'controller' => 'Workorder\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-update' => array(
                'title' => 'Edit Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/update/[:workorderId]',
                    'defaults' => array(
                        'controller' => 'Workorder\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-view' => array(
                'title' => 'View Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/view/[:workorderId]',
                    'defaults' => array(
                        'controller' => 'Workorder\Controller\View',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-print' => array(
                'title' => 'Print Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/print/[:workorderId]',
                    'defaults' => array(
                        'controller' => 'Workorder\Controller\Print',
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