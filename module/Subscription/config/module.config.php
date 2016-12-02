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
            'Subscription\Controller\AdminController' => 'Subscription\Controller\Factory\AdminControllerFactory',
            'Subscription\Controller\IndexController' => 'Subscription\Controller\Factory\IndexControllerFactory',
            'Subscription\Controller\CreateController' => 'Subscription\Controller\Factory\CreateControllerFactory',
            'Subscription\Controller\ViewController' => 'Subscription\Controller\Factory\ViewControllerFactory',
            'Subscription\Controller\DeleteController' => 'Subscription\Controller\Factory\DeleteControllerFactory',
            'Subscription\Controller\UpdateController' => 'Subscription\Controller\Factory\UpdateControllerFactory'
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Subscription\Mapper\MysqlMapperInterface' => 'Subscription\Mapper\Factory\MysqlMapperFactory',
            'Subscription\Service\SubscriptionServiceInterface' => 'Subscription\Service\Factory\SubscriptionServiceFactory',
            'Subscription\Form\SubscriptionForm' => 'Subscription\Form\Factory\SubscriptionFormFactory'
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
                        'controller' => 'Subscription\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-create' => array(
                'title' => 'Subscription',
                'pageTitle' => 'Subscription',
                'pageSubTitle' => 'New',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription/create',
                    'defaults' => array(
                        'controller' => 'Subscription\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-update' => array(
                'title' => 'Subscription',
                'pageTitle' => 'Subscription',
                'pageSubTitle' => 'Edit',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription/update/[:subscriptionId]',
                    'defaults' => array(
                        'controller' => 'Subscription\Controller\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-delete' => array(
                'title' => 'Subscription',
                'pageTitle' => 'Subscription',
                'pageSubTitle' => 'Delete',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription/delete/[:subscriptionId]',
                    'defaults' => array(
                        'controller' => 'Subscription\Controller\DeleteController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-view' => array(
                'title' => 'Subscription',
                'pageTitle' => 'Subscription',
                'pageSubTitle' => 'View',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription/view/[:subscriptionId]',
                    'defaults' => array(
                        'controller' => 'Subscription\Controller\ViewController',
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
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'View',
                                        'route' => 'subscription-view',
                                        'resource' => 'subscription-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Delete',
                                                'route' => 'subscription-delete',
                                                'resource' => 'subscription-delete',
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
            ),
            'client' => array(
                array(
                    'label' => 'Subscriptions',
                    'icon' => 'fa fa-line-chart',
                    'route' => 'subscription-index',
                    'resource' => 'subscription-index',
                    'order' => 9,
                    'useRouteMatch' => true
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