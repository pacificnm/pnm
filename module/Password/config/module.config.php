<?php
return array(
    'Password' => array(
        'name' => 'Password',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'password-list'
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Password\Controller\Index' => 'Password\Controller\Factory\IndexControllerFactory'
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
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);