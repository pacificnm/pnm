<?php
return array(
    'module' => array(
        'Account' => array(
            'name' => 'Account',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(),
                'accountant' => array(
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
            'Account\Controller\Index' => 'Account\Controller\Factory\IndexControllerFactory',
            'Account\Controller\Create' => 'Account\Controller\Factory\CreateControllerFactory',
            'Account\Controller\Delete' => 'Account\Controller\Factory\DeleteControllerFactory',
            'Account\Controller\Update' => 'Account\Controller\Factory\UpdateControllerFactory',
            'Account\Controller\View' => 'Account\Controller\Factory\ViewControllerFactory'
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
                        'controller' => 'Account\Controller\Index',
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
                        'controller' => 'Account\Controller\Create',
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
                        'controller' => 'Account\Controller\Delete',
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
                        'controller' => 'Account\Controller\Update',
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
                        'controller' => 'Account\Controller\View',
                        'action' => 'index'
                    )
                )
            )
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
    )
);