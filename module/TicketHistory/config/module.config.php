<?php
return array(
    'module' => array(
        'TicketHistory' => array(
            'name' => 'TicketHistory',
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
    'service_manager' => array(
        'factories' => array(
            'TicketHistory\Service\TicketHistoryServiceInterface' => 'TicketHistory\Service\Factory\TicketHistoryServiceFactory',
            'TicketHistory\Mapper\TicketHistoryMapperInterface' => 'TicketHistory\Mapper\Factory\TicketHistoryMapperFactory',
            'TicketHistory\Listener\TicketHistoryListener' => 'TicketHistory\Listener\Factory\TicketHistoryListenerFactory'
        )
    
    ),
    'router' => array(
        'routes' => array()
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        )
    )
    
);