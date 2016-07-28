<?php
return array(
    'module' => array(
        'Application' => array(
            'name' => 'Application',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    0 => 'home',
                    1 => 'keep-alive',
                ),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(),
            ),
        ),
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\\Mvc\\Router\\Http\\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\IndexController',
                        'action' => 'index',
                    ),
                ),
            ),
            'keep-alive' => array(
                'type' => 'Zend\\Mvc\\Router\\Http\\Literal',
                'options' => array(
                    'route' => '/keep-alive',
                    'defaults' => array(
                        'controller' => 'Application\\Controller\\KeepAliveController',
                        'action' => 'index',
                    ),
                ),
            ),
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            0 => 'Zend\\Cache\\Service\\StorageCacheAbstractServiceFactory',
            1 => 'Zend\\Log\\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\\Mvc\\Service\\TranslatorServiceFactory',
            'navigation' => 'Zend\\Navigation\\Service\\DefaultNavigationFactory',
            'Application\Service\GitHubServiceInterface' => 'Application\Service\Factory\GitHubServiceFactory',
            'Application\Mapper\GitHubMapperInterface' => 'Application\Mapper\Factory\GitHubMapperFactory'
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            0 => array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            
        ),
        'factories' => array(
            'Application\Controller\IndexController' => 'Application\Controller\Factory\IndexControllerFactory',
            'Application\\Controller\\BaseController' => 'Application\\Controller\\Factory\\BaseControllerFactory',
            'Application\\Controller\\KeepAliveController' => 'Application\\Controller\\Factory\\KeepAliveControllerFactory',
        ),
    ),
    'controller_plugins' => array(
        'factories' => array(
            'SetPageTitle' => 'Application\\Controller\\Plugin\\Factory\\SetPageTitleFactory',
            'SetHeadTitle' => 'Application\\Controller\\Plugin\\Factory\\SetHeadTitleFactory',
            'Acl' => 'Application\\Controller\\Plugin\\Factory\\ApplicationAclFactory',
        ),
        'invokables' => array(),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'Paginator' => 'Application\\View\\Helper\\Paginator',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => false,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'error/layout' => __DIR__ . '/../view/layout/error.phtml',
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            0 => __DIR__ . '/../view',
        ),
    ),
    'console' => array(
        'router' => array(
            'routes' => array(),
        ),
    ),
    'navigation' => array(
        'default' => array(
            0 => array(
                'label' => 'Home',
                'route' => 'home',
                'pages' => array(
                    0 => array(
                        'label' => 'Accounting',
                        'route' => 'account-home',
                        'useRouteMatch' => true,
                        'pages' => array(
                            0 => array(
                                'label' => 'Accounts',
                                'route' => 'account-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    0 => array(
                                        'label' => 'New Account',
                                        'route' => 'account-create',
                                        'useRouteMatch' => true,
                                    ),
                                    1 => array(
                                        'label' => 'View Account',
                                        'route' => 'account-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'Ledger Item',
                                                'route' => 'account-ledger-view',
                                                'useRouteMatch' => true,
                                            ),
                                            1 => array(
                                                'label' => 'Create Ledger Item',
                                                'route' => 'account-ledger-create',
                                                'useRouteMatch' => true,
                                            ),
                                            2 => array(
                                                'label' => 'Edit',
                                                'route' => 'account-update',
                                                'useRouteMatch' => true,
                                            ),
                                            3 => array(
                                                'label' => 'Delete',
                                                'route' => 'account-delete',
                                                'useRouteMatch' => true,
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                            1 => array(
                                'label' => 'Bills',
                                'route' => 'vendor-bill-index',
                                'useRouteMatch' => true,
                            ),
                            2 => array(
                                'label' => 'Vendors',
                                'route' => 'vendor-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    0 => array(
                                        'label' => 'View',
                                        'route' => 'vendor-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'Bill',
                                                'route' => 'vendor-bill-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    0 => array(
                                                        'label' => 'Payment',
                                                        'route' => 'vendor-payment-create',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    1 => array(
                                                        'label' => 'View Payment',
                                                        'route' => 'vendor-payment-view',
                                                        'useRouteMatch' => true,
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                            3 => array(
                                'label' => 'Account Types',
                                'route' => 'account-type-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    0 => array(
                                        'label' => 'Create Account Type',
                                        'route' => 'account-type-create',
                                        'useRouteMatch' => true,
                                    ),
                                    1 => array(
                                        'label' => 'View',
                                        'route' => 'account-type-create',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'Update',
                                                'route' => 'account-type-update',
                                                'useRouteMatch' => true,
                                            ),
                                            1 => array(
                                                'label' => 'Delete',
                                                'route' => 'account-type-delete',
                                                'useRouteMatch' => true,
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    1 => array(
                        'label' => 'My Profile',
                        'route' => 'employee-profile',
                        'useRouteMatch' => true,
                        'pages' => array(
                            0 => array(
                                'label' => 'Time Clock',
                                'route' => 'employee-time',
                                'useRouteMatch' => true,
                            ),
                            1 => array(
                                'label' => 'Calendar',
                                'route' => 'employee-calendar',
                                'useRouteMatch' => true,
                            ),
                            2 => array(
                                'label' => 'Favorite Clients',
                                'route' => 'client-favorite-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    0 => array(
                                        'label' => 'Delete',
                                        'route' => 'client-favorite-delete',
                                        'useRouteMatch' => true,
                                    ),
                                ),
                            ),
                            3 => array(
                                'label' => 'Edit',
                                'route' => 'employee-profile-update',
                                'useRouteMatch' => true,
                            ),
                            4 => array(
                                'label' => 'Change Password',
                                'route' => 'employee-password',
                                'useRouteMatch' => true,
                            ),
                        ),
                    ),
                    2 => array(
                        'label' => 'Admin',
                        'route' => 'admin-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            0 => array(
                                'label' => 'Config',
                                'route' => 'config-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    0 => array(
                                        'label' => 'Edit Config',
                                        'route' => 'config-update',
                                        'useRouteMatch' => true,
                                    ),
                                ),
                            ),
                            1 => array(
                                'label' => 'Payment Options',
                                'route' => 'payment-option-index',
                                'useRouteMatch' => true,
                                'pages' => array(),
                            ),
                            2 => array(
                                'label' => 'Invoice Options',
                                'route' => 'invoice-option-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    0 => array(
                                        'label' => 'Edit',
                                        'route' => 'invoice-option-update',
                                        'useRouteMatch' => true,
                                    ),
                                ),
                            ),
                            3 => array(
                                'label' => 'Labor Rates',
                                'route' => 'labor-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    0 => array(
                                        'label' => 'View Labor Rate',
                                        'route' => 'labor-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'Edit Labor Rate',
                                                'route' => 'labor-update',
                                                'useRouteMatch' => true,
                                            ),
                                            1 => array(
                                                'label' => 'Delete Labor Rate',
                                                'route' => 'labor-delete',
                                                'useRouteMatch' => true,
                                            ),
                                        ),
                                    ),
                                    1 => array(
                                        'label' => 'Create Labor Rate',
                                        'route' => 'labor-create',
                                        'useRouteMatch' => true,
                                    ),
                                ),
                            ),
                            4 => array(
                                'label' => 'Host Types',
                                'route' => 'host-type-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    0 => array(
                                        'label' => 'View',
                                        'route' => 'host-type-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'Edit',
                                                'route' => 'host-type-update',
                                            ),
                                            1 => array(
                                                'label' => 'Delete',
                                                'route' => 'host-type-delete',
                                            ),
                                        ),
                                    ),
                                    1 => array(
                                        'label' => 'Create Host Type',
                                        'route' => 'host-type-create',
                                        'useRouteMatch' => true,
                                    ),
                                ),
                            ),
                            5 => array(
                                'label' => 'Host Attributes',
                                'route' => 'host-attribute-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    0 => array(
                                        'label' => 'View Attribute',
                                        'route' => 'host-attribute-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'Edit',
                                                'route' => 'host-attribute-update',
                                            ),
                                            1 => array(
                                                'label' => 'Delete',
                                                'route' => 'host-attribute-delete',
                                            ),
                                            2 => array(
                                                'label' => 'New Value',
                                                'route' => 'host-attribute-value-create',
                                                'useRouteMatch' => true,
                                            ),
                                        ),
                                    ),
                                    1 => array(
                                        'label' => 'Create',
                                        'route' => 'host-attribute-create',
                                        'useRouteMatch' => true,
                                    ),
                                ),
                            ),
                            6 => array(
                                'label' => 'Employee',
                                'route' => 'employee-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    0 => array(
                                        'label' => 'View Employee',
                                        'route' => 'employee-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'Edit Employee',
                                                'route' => 'employee-update',
                                                'useRouteMatch' => true,
                                            ),
                                            1 => array(
                                                'label' => 'Delete Employee',
                                                'route' => 'employee-delete',
                                                'useRouteMatch' => true,
                                            ),
                                        ),
                                    ),
                                    1 => array(
                                        'label' => 'Create Employee',
                                        'route' => 'employee-create',
                                        'useRouteMatch' => true,
                                    ),
                                ),
                            ),
                            7 => array(
                                'label' => 'Auth',
                                'route' => 'auth-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    0 => array(
                                        'label' => 'Create',
                                        'route' => 'auth-create',
                                        'useRouteMatch' => true,
                                    ),
                                    1 => array(
                                        'label' => 'View',
                                        'route' => 'auth-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'Update',
                                                'route' => 'auth-update',
                                                'useRouteMatch' => true,
                                            ),
                                            1 => array(
                                                'label' => 'Delete',
                                                'route' => 'auth-delete',
                                                'useRouteMatch' => true,
                                            ),
                                            2 => array(
                                                'label' => 'Reset Password',
                                                'route' => 'auth-password',
                                                'useRouteMatch' => true,
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    3 => array(
                        'label' => 'Clients',
                        'route' => 'client-index',
                        'resource' => 'client-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            0 => array(
                                'label' => 'View Client',
                                'route' => 'client-view',
                                'resource' => 'client-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    0 => array(
                                        'label' => 'Edit Client',
                                        'route' => 'client-update',
                                        'useRouteMatch' => true,
                                    ),
                                    1 => array(
                                        'label' => 'Location',
                                        'route' => 'location-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'Edit Location',
                                                'route' => 'location-update',
                                                'useRouteMatch' => true,
                                            ),
                                        ),
                                    ),
                                    2 => array(
                                        'label' => 'New Location',
                                        'route' => 'location-create',
                                        'useRouteMatch' => true,
                                    ),
                                    3 => array(
                                        'label' => 'Call Log',
                                        'route' => 'call-log-index',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'New',
                                                'route' => 'call-log-create',
                                                'useRouteMatch' => true,
                                            ),
                                            1 => array(
                                                'label' => 'View',
                                                'route' => 'call-log-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    0 => array(
                                                        'label' => 'Edit',
                                                        'route' => 'call-log-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    1 => array(
                                                        'label' => 'Delete',
                                                        'route' => 'call-log-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    2 => array(
                                                        'label' => 'New Note',
                                                        'route' => 'call-log-note-create',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    3 => array(
                                                        'label' => 'Edit Note',
                                                        'route' => 'call-log-note-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    4 => array(
                                                        'label' => 'Delete Note',
                                                        'route' => 'call-log-note-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                    4 => array(
                                        'label' => 'Estimates',
                                        'route' => 'estimate-index',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'New',
                                                'route' => 'estimate-create',
                                                'useRouteMatch' => true,
                                            ),
                                            1 => array(
                                                'label' => 'View',
                                                'route' => 'estimate-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    0 => array(
                                                        'label' => 'Edit Estimate',
                                                        'route' => 'estimate-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    1 => array(
                                                        'label' => 'Delete Estimate',
                                                        'route' => 'estimate-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    2 => array(
                                                        'label' => 'New Item',
                                                        'route' => 'estimate-option-item-create',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    3 => array(
                                                        'label' => 'Edit Item',
                                                        'route' => 'estimate-option-item-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    4 => array(
                                                        'label' => 'Delete Item',
                                                        'route' => 'estimate-option-item-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    5 => array(
                                                        'label' => 'New Option',
                                                        'route' => 'estimate-option-create',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    6 => array(
                                                        'label' => 'Edit Option',
                                                        'route' => 'estimate-option-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    7 => array(
                                                        'label' => 'Delete Option',
                                                        'route' => 'estimate-option-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                    5 => array(
                                        'label' => 'Hosts',
                                        'route' => 'host-list',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'View Host',
                                                'route' => 'host-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    0 => array(
                                                        'label' => 'Edit Host',
                                                        'route' => 'host-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    1 => array(
                                                        'label' => 'Delete Host',
                                                        'route' => 'host-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    2 => array(
                                                        'label' => 'Add Attributes',
                                                        'route' => 'host-attribute-map-create',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    3 => array(
                                                        'label' => 'Edit Attributes',
                                                        'route' => 'host-attribute-map-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                ),
                                            ),
                                            1 => array(
                                                'label' => 'Create Host',
                                                'route' => 'host-create',
                                                'useRouteMatch' => true,
                                            ),
                                        ),
                                    ),
                                    6 => array(
                                        'label' => 'Invoices',
                                        'route' => 'invoice-list',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'Create Invoice',
                                                'route' => 'invoice-create',
                                                'useRouteMatch' => true,
                                            ),
                                            1 => array(
                                                'label' => 'View Invoice',
                                                'route' => 'invoice-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    0 => array(
                                                        'label' => 'Edit Invoice',
                                                        'route' => 'invoice-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    1 => array(
                                                        'label' => 'Delete Invoice',
                                                        'route' => 'invoice-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    2 => array(
                                                        'label' => 'Print Invoice',
                                                        'route' => 'invoice-print',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    3 => array(
                                                        'label' => 'Delete Payment',
                                                        'route' => 'invoice-payemnt-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    4 => array(
                                                        'label' => 'Delete Invoice Item',
                                                        'route' => 'invoice-item-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    5 => array(
                                                        'label' => 'Add Work Order',
                                                        'route' => 'invoice-workorder',
                                                        'useRouteMatch' => true,
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                    7 => array(
                                        'label' => 'Network Settings',
                                        'route' => 'network-list',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'View Network Setting',
                                                'route' => 'network-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    0 => array(
                                                        'label' => 'Edit Network Setting',
                                                        'route' => 'network-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    1 => array(
                                                        'label' => 'Delete Network Setting',
                                                        'route' => 'network-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                ),
                                            ),
                                            1 => array(
                                                'label' => 'Create Network Setting',
                                                'route' => 'network-create',
                                                'useRouteMatch' => true,
                                            ),
                                        ),
                                    ),
                                    8 => array(
                                        'label' => 'Passwords',
                                        'route' => 'password-list',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'View Password',
                                                'route' => 'password-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    0 => array(
                                                        'label' => 'Edit Password',
                                                        'route' => 'password-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    1 => array(
                                                        'label' => 'Delete Password',
                                                        'route' => 'password-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                ),
                                            ),
                                            1 => array(
                                                'label' => 'Create Password',
                                                'route' => 'password-create',
                                                'useRouteMatch' => true,
                                            ),
                                        ),
                                    ),
                                    9 => array(
                                        'label' => 'Tasks',
                                        'route' => 'task-list',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'View Task',
                                                'route' => 'task-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    0 => array(
                                                        'label' => 'Edit Task',
                                                        'route' => 'task-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    1 => array(
                                                        'label' => 'Delete Task',
                                                        'route' => 'task-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    2 => array(
                                                        'label' => 'Edit Note',
                                                        'route' => 'task-note-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    3 => array(
                                                        'label' => 'Delete Note',
                                                        'route' => 'task-note-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                ),
                                            ),
                                            1 => array(
                                                'label' => 'Create Task',
                                                'route' => 'task-create',
                                                'useRouteMatch' => true,
                                            ),
                                        ),
                                    ),
                                    10 => array(
                                        'label' => 'Users',
                                        'route' => 'user-list',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'Create User',
                                                'route' => 'user-create',
                                                'useRouteMatch' => true,
                                            ),
                                            1 => array(
                                                'label' => 'View User',
                                                'route' => 'user-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    0 => array(
                                                        'label' => 'Edit User',
                                                        'route' => 'user-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    1 => array(
                                                        'label' => 'Delete User',
                                                        'route' => 'user-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                    11 => array(
                                        'label' => 'Work Orders',
                                        'route' => 'workorder-list',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            0 => array(
                                                'label' => 'Create Work Order',
                                                'route' => 'workorder-create',
                                                'useRouteMatch' => true,
                                            ),
                                            1 => array(
                                                'label' => 'View Work Order',
                                                'route' => 'workorder-view',
                                                'useRouteMatch' => true,
                                                'pages' => array(
                                                    0 => array(
                                                        'label' => 'Edit Work Order',
                                                        'route' => 'workorder-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    1 => array(
                                                        'label' => 'Delete Work Order',
                                                        'route' => 'workorder-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    2 => array(
                                                        'label' => 'Print Work Order',
                                                        'route' => 'workorder-print',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    3 => array(
                                                        'label' => 'Delete Time',
                                                        'route' => 'workorder-time-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    4 => array(
                                                        'label' => 'Delete Part',
                                                        'route' => 'workorder-part-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    5 => array(
                                                        'label' => 'Edit Note',
                                                        'route' => 'workorder-note-update',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    6 => array(
                                                        'label' => 'Delete Note',
                                                        'route' => 'workorder-note-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    7 => array(
                                                        'label' => 'Credit',
                                                        'route' => 'workorder-credit-view',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    8 => array(
                                                        'label' => 'Remove Employee',
                                                        'route' => 'workorder-employee-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    9 => array(
                                                        'label' => 'Add File',
                                                        'route' => 'workorder-file-create',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    10 => array(
                                                        'label' => 'Remove File',
                                                        'route' => 'workorder-file-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                    11 => array(
                                                        'label' => 'Remove Host',
                                                        'route' => 'workorder-host-delete',
                                                        'useRouteMatch' => true,
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                            1 => array(
                                'label' => 'New Client',
                                'route' => 'client-create',
                                'useRouteMatch' => true,
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(),
    ),
    'zf-rest' => array(),
    'zf-content-negotiation' => array(
        'controllers' => array(),
        'accept_whitelist' => array(),
        'content_type_whitelist' => array(),
    ),
    'zf-hal' => array(
        'metadata_map' => array(),
    ),
);
