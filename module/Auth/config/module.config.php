<?php
use Auth\View\Helper\AuthNavBar;
return array(
    'module' => array(
        'Auth' => array(
            'name' => 'Auth',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'auth-index',
                    'auth-create',
                    'auth-delete',
                    'auth-update',
                    'auth-view',
                    'auth-password'
                )
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Auth\Controller\SignIn' => 'Auth\Controller\Factory\SignInControllerFactory',
            'Auth\Controller\SignOut' => 'Auth\Controller\Factory\SignOutControllerFactory',
            'Auth\Controller\Index' => 'Auth\Controller\Factory\IndexControllerFactory',
            'Auth\Controller\Create' => 'Auth\Controller\Factory\CreateControllerFactory',
            'Auth\Controller\Delete' => 'Auth\Controller\Factory\DeleteControllerFactory',
            'Auth\Controller\Update' => 'Auth\Controller\Factory\UpdateControllerFactory',
            'Auth\Controller\View' => 'Auth\Controller\Factory\ViewControllerFactory',
            'Auth\Controller\Password' => 'Auth\Controller\Factory\PasswordControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Auth\Adapter\AuthAdapter' => 'Auth\Adapter\Factory\AuthAdapterFactory',
            'Auth\Service\AuthServiceInterface' => 'Auth\Service\Factory\AuthServiceFactory',
            'Auth\Mapper\MysqlMapperInterface' => 'Auth\Mapper\Factory\MysqlMapperFactory',
            'Auth\Adapter\OAuth2Adapter' => 'Auth\Adapter\Factory\OAuth2AdapterFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'auth-sign-in' => array(
                'title' => 'Sign In',
                'type' => 'literal',
                'options' => array(
                    'route' => '/sign-in',
                    'defaults' => array(
                        'controller' => 'Auth\Controller\SignIn',
                        'action' => 'index'
                    )
                )
            ),
            
            'auth-sign-out' => array(
                'title' => 'Sign Out',
                'type' => 'literal',
                'options' => array(
                    'route' => '/sign-out',
                    'defaults' => array(
                        'controller' => 'Auth\Controller\SignOut',
                        'action' => 'index'
                    )
                )
            ),
            'auth-index' => array(
                'title' => 'List Auth',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/auth',
                    'defaults' => array(
                        'controller' => 'Auth\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'auth-create' => array(
                'title' => 'Create Auth',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/auth/create',
                    'defaults' => array(
                        'controller' => 'Auth\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'auth-update' => array(
                'title' => 'Edit Auth',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/auth/update/[:authId]',
                    'defaults' => array(
                        'controller' => 'Auth\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'auth-view' => array(
                'title' => 'View Auth',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/auth/view/[:authId]',
                    'defaults' => array(
                        'controller' => 'Auth\Controller\View',
                        'action' => 'index'
                    )
                )
            ),
            'auth-delete' => array(
                'title' => 'Delete Auth',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/auth/delete/[:authId]',
                    'defaults' => array(
                        'controller' => 'Auth\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'auth-password' => array(
                'title' => 'Reset Password',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/auth/password/[:authId]',
                    'defaults' => array(
                        'controller' => 'Auth\Controller\Password',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'invokables' => array(
            'AuthNavBar' => 'Auth\View\Helper\AuthNavBar',
            'AuthAside' => 'Auth\View\Helper\AuthAside'
        ),
        'factories' => array(
            'GetEmployeeAuthDetails' => 'Auth\View\Helper\Factory\GetEmployeeAuthDetailsFactory'
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
                'label' => 'Admin',
                'route' => 'admin-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Auth',
                        'route' => 'auth-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New',
                                'route' => 'auth-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'View',
                                'route' => 'auth-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Update',
                                        'route' => 'auth-update',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'auth-delete',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Reset Password',
                                        'route' => 'auth-password',
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
            'admin' => array(
                array(
                    'label' => 'Auth',
                    'icon' => 'fa fa-lock',
                    'route' => 'auth-index',
                    'resource' => 'auth-index',
                    'order' => 1
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
                'administrator' => array(
                    'auth-index',
                    'auth-create',
                    'auth-delete',
                    'auth-update',
                    'auth-view',
                    'auth-password'
                )
            )
        )
    )
);