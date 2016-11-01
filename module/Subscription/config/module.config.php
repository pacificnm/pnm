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
        'factories' => array(
            'Subscription\Controller\AdminController' => 'Subscription\Controller\Factory\AdminControllerFactory'
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Subscription\Mapper\MysqlMapperInterface' => 'Subscription\Mapper\Factory\MysqlMapperFactory',
            'Subscription\Service\SubscriptionServiceInterface' => 'Subscription\Service\Factory\SubscriptionServiceFactory'
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
                        'controller' => 'Subscription\Controller\AdminController',
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
            )
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
                        'label' => 'Subscriptions',
                        'route' => 'subscription-admin-index',
                        'resource' => 'subscription-admin-index',
                        'useRouteMatch' => true
                    )
                )
            ),
            array(
                'label' => 'Clients',
                'route' => 'client-index',
                'resource' => 'client-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'View',
                        'route' => 'client-view',
                        'resource' => 'client-view',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Subscriptions',
                                'route' => 'subscription-index',
                                'resource' => 'subscription-index',
                                'useRouteMatch' => true
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
                    'label' => 'Subscriptions',
                    'icon' => 'fa fa-line-chart',
                    'route' => 'subscription-admin-index',
                    'resource' => 'subscription-admin-index',
                    'order' => 13
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
    )
);