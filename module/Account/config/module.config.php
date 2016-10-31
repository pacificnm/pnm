<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
return array(
    'module' => array(
        'Account' => array(
            'name' => 'Account',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(
                    'account-home',
                    'account-index',
                    'account-create',
                    'account-update',
                    'account-delete',
                    'account-view'
                ),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Account\Controller\IndexController' => 'Account\Controller\Factory\IndexControllerFactory',
            'Account\Controller\CreateController' => 'Account\Controller\Factory\CreateControllerFactory',
            'Account\Controller\DeleteController' => 'Account\Controller\Factory\DeleteControllerFactory',
            'Account\Controller\UpdateController' => 'Account\Controller\Factory\UpdateControllerFactory',
            'Account\Controller\ViewController' => 'Account\Controller\Factory\ViewControllerFactory',
            'Account\Controller\HomeController' => 'Account\Controller\Factory\HomeControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Account\Service\AccountServiceInterface' => 'Account\Service\Factory\AccountServiceFactory',
            'Account\Mapper\AccountMapperInterface' => 'Account\Mapper\Factory\AccountMapperFactory',
            'Account\Form\AccountForm' => 'Account\Form\Factory\AccountFormFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'account-index' => array(
                'title' => 'Accounts',
                'type' => 'literal',
                'options' => array(
                    'route' => '/account',
                    'defaults' => array(
                        'controller' => 'Account\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            
            'account-create' => array(
                'title' => 'Create Account',
                'type' => 'literal',
                'options' => array(
                    'route' => '/account/create',
                    'defaults' => array(
                        'controller' => 'Account\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            
            'account-delete' => array(
                'title' => 'Delete Account',
                'type' => 'segment',
                'options' => array(
                    'route' => '/account/delete/[:accountId]',
                    'defaults' => array(
                        'controller' => 'Account\Controller\DeleteController',
                        'action' => 'index'
                    )
                )
            ),
            
            'account-update' => array(
                'title' => 'Edit Account',
                'type' => 'segment',
                'options' => array(
                    'route' => '/account/update/[:accountId]',
                    'defaults' => array(
                        'controller' => 'Account\Controller\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'account-view' => array(
                'title' => 'View Account',
                'type' => 'segment',
                'options' => array(
                    'route' => '/account/view/[:accountId]',
                    'defaults' => array(
                        'controller' => 'Account\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            ),
            'account-home' => array(
                'title' => 'Accounting',
                'type' => 'literal',
                'options' => array(
                    'route' => '/account/home',
                    'defaults' => array(
                        'controller' => 'Account\Controller\HomeController',
                        'action' => 'index'
                    )
                )
            ),
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'invokables' => array(
            'AccountAsideMenu' => 'Account\View\Helper\AccountAsideMenu'
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
                'label' => 'Accounting',
                'route' => 'account-home',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Accounts',
                        'route' => 'account-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New Account',
                                'route' => 'account-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'View Account',
                                'route' => 'account-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit',
                                        'route' => 'account-update',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'account-delete',
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
    'menu' => array(
        'accounting' => array(
            array(
                
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
    ),
);