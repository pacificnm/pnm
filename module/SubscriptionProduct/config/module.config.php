<?php
return array(
    'module' => array(
        'SubscriptionProduct' => array(
            'name' => 'SubscriptionProduct',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(
                    'subscription-product-index',
                    'subscription-product-view'
                ),
                'employee' => array(
                    'subscription-product-create',
                    'subscription-product-update',
                    'subscription-product-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    // controller
    'controllers' => array(
        'factories' => array(
            'SubscriptionProduct\Controller\CreateController' => 'SubscriptionProduct\Controller\Factory\CreateControllerFactory',
            'SubscriptionProduct\Controller\DeleteController' => 'SubscriptionProduct\Controller\Factory\DeleteControllerFactory',
            'SubscriptionProduct\Controller\IndexController' => 'SubscriptionProduct\Controller\Factory\IndexControllerFactory',
            'SubscriptionProduct\Controller\UpdateController' => 'SubscriptionProduct\Controller\Factory\UpdateControllerFactory',
            'SubscriptionProduct\Controller\ViewController' => 'SubscriptionProduct\Controller\Factory\ViewControllerFactory'
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'SubscriptionProduct\Service\SubscriptionProductServiceInterface' => 'SubscriptionProduct\Service\Factory\SubscriptionProductServiceFactory',
            'SubscriptionProduct\Mapper\MysqlMapperInterface' => 'SubscriptionProduct\Mapper\Factory\MysqlMapperFactory',
            'SubscriptionProduct\Form\SubscriptionProductForm' => 'SubscriptionProduct\Form\Factory\SubscriptionProductFormFactory',
            'SubscriptionProduct\Listener\SubscriptionProductListener' => 'SubscriptionProduct\Listener\Factory\SubscriptionProductListenerFactory',
        )
    ),
    // routes
    'router' => array(
        'routes' => array(
            'subscription-product-index' => array(
                'title' => 'Subscription Products',
                'pageTitle' => 'Subscription Products',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-product-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription-product',
                    'defaults' => array(
                        'controller' => 'SubscriptionProduct\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-product-create' => array(
                'title' => 'Subscription Products',
                'pageTitle' => 'Subscription Products',
                'pageSubTitle' => 'New',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-product-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription/[:subscriptionId]/product/create',
                    'defaults' => array(
                        'controller' => 'SubscriptionProduct\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-product-update' => array(
                'title' => 'Subscription Products',
                'pageTitle' => 'Subscription Products',
                'pageSubTitle' => 'Edit',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-product-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription-product/update/[:subscriptionProductId]',
                    'defaults' => array(
                        'controller' => 'SubscriptionProduct\Controller\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-product-delete' => array(
                'title' => 'Subscription Products',
                'pageTitle' => 'Subscription Products',
                'pageSubTitle' => 'Delete',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-product-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription-product/delete/[:subscriptionProductId]',
                    'defaults' => array(
                        'controller' => 'SubscriptionProduct\Controller\DeleteController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-product-view' => array(
                'title' => 'Subscription Products',
                'pageTitle' => 'Subscription Products',
                'pageSubTitle' => 'View',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-product-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription-product/view/[:subscriptionProductId]',
                    'defaults' => array(
                        'controller' => 'SubscriptionProduct\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        )
    ),
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'GetSubscriptionProducts' => 'SubscriptionProduct\View\Helper\Factory\GetSubscriptionProductsFactory'
        )
    ),
    // navigation
    'navigation' => array(
        'default' => array()
    ),
    // menu
    'menu' => array(
        'default' => array()
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