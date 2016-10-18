<?php
return array(
    'module' => array(
        'TicketEmail' => array(
            'name' => 'TicketEmail',
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
            'TicketEmail\Service\TicketEmailServiceInterface' => 'TicketEmail\Service\Factory\TicketEmailServiceFactory',
            'TicketEmail\Mapper\TicketEmailMapperInterface' => 'TicketEmail\Mapper\Factory\TicketEmailMapperFactory',
            'TicketEmail\Listener\TicketEmailListener' => 'TicketEmail\Listener\Factory\TicketEmailListenerFactory',
        )
    
    ),
    'router' => array(
        'routes' => array()
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        ),
        'template_map' => array(
            'ticket-create-employee' => __DIR__ . '/../../../data/template/ticket-create-employee.phtml',
            'ticket-close' => __DIR__ . '/../../../data/template/ticket-close.phtml',
            'ticket-note-create' =>  __DIR__ . '/../../../data/template/ticket-note-create.phtml',
            'ticket-note-update' => __DIR__ . '/../../../data/template/ticket-note-update.phtml',
        )
    )
    
);