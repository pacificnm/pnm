<?php
return array(
    'module' => array(
        'SubscriptionSchedule' => array(
            'name' => 'SubscriptionSchedule',
            'version' => '2.5'
        )
    ),
    // controller
    'controllers' => array(
        'factories' => array()
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'SubscriptionSchedule\Mapper\MysqlMapperInterface' => 'SubscriptionSchedule\Mapper\Factory\MysqlMapperFactory',
            'SubscriptionSchedule\Service\SubscriptionScheduleServiceInterface' => 'SubscriptionSchedule\Service\Factory\SubscriptionScheduleServiceFactory'
        )
    ),
    // routes
    'router' => array(
        'routes' => array()
    ),
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        )
    ),
    // navigation
    'navigation' => array(
        'default' => array()
    ),
    // menu
    'menu' => array(
        'default' => array()
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