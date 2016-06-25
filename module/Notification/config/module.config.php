<?php
return array(
    'module' => array(
        'Notification' => array(
            'name' => 'Notification',
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
        'factories' => array()
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array()
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'notification-list' => array(
                'title' => 'NOtifications',
                'type' => 'segment',
                'options' => array(
                    'route' => '/notification',
                    'defaults' => array(
                        'controller' => 'Notification\Controller\Index',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'invokables' => array(
            'NavBarNotification' => 'Notification\View\Helper\NavBarNotification'
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);