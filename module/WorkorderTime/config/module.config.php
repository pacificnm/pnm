<?php
return array(
    'module' => array(
        'WorkorderTime' => array(
            'name' => 'WorkorderTime',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(
                    'workorder-time-create',
                    'workorder-time-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'WorkorderTime\Controller\Create' => 'WorkorderTime\Controller\Factory\CreateControllerFactory',
            'WorkorderTime\Controller\Delete' => 'WorkorderTime\Controller\Factory\DeleteControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'WorkorderTime\Service\TimeServiceInterface' => 'WorkorderTime\Service\Factory\TimeServiceFactory',
            'WorkorderTime\Mapper\TimeMapperInterface' => 'WorkorderTime\Mapper\Factory\TimeMapperFactory',
            
            'WorkorderTime\Form\TimeForm' => 'WorkorderTime\Form\Factory\TimeFormFactory',
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'workorder-time-create' => array(
                'title' => 'Create Work Order Time',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/work-order-time/create',
                    'defaults' => array(
                        'controller' => 'WorkorderTime\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-time-delete' => array(
                'title' => 'Delete Work Order Time',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/work-order-time/delete/[:workorderTimeId]',
                    'defaults' => array(
                        'controller' => 'WorkorderTime\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'GetWorkorderTimes' => 'WorkorderTime\View\Helper\Factory\GetWorkorderTimesFactory',
            'SalesByLabor' => 'WorkorderTime\View\Helper\Factory\SalesByLaborFactory'
        ),
        'invokables' => array()
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);