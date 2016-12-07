<?php
return array(
    'module' => array(
        'SubscriptionUser' => array(
            'name' => 'SubscriptionUser',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'subscription-user-delete',
                    'subscription-user-create'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    // controller
    'controllers' => array(
        'factories' => array(
            'SubscriptionUser\Controller\DeleteController' => 'SubscriptionUser\Controller\Factory\DeleteControllerFactory',
            'SubscriptionUser\Controller\CreateController' => 'SubscriptionUser\Controller\Factory\CreateControllerFactory',
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'SubscriptionUser\Service\SubscriptionUserServiceInterface' => 'SubscriptionUser\Service\Factory\SubscriptionUserServiceFactory',
            'SubscriptionUser\Mapper\MysqlMapperInterface' => 'SubscriptionUser\Mapper\Factory\MysqlMapperFactory',
            'SubscriptionUser\Form\SubscriptionUserForm' => 'SubscriptionUser\Form\Factory\SubscriptionUserFormFactory',
        )
    ),
    // routes
    'router' => array(
        'routes' => array(
            'subscription-user-create' => array(
                'title' => 'Subscription User',
                'pageTitle' => 'Subscription User',
                'pageSubTitle' => 'Create',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription/[:subscriptionId]/user/create/[:subscriptionUserId]',
                    'defaults' => array(
                        'controller' => 'SubscriptionUser\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'subscription-user-delete' => array(
                'title' => 'Subscription User',
                'pageTitle' => 'Subscription User',
                'pageSubTitle' => 'Delete',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'subscription-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/subscription/[:subscriptionId]/user/delete/[:subscriptionUserId]',
                    'defaults' => array(
                        'controller' => 'SubscriptionUser\Controller\DeleteController',
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
            'GetSubscriptionUsers' => 'SubscriptionUser\View\Helper\Factory\GetSubscriptionUsersFactory'
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
                                                'route' => 'subscription-user-delete',
                                                'resource' => 'subscription-user-delete',
                                                'useRouteMatch' => true,
                                            ),
                                            array(
                                                'label' => 'New',
                                                'route' => 'subscription-user-create',
                                                'resource' => 'subscription-user-create',
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
                    'subscription-user-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    )
);