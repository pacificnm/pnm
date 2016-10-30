<?php
return array(
    'module' => array(
        'Product' => array(
            'name' => 'Product',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'product-index',
                    'product-create',
                    'product-view',
                    'product-update',
                    'product-delete'
                )
            )
        )
    ),
    // controller
    'controllers' => array(
        'factories' => array(
            'Product\Controller\IndexController' => 'Product\Controller\Factory\IndexControllerFactory',
            'Product\Controller\CreateController' => 'Product\Controller\Factory\CreateControllerFactory',
            'Product\Controller\ViewController' => 'Product\Controller\Factory\ViewControllerFactory',
            'Product\Controller\UpdateController' => 'Product\Controller\Factory\UpdateControllerFactory',
            'Product\Controller\DeleteController' => 'Product\Controller\Factory\DeleteControllerFactory',
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Product\Mapper\MysqlMapperInterface' => 'Product\Mapper\Factory\MysqlMapperFactory',
            'Product\Service\ProductServiceInterface' => 'Product\Service\Factory\ProductServiceFactory'
        )
    ),
    // routes
    'router' => array(
        'routes' => array(
            'product-index' => array(
                'title' => 'Products',
                'pageTitle' => 'Products',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'product-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/product',
                    'defaults' => array(
                        'controller' => 'Product\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'product-create' => array(
                'title' => 'New Product',
                'pageTitle' => 'New Product',
                'pageSubTitle' => '',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'product-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/product/create',
                    'defaults' => array(
                        'controller' => 'Product\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'product-view' => array(
                'title' => 'View Product',
                'pageTitle' => 'View Product',
                'pageSubTitle' => '',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'product-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/product/view/[:productId]',
                    'defaults' => array(
                        'controller' => 'Product\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            ),
            'product-update' => array(
                'title' => 'Edit Product',
                'pageTitle' => 'Edit Product',
                'pageSubTitle' => '',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'product-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/product/update/[:productId]',
                    'defaults' => array(
                        'controller' => 'Product\Controller\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'product-delete' => array(
                'title' => 'Delete Product',
                'pageTitle' => 'Delete Product',
                'pageSubTitle' => '',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'product-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/product/delete/[:productId]',
                    'defaults' => array(
                        'controller' => 'Product\Controller\DeleteController',
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
                        'label' => 'Products',
                        'route' => 'product-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New',
                                'route' => 'product-create',
                                'useRouteMatch' => true,
                            ),
                            array(
                                'label' => 'View',
                                'route' => 'product-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit',
                                        'route' => 'product-update',
                                        'useRouteMatch' => true,
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'product-delete',
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
            
        )
    )
);