<?php
return array(
    'InvoiceOption' => array(
        'name' => 'InvoiceOption',
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
                'InvoiceOption\Mapper\OptionMapperInterface' => 'InvoiceOption\Mapper\Factory\OptionMapperFactory',
                'InvoiceOption\Service\OptionServiceInterface' => 'InvoiceOption\Service\Factory\OptionServiceFactory'
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