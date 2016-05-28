<?php
return array(
    'Password' => array(
        'name' => 'Password',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'password-list',
                'password-create',
                'password-delete',
                'password-update',
                'password-view'
            ),
            'accountant' => array(),
            'administrator' => array()
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
        'factories' => array()
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
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);