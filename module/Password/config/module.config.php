<?php
return array(
    'module' => array(
        'Password' => array(
            'name' => 'Password',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    'password-list',
                    'password-view'
                ),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    
                    'password-create',
                    'password-delete',
                    'password-update'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Password\Controller\Create' => 'Password\Controller\Factory\CreateControllerFactory',
            'Password\Controller\Delete' => 'Password\Controller\Factory\DeleteControllerFactory',
            'Password\Controller\Index' => 'Password\Controller\Factory\IndexControllerFactory',
            'Password\Controller\Update' => 'Password\Controller\Factory\UpdateControllerFactory',
            'Password\Controller\View' => 'Password\Controller\Factory\ViewControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Password\Mapper\PasswordMapperInterface' => 'Password\Mapper\Factory\PasswordMapperFactory',
            'Password\Service\PasswordServiceInterface' => 'Password\Service\Factory\PasswordServiceFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'password-list' => array(
                'title' => 'Client Passwords',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/password',
                    'defaults' => array(
                        'controller' => 'Password\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'password-create' => array(
                'title' => 'Create Password',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/password/create',
                    'defaults' => array(
                        'controller' => 'Password\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'password-delete' => array(
                'title' => 'Delete Password',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/password/delete/[:passwordId]',
                    'defaults' => array(
                        'controller' => 'Password\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'password-update' => array(
                'title' => 'Edit Password',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/password/update/[:passwordId]',
                    'defaults' => array(
                        'controller' => 'Password\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'password-view' => array(
                'title' => 'View Password',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/password/view/[:passwordId]',
                    'defaults' => array(
                        'controller' => 'Password\Controller\View',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'Decrypt' => 'Password\View\Helper\Factory\DecryptFactory'
        ),
        'invokables' => array()
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
                                'label' => 'Passwords',
                                'route' => 'password-list',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'View Password',
                                        'route' => 'password-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Edit Password',
                                                'route' => 'password-update',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'Delete Password',
                                                'route' => 'password-delete',
                                                'useRouteMatch' => true
                                            )
                                        )
                                    ),
                                    array(
                                        'label' => 'Create Password',
                                        'route' => 'password-create',
                                        'useRouteMatch' => true
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
            array(
                'client' => array(
                    'title' => 'Client',
                    'icon' => '',
                    'route' => 'client-index',
                    'submenu' => array(
                        array(
                            'password' => array(
                                'title' => 'Passwords',
                                'icon' => 'fa fa-lock',
                                'route' => 'password-index'
                            )
                        )
                        
                    )
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