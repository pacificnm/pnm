<?php
return array(
    'Network' => array(
        'name' => 'Network',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'network-list'
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Network\Controller\Index' => 'Network\Controller\Factory\IndexControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array()
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'network-list' => array(
                'title' => 'Client Network Settings',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/network',
                    'defaults' => array(
                        'controller' => 'Network\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'network-create' => array(
                'title' => 'Create Network Setting',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/network/create',
                    'defaults' => array(
                        'controller' => 'Network\Controller\Create',
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