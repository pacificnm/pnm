<?php
return array(
    'module' => array(
        'WorkorderTicket' => array(
            'name' => 'WorkorderTicket',
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
        )
    ),
    'controllers' => array(
        'factories' => array()
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'WorkorderTicket\Mapper\MysqlMapperInterface' => 'WorkorderTicket\Mapper\Factory\MysqlMapperFactory',
            'WorkorderTicket\Service\WorkorderTicketServiceInterface' => 'WorkorderTicket\Service\Factory\WorkorderTicketServiceFactory',
        )
    ),
    // router
    'router' => array(
        'routes' => array()
    ),
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);