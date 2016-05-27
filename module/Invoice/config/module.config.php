<?php
return array(
    
    'Invoice' => array(
        'name' => 'Invoice',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'invoice-list'
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Invoice\Controller\Index' => 'Invoice\Controller\Factory\IndexControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array()
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'invoice-list' => array(
                'title' => 'Client Invoices',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice',
                    'defaults' => array(
                        'controller' => 'Invoice\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-create' => array(
                'title' => 'Create Invoice',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/create',
                    'defaults' => array(
                        'controller' => 'Invoice\Controller\Create',
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