<?php
return array(
    'module' => array(
        'Subscription' => array(
            'name' => 'Subscription',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(
                    'subscription-index',
                    'subscription-view'
                ),
                'employee' => array(
                    'subscription-create',
                    'subscription-update',
                    'subscription-delete'
                ),
                'accountant' => array(),
                'administrator' => array(
                    'subscription-admin-index'
                )
            )
        )
    ),
    // controller
    'controllers' => array(
        'factories' => array()
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Subscription\Mapper\MysqlMapperInterface' => 'Subscription\Mapper\Factory\MysqlMapperFactory',
            'Subscription\Service\SubscriptionServiceInterface' => 'Subscription\Service\Factory\SubscriptionServiceFactory',
        )
    ),
    // routes
    'router' => array(
        'routes' => array(
            'subscription-admin-index' => array(
                'title' => 'Subscriptions',
                'pageTitle' => 'Subscriptions',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'admin',
                'activeSubMenuItem' => 'subscription-admin-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/subscription',
                    'defaults' => array(
                        'controller' => 'Product\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-index' => array(
                'title' => 'Subscriptions',
                'pageTitle' => 'Subscriptions',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription',
                    'defaults' => array(
                        'controller' => 'Product\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-create' => array(
                'title' => 'New Subscription',
                'pageTitle' => 'New Subscription',
                'pageSubTitle' => '',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription/create',
                    'defaults' => array(
                        'controller' => 'Product\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-update' => array(
                'title' => 'Edit Subscription',
                'pageTitle' => 'Edit Subscription',
                'pageSubTitle' => '',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription/update/[:subscriptionId]',
                    'defaults' => array(
                        'controller' => 'Product\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-delete' => array(
                'title' => 'Delete Subscription',
                'pageTitle' => 'Delete Subscription',
                'pageSubTitle' => '',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription/delete/[:subscriptionId]',
                    'defaults' => array(
                        'controller' => 'Product\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-view' => array(
                'title' => 'View Subscription',
                'pageTitle' => 'View Subscription',
                'pageSubTitle' => '',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription/view/[:subscriptionId]',
                    'defaults' => array(
                        'controller' => 'Product\Controller\IndexController',
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
            
        )
    ),
    // menu
    'menu' => array(
        'default' => array(
    
        )
    )
);