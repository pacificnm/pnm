<?php
return array(
    'module' => array(
        'VendorBill' => array(
            'name' => 'VendorBill',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(
                    'vendor-bill-index',
                    'vendor-bill-create',
                    'vendor-bill-delete',
                    'vendor-bill-update',
                    'vendor-bill-view'
                ),
                'administrator' => array()
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'VendorBill\Controller\Create' => 'VendorBill\Controller\Factory\CreateControllerFactory',
            'VendorBill\Controller\Delete' => 'VendorBill\Controller\Factory\DeleteControllerFactory',
            'VendorBill\Controller\Index' => 'VendorBill\Controller\Factory\IndexControllerFactory',
            'VendorBill\Controller\Update' => 'VendorBill\Controller\Factory\UpdateControllerFactory',
            'VendorBill\Controller\View' => 'VendorBill\Controller\Factory\ViewControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'VendorBill\Service\BillServiceInterface' => 'VendorBill\Service\Factory\BillServiceFactory',
            'VendorBill\Mapper\MysqlMapperInterface' => 'VendorBill\Mapper\Factory\MysqlMapperFactory',
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            
            'vendor-bill-index' => array(
                'title' => 'Vendor Bills',
                'type' => 'segment',
                'options' => array(
                    'route' => '/vendor/bill',
                    'defaults' => array(
                        'controller' => 'VendorBill\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'vendor-bill-create' => array(
                'title' => 'Create Vendor Bill',
                'type' => 'segment',
                'options' => array(
                    'route' => '/vendor/[:vendorId]/bill/create',
                    'defaults' => array(
                        'controller' => 'VendorBill\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'vendor-bill-delete' => array(
                'title' => 'Delete Vendor Bill',
                'type' => 'segment',
                'options' => array(
                    'route' => '/vendor/[:vendorId]/bill/[:vendorBillId]/delete',
                    'defaults' => array(
                        'controller' => 'VendorBill\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'vendor-bill-update' => array(
                'title' => 'Edit Vendor Bill',
                'type' => 'segment',
                'options' => array(
                    'route' => '/vendor/[:vendorId]/bill/[:vendorBillId]/update',
                    'defaults' => array(
                        'controller' => 'VendorBill\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'vendor-bill-view' => array(
                'title' => 'View Vendor Bill',
                'type' => 'segment',
                'options' => array(
                    'route' => '/vendor/[:vendorId]/bill/[:vendorBillId]/view',
                    'defaults' => array(
                        'controller' => 'VendorBill\Controller\View',
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
                                        'label' => 'New Bill',
                                        'route' => 'vendor-bill-create',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Bill',
                                        'route' => 'vendor-bill-view',
                                        'useRouteMatch' => true
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
        'default' => array(
            'accounting' => array(
                array(
                    'label' => 'Bills',
                    'icon' => 'fa fa-dollar',
                    'route' => 'vendor-bill-index',
                    'resource' => 'vendor-bill-index',
                    'order' => 4
                )
            )
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