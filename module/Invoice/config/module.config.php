<?php
return array(
    'Invoice' => array(
        'name' => 'Invoice',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'invoice-list',
                'invoice-create',
                'invoice-delete',
                'invoice-print',
                'invoice-update',
                'invoice-view',
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Invoice\Controller\Create' => 'Invoice\Controller\Factory\CreateControllerFactory',
            'Invoice\Controller\Delete' => 'Invoice\Controller\Factory\DeleteControllerFactory',
            'Invoice\Controller\Index' => 'Invoice\Controller\Factory\IndexControllerFactory',
            'Invoice\Controller\Print' => 'Invoice\Controller\Factory\PrintControllerFactory',
            'Invoice\Controller\Update' => 'Invoice\Controller\Factory\UpdateControllerFactory',
            'Invoice\Controller\View' => 'Invoice\Controller\Factory\ViewControllerFactory',
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Invoice\Service\InvoiceServiceInterface' => 'Invoice\Service\Factory\InvoiceServiceFactory',
            'Invoice\Mapper\InvoiceMapperInterface' => 'Invoice\Mapper\Factory\InvoiceMapperFactory'
        )
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
            ),
            'invoice-delete' => array(
                'title' => 'Delete Invoice',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/delete/[:invoiceId]',
                    'defaults' => array(
                        'controller' => 'Invoice\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-print' => array(
                'title' => 'Print Invoice',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/print/[:invoiceId]',
                    'defaults' => array(
                        'controller' => 'Invoice\Controller\Print',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-update' => array(
                'title' => 'Edit Invoice',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/update/[:invoiceId]',
                    'defaults' => array(
                        'controller' => 'Invoice\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-view' => array(
                'title' => 'View Invoice',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/view/[:invoiceId]',
                    'defaults' => array(
                        'controller' => 'Invoice\Controller\View',
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