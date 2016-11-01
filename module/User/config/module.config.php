<?php
return array(
    'module' => array(
        'User' => array(
            'name' => 'User',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    'user-profile',
                    'user-list',
                    'user-view'
                ),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'user-create',
                    'user-delete',
                    'user-update'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    // controllers
    'controllers' => array(
        'factories' => array(
            'User\Controller\Profile' => 'User\Controller\Factory\ProfileControllerFactory',
            'User\Controller\Create' => 'User\Controller\Factory\CreateControllerFactory',
            'User\Controller\Delete' => 'User\Controller\Factory\DeleteControllerFactory',
            'User\Controller\Index' => 'User\Controller\Factory\IndexControllerFactory',
            'User\Controller\Update' => 'User\Controller\Factory\UpdateControllerFactory',
            'User\Controller\View' => 'User\Controller\Factory\ViewControllerFactory'
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'User\Service\UserServiceInterface' => 'User\Service\Factory\UserServiceFactory',
            'User\Mapper\UserMapperInterface' => 'User\Mapper\Factory\UserMapperFactory',
            'User\Form\UserForm' => 'User\Form\Factory\UserFormFactory'
        )
    ),
    // router
    'router' => array(
        'routes' => array(
            'user-profile' => array(
                'type' => 'literal',
                'title' => 'My Profile',
                'pageTitle' => 'My Profile',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'user',
                'activeSubMenuItem' => 'user-profile',
                'options' => array(
                    'route' => '/user/profile',
                    'defaults' => array(
                        'controller' => 'User\Controller\Profile',
                        'action' => 'index'
                    )
                )
            ),
            
            'user-list' => array(
                'title' => 'Client Users',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/user',
                    'defaults' => array(
                        'controller' => 'User\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'user-create' => array(
                'title' => 'Create User',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/user/create',
                    'defaults' => array(
                        'controller' => 'User\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'user-delete' => array(
                'title' => 'Delete User',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/user/delete/[:userId]',
                    'defaults' => array(
                        'controller' => 'User\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'user-update' => array(
                'title' => 'Edit User',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/user/update/[:userId]',
                    'defaults' => array(
                        'controller' => 'User\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'user-view' => array(
                'title' => 'View User',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/user/view/[:userId]',
                    'defaults' => array(
                        'controller' => 'User\Controller\View',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    // view helpers
    'view_helpers' => array(
        'invokables' => array(
            'UserAsideMenu' => 'User\View\Helper\UserAsideMenu'
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
                'label' => 'Clients',
                'route' => 'client-index',
                'resource' => 'client-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'View Client',
                        'route' => 'client-view',
                        'resource' => 'client-view',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Users',
                                'route' => 'user-list',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Create User',
                                        'route' => 'user-create',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'View User',
                                        'route' => 'user-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Edit User',
                                                'route' => 'user-update',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'Delete User',
                                                'route' => 'user-delete',
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