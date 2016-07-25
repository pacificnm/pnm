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
        'factories' => array(
            'Notification\Service\NotificationServiceInterface' => 'Notification\Service\Factory\NotificationServiceFactory',
            'Notification\Mapper\NotificationMapperInterface' => 'Notification\Mapper\Factory\NotificationMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'notification-list' => array(
                'title' => 'Notifications',
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
        'factories' => array(
            'NavBarNotification' => 'Notification\View\Helper\Factory\NavBarNotificationFactory'
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);