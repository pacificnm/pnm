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
            'administrator' => array(
                'invoice-option-index',
                'invoice-option-update' 
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'InvoiceOption\Controller\Index' => 'InvoiceOption\Controller\Factory\IndexControllerFactory',
            'InvoiceOption\Controller\Update' => 'InvoiceOption\Controller\Factory\UpdateControllerFactory'
        )
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
        'routes' => array(
            'invoice-option-index' => array(
                'title' => 'Payment Options',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/invoice-options',
                    'defaults' => array(
                        'controller' => 'InvoiceOption\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-option-update' => array(
                'title' => 'Payment Options',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/invoice-options/update',
                    'defaults' => array(
                        'controller' => 'InvoiceOption\Controller\Update',
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