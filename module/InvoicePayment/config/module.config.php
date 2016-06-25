<?php
return array(
    'module' => array(
        'InvoicePayment' => array(
            'name' => 'InvoicePayment',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(
                    'invoice-payment-create',
                    'invoice-payment-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'InvoicePayment\Controller\Create' => 'InvoicePayment\Controller\Factory\CreateControllerFactory',
            'InvoicePayment\Controller\Delete' => 'InvoicePayment\Controller\Factory\DeleteControllerFactory',
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'InvoicePayment\Service\PaymentServiceInterface' => 'InvoicePayment\Service\Factory\PaymentServiceFactory',
            'InvoicePayment\Mapper\PaymentMapperInterface' => 'InvoicePayment\Mapper\Factory\PaymentMapperFactory',
            'InvoicePayment\Form\PaymentForm' => 'InvoicePayment\Form\Factory\PaymentFormFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'invoice-payment-index' => array(
                'title' => 'Client Invoices',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/invoice-payment',
                    'defaults' => array(
                        'controller' => 'InvoicePayment\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-payment-create' => array(
                'title' => 'Create Invoice Payment',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/[:invoiceId]/invoice-payment/create',
                    'defaults' => array(
                        'controller' => 'InvoicePayment\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-payment-delete' => array(
                'title' => 'Delete Invoice',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/invoice/[:invoiceId]/delete/[:invoicePaymentId]',
                    'defaults' => array(
                        'controller' => 'InvoicePayment\Controller\Delete',
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