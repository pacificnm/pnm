<?php
return array(
    'module' => array(
        'Notification' => array(
            'name' => 'Notification',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Notification\Controller\ClearController' => 'Notification\Controller\Factory\ClearControllerFactory',
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Notification\Service\NotificationServiceInterface' => 'Notification\Service\Factory\NotificationServiceFactory',
            'Notification\Mapper\MysqlMapperInterface' => 'Notification\Mapper\Factory\MysqlMapperFactory',
             'Notification\Listener\NotificationListener' => 'Notification\Listener\Factory\NotificationListenerFactory'
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
            ),
            'notification-clear' => array(
                'title' => 'Notifications',
                'type' => 'literal',
                'options' => array(
                    'route' => '/notification/clear',
                    'defaults' => array(
                        'controller' => 'Notification\Controller\ClearController',
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