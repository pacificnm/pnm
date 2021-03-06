<?php
return array(
    'module' => array(
        'SubscriptionHost' => array(
            'name' => 'SubscriptionHost',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'subscription-host-delete',
                    'subscription-host-create'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    // controller
    'controllers' => array(
        'factories' => array(
            'SubscriptionHost\Controller\DeleteController' => 'SubscriptionHost\Controller\Factory\DeleteControllerFactory',
            'SubscriptionHost\Controller\CreateController' => 'SubscriptionHost\Controller\Factory\CreateControllerFactory',
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'SubscriptionHost\Service\SubscriptionHostServiceInterface' => 'SubscriptionHost\Service\Factory\SubscriptionHostServiceFactory',
            'SubscriptionHost\Mapper\MysqlMapperInterface' => 'SubscriptionHost\Mapper\Factory\MysqlMapperFactory',
            'SubscriptionHost\Listener\SubscriptionHostListener' => 'SubscriptionHost\Listener\Factory\SubscriptionHostListenerFactory',
            'SubscriptionHost\Form\SubscriptionHostForm' => 'SubscriptionHost\Form\Factory\SubscriptionHostFormFactory',
        )
    ),
    // routes
    'router' => array(
        'routes' => array(
            'subscription-host-create' => array(
                'title' => 'Subscription Host',
                'pageTitle' => 'Subscription Host',
                'pageSubTitle' => 'Create',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription/[:subscriptionId]/host/create/[:subscriptionHostId]',
                    'defaults' => array(
                        'controller' => 'SubscriptionHost\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-host-delete' => array(
                'title' => 'Subscription Host',
                'pageTitle' => 'Subscription Host',
                'pageSubTitle' => 'Delete',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription/[:subscriptionId]/host/delete/[:subscriptionHostId]',
                    'defaults' => array(
                        'controller' => 'SubscriptionHost\Controller\DeleteController',
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
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'GetSubscriptionHosts' => 'SubscriptionHost\View\Helper\Factory\GetSubscriptionHostsFactory'
        )
    ),
    // navigation
    'navigation' => array(
        'default' => array(
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
                                                'route' => 'subscription-host-delete',
                                                'resource' => 'subscription-host-delete',
                                                'useRouteMatch' => true,
                                            ),
                                            array(
                                                'label' => 'New',
                                                'route' => 'subscription-host-create',
                                                'resource' => 'subscription-host-create',
                                                'useRouteMatch' => true,
                                            ),
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
                'employee' => array(
                    'subscription-host-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    )
);