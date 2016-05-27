<?php
return array(
    'Host' => array(
        'name' => 'Host',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'host-list'
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
        'controllers' => array(
            'factories' => array(
                'Host\Controller\Index' => 'Host\Controller\Factory\IndexControllerFactory'
            )
        ),
    
        // service manager
        'service_manager' => array(
            'factories' => array()
        ),
    
        // router
        'router' => array(
            'routes' => array(
                'host-list' => array(
                    'title' => 'Hosts',
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/client/[:clientId]/host',
                        'defaults' => array(
                            'controller' => 'Host\Controller\Index',
                            'action' => 'index'
                        )
                    )
                ),
                'host-create' => array(
                    'title' => 'Create Host',
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/client/[:clientId]/host/create',
                        'defaults' => array(
                            'controller' => 'Host\Controller\Create',
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