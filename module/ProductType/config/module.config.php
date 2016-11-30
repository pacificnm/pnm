<?php
return array(
    'module' => array(
        'ProductType' => array(
            'name' => 'ProductType',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'product-type-index',
                    'product-type-create',
                    'product-type-view',
                    'product-type-update',
                    'product-type-delete'
                )
            )
        )
    ),
    // controller
    'controllers' => array(
        'factories' => array(
            'ProductType\Controller\IndexController' => 'ProductType\Controller\Factory\IndexControllerFactory',
            'ProductType\Controller\CreateController' => 'ProductType\Controller\Factory\CreateControllerFactory',
            'ProductType\Controller\ViewController' => 'ProductType\Controller\Factory\ViewControllerFactory',
            'ProductType\Controller\UpdateController' => 'ProductType\Controller\Factory\UpdateControllerFactory',
            'ProductType\Controller\DeleteController' => 'ProductType\Controller\Factory\DeleteControllerFactory',
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'ProductType\Mapper\MysqlMapperInterface' => 'ProductType\Mapper\Factory\MysqlMapperFactory',
            'ProductType\Service\ProductTypeServiceInterface' => 'ProductType\Service\Factory\ProductTypeServiceFactory',
        )
    ),
    // routes
    'router' => array(
        'routes' => array(
            'product-type-index' => array(
                'title' => 'Product Types',
                'pageTitle' => 'Product Types',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'product-type-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/product-type',
                    'defaults' => array(
                        'controller' => 'ProductType\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'product-type-create' => array(
                'title' => 'New Product Type',
                'pageTitle' => 'Product Type',
                'pageSubTitle' => 'New',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'product-type-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/product-type/create',
                    'defaults' => array(
                        'controller' => 'ProductType\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'product-type-view' => array(
                'title' => 'View Product Type',
                'pageTitle' => 'Product Type',
                'pageSubTitle' => 'View',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'product-type-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/product-type/view/[:productTypeId]',
                    'defaults' => array(
                        'controller' => 'ProductType\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            ),
            'product-type-update' => array(
                'title' => 'Product Type',
                'pageTitle' => 'Product Type',
                'pageSubTitle' => 'Edit',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'product-type-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/product-type/update/[:productTypeId]',
                    'defaults' => array(
                        'controller' => 'ProductType\Controller\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'product-type-delete' => array(
                'title' => 'Delete Product Type',
                'pageTitle' => 'Product Type',
                'pageSubTitle' => 'Delete',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'product-type-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/product-type/delete/[:productTypeId]',
                    'defaults' => array(
                        'controller' => 'ProductType\Controller\DeleteController',
                        'action' => 'index'
                    )
                )
            ),
        )
    ),
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        )
    ),
    // navigation
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Admin',
                'route' => 'admin-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Product Types',
                        'route' => 'product-type-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New',
                                'route' => 'product-type-create',
                                'useRouteMatch' => true,
                            ),
                            array(
                                'label' => 'View',
                                'route' => 'product-type-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit',
                                        'route' => 'product-type-update',
                                        'useRouteMatch' => true,
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'product-type-delete',
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
    // menu
    'menu' => array(
        'default' => array(
            'admin' => array(
                array(
                    'label' => 'Product Types',
                    'icon' => 'fa fa-shopping-cart',
                    'route' => 'product-type-index',
                    'resource' => 'product-type-index',
                    'order' => 12
                )
            )
        )
    )
);