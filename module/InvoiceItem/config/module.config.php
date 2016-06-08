<?php
return array(
    'InvoiceItem' => array(
        'name' => 'InvoiceItem',
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
        'factories' => array()
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'InvoiceItem\Mapper\ItemMapperInterface' => 'InvoiceItem\Mapper\Factory\ItemMapperFactory',
            'InvoiceItem\Service\ItemServiceInterface' => 'InvoiceItem\Service\Factory\ItemServiceFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array()
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);