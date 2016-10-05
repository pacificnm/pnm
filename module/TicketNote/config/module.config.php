<?php
return array(
    'module' => array(
        'TicketNote' => array(
            'name' => 'TicketNote',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    'ticket-note-create',
                    'ticket-note-update',
                    'ticket-note-view'
                ),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'ticket-note-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    'controllers' => array(
        'factories' => array(
            'TicketNote\Controller\CreateController' => 'TicketNote\Controller\Factory\CreateControllerFactory',
            'TicketNote\Controller\UpdateController' => 'TicketNote\Controller\Factory\UpdateControllerFactory',
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'TicketNote\Service\NoteServiceInterface' => 'TicketNote\Service\Factory\NoteServiceFactory',
            'TicketNote\Mapper\MysqlMapperInterface' => 'TicketNote\Mapper\Factory\MysqlMapperFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'ticket-note-create' => array(
                'title' => 'New Note',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/ticket/[:ticketId]/ticket-note/create',
                    'defaults' => array(
                        'controller' => 'TicketNote\Controller\CreateController',
                        'action' => 'index',
                    ),
                ),
            ),
            'ticket-note-update' => array(
                'title' => 'Edit Note',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/ticket/[:ticketId]/ticket-note/update/[:ticketNoteId]',
                    'defaults' => array(
                        'controller' => 'TicketNote\Controller\UpdateController',
                        'action' => 'index',
                    ),
                ),
            ),
        )
    ),
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'TicketNote' => 'TicketNote\View\Helper\Factory\TicketNoteViewHelperFactory'
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        ),
        'strategies' => array(
            0 => 'ViewJsonStrategy'
        )
    )
);