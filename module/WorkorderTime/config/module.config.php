<?php
return array(
    'WorkorderTime' => array(
        'name' => 'WorkorderTime',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'WorkorderTime\Controller\Create' => 'WorkorderTime\Controller\Factory\CreateControllerFactory'
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
                'title' => 'Create Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/work-order-time/create',
                    'defaults' => array(
                        'controller' => 'WorkorderTime\Controller\Create',
                        'action' => 'index'
                    )
                )
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