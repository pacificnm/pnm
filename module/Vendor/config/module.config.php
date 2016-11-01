<?php
return array(
    'module' => array(
        'Vendor' => array(
            'name' => 'Vendor',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(
                    'vendor-index',
                    'vendor-create',
                    'vendor-delete',
                    'vendor-update',
                    'vendor-view'
                ),
                'administrator' => array()
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Vendor\Controller\Create' => 'Vendor\Controller\Factory\CreateControllerFactory',
            'Vendor\Controller\Delete' => 'Vendor\Controller\Factory\DeleteControllerFactory',
            'Vendor\Controller\Index' => 'Vendor\Controller\Factory\IndexControllerFactory',
            'Vendor\Controller\Update' => 'Vendor\Controller\Factory\UpdateControllerFactory',
            'Vendor\Controller\View' => 'Vendor\Controller\Factory\ViewControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Vendor\Service\VendorServiceInterface' => 'Vendor\Service\Factory\VendorServiceFactory',
            'Vendor\Mapper\VendorMapperInterface' => 'Vendor\Mapper\Factory\VendorMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            
            'vendor-index' => array(
                'title' => 'Vendors',
                'type' => 'segment',
                'options' => array(
                    'route' => '/vendor',
                    'defaults' => array(
                        'controller' => 'Vendor\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'vendor-create' => array(
                'title' => 'New Vendor',
                'type' => 'segment',
                'options' => array(
                    'route' => '/vendor/create',
                    'defaults' => array(
                        'controller' => 'Vendor\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'vendor-delete' => array(
                'title' => 'Delete Vendor',
                'type' => 'segment',
                'options' => array(
                    'route' => '/vendor/delete/[:vendorId]',
                    'defaults' => array(
                        'controller' => 'Vendor\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'vendor-update' => array(
                'title' => 'Edit Vendor',
                'type' => 'segment',
                'options' => array(
                    'route' => '/vendor/update/[:vendorId]',
                    'defaults' => array(
                        'controller' => 'Vendor\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'vendor-view' => array(
                'title' => 'View Vendor',
                'type' => 'segment',
                'options' => array(
                    'route' => '/vendor/view/[:vendorId]',
                    'defaults' => array(
                        'controller' => 'Vendor\Controller\View',
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
                        'label' => 'Vendors',
                        'route' => 'vendor-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New',
                                'route' => 'vendor-create',
                                'useRouteMatch' => true,
                            ),
                            array(
                                'label' => 'View',
                                'route' => 'vendor-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit',
                                        'route' => 'vendor-update',
                                        'useRouteMatch' => true,
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'vendor-delete',
                                        'useRouteMatch' => true,
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
                    'label' => 'Vendors',
                    'icon' => 'fa fa-truck',
                    'route' => 'vendor-index',
                    'resource' => 'vendor-index',
                    'order' => 3
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