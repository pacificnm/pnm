<?php
return array(
    'module' => array(
        'WorkorderCredit' => array(
            'name' => 'WorkorderCredit',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(
                    'workorder-credit-create'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'WorkorderCredit\Controller\Create' => 'WorkorderCredit\Controller\Factory\CreateControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'WorkorderCredit\Service\CreditServiceInterface' => 'WorkorderCredit\Service\Factory\CreditServiceFactory',
            'WorkorderCredit\Mapper\CreditMapperInterface' => 'WorkorderCredit\Mapper\Factory\CreditMapperFactory',
            'WorkorderCredit\Form\CreditForm' => 'WorkorderCredit\Form\Factory\CreditFormFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'workorder-credit-create' => array(
                'title' => 'Create Work Order Credit',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/work-order-credit/create',
                    'defaults' => array(
                        'controller' => 'WorkorderCredit\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'GetWorkorderCredit' => 'WorkorderCredit\View\Helper\Factory\GetWorkorderCreditFactory'
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