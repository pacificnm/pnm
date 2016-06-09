<?php
return array(
    'InvoiceItem' => array(
        'name' => 'InvoiceItem',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'invoice-item-create',
                'invoice-item-delete'
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'InvoiceItem\Controller\Create' => 'InvoiceItem\Controller\Factory\CreateControllerFactory',
            'InvoiceItem\Controller\Delete' => 'InvoiceItem\Controller\Factory\DeleteControllerFactory'
        )
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
        'routes' => array(
            'invoice-item-create' => array(
                'title' => 'Create Invoice Item',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/[:invoiceId]/invoice-item/create',
                    'defaults' => array(
                        'controller' => 'InvoiceItem\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-item-delete' => array(
                'title' => 'Delete Invoice Item',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/[:invoiceId]/invoice-item/delete/[:invoiceItemId]',
                    'defaults' => array(
                        'controller' => 'InvoiceItem\Controller\Delete',
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