<?php
return array(
    'module' => array(
        'VendorPayment' => array(
            'name' => 'VendorPayment',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(
                    'vendor-payment-index',
                    'vendor-payment-create',
                    'vendor-payment-delete',
                    'vendor-payment-update',
                    'vendor-payment-view'
                ),
                'administrator' => array()
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'VendorPayment\Controller\Create' => 'VendorPayment\Controller\Factory\CreateControllerFactory',
            'VendorPayment\Controller\Delete' => 'VendorPayment\Controller\Factory\DeleteControllerFactory',
            'VendorPayment\Controller\Index' => 'VendorPayment\Controller\Factory\IndexControllerFactory',
            'VendorPayment\Controller\Update' => 'VendorPayment\Controller\Factory\UpdateControllerFactory',
            'VendorPayment\Controller\View' => 'VendorPayment\Controller\Factory\ViewControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'VendorPayment\Mapper\PaymentMapperInterface' => 'VendorPayment\Mapper\Factory\PaymentMapperFactory',
            'VendorPayment\Service\PaymentServiceInterface' => 'VendorPayment\Service\Factory\PaymentServiceFactory',
            'VendorPayment\Form\PaymentForm' => 'VendorPayment\Form\Factory\PaymentFormFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'vendor-payment-create' => array(
                'title' => 'Create Vendor Bill Payment',
                'type' => 'segment',
                'options' => array(
                    'route' => '/vendor/[:vendorId]/bill/[:vendorBillId]/payment',
                    'defaults' => array(
                        'controller' => 'VendorPayment\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'vendor-payment-view' => array(
                'title' => 'View Vendor Bill Payment',
                'type' => 'segment',
                'options' => array(
                    'route' => '/vendor/[:vendorId]/bill/[:vendorBillId]/payment/[:vendorPaymentId]',
                    'defaults' => array(
                        'controller' => 'VendorPayment\Controller\View',
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