<?php
return array(
    'module' => array(
        'Update' => array(
            'name' => 'Update',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Update\Controller\Console' => 'Update\Controller\Factory\ConsoleControllerFactory',
        )
    ),
    
    // console routes
    'console' => array(
        'router' => array(
            'routes' => array(
                'update-install' => array(
                    'options' => array(
                        'route' => 'update --install',
                        'defaults' => array(
                            'controller' => 'Update\Controller\Console',
                            'action' => 'index'
                        )
                    )
                )
            )
        )
    )
);