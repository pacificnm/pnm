<?php
return array(
    'module' => array(
        'AccountType' => array(
            'name' => 'AccountType',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'account-type-index',
                    'account-type-create',
                    'account-type-delete',
                    'account-type-update',
                    'account-type-view'
                )
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'AccountType\Controller\Index' => 'AccountType\Controller\Factory\IndexControllerFactory',
            'AccountType\Controller\Create' => 'AccountType\Controller\Factory\CreateControllerFactory',
            'AccountType\Controller\Delete' => 'AccountType\Controller\Factory\DeleteControllerFactory',
            'AccountType\Controller\Update' => 'AccountType\Controller\Factory\UpdateControllerFactory',
            'AccountType\Controller\View' => 'AccountType\Controller\Factory\ViewControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'AccountType\Service\TypeServiceInterface' => 'AccountType\Service\Factory\TypeServiceFactory',
            'AccountType\Mapper\TypeMapperInterface' => 'AccountType\Mapper\Factory\TypeMapperFactory',
            'AccountType\Form\TypeForm' => 'AccountType\Form\Factory\TypeFormFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'account-type-index' => array(
                'title' => 'Account Types',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/account-type',
                    'defaults' => array(
                        'controller' => 'AccountType\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'account-type-create' => array(
                'title' => 'Create Account Types',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/account-type/create',
                    'defaults' => array(
                        'controller' => 'AccountType\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'account-type-update' => array(
                'title' => 'Edit Account Types',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/account-type/update/[:accountTypeId]',
                    'defaults' => array(
                        'controller' => 'AccountType\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'account-type-view' => array(
                'title' => 'View Account Types',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/account-type/view/[:accountTypeId]',
                    'defaults' => array(
                        'controller' => 'AccountType\Controller\View',
                        'action' => 'index'
                    )
                )
            ),
            'account-type-delete' => array(
                'title' => 'Delete Account Types',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/account-type/delete/[:accountTypeId]',
                    'defaults' => array(
                        'controller' => 'AccountType\Controller\Delete',
                        'action' => 'index'
                    )
                )
            )
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
                        'label' => 'Account Types',
                        'route' => 'account-type-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New',
                                'route' => 'account-type-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'View',
                                'route' => 'account-type-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Update',
                                        'route' => 'account-type-update',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'account-type-delete',
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
        'default' => array(
            'accounting' => array(
                array(
                    'label' => 'Account Types',
                    'icon' => 'fa fa-cogs',
                    'route' => 'account-type-index',
                    'resource' => 'account-type-index',
                    'order' => 3
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