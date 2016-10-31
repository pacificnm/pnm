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
            )
        )
        
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    // navigation
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Accounting',
                'route' => 'account-home',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Bills',
                        'route' => 'vendor-bill-index',
                        'useRouteMatch' => true
                    ),
                    array(
                        'label' => 'Vendors',
                        'route' => 'vendor-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'View',
                                'route' => 'vendor-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    
                                    array(
                                        'label' => 'Bill',
                                        'route' => 'vendor-bill-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Payment',
                                                'route' => 'vendor-payment-create',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'View Payment',
                                                'route' => 'vendor-payment-view',
                                                'useRouteMatch' => true
                                            )
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            )
        )
    ),
    'menu' => array(
        'accounting' => array(
            array()
        )
        
    ),
    // acl
    'acl' => array(
        'default' => array(
            array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    )
);