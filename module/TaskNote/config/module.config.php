<?php
return array(
    'module' => array(
        'TaskNote' => array(
            'name' => 'TaskNote',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(
                    'task-note-list',
                    'task-note-create',
                    'task-note-delete',
                    'task-note-update',
                    'task-note-view'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'TaskNote\Controller\Create' => 'TaskNote\Controller\Factory\CreateControllerFactory',
            'TaskNote\Controller\Update' => 'TaskNote\Controller\Factory\UpdateControllerFactory',
            'TaskNote\Controller\Delete' => 'TaskNote\Controller\Factory\DeleteControllerFactory',
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'TaskNote\Service\NoteServiceInterface' => 'TaskNote\Service\Factory\NoteServiceFactory',
            'TaskNote\Mapper\NoteMapperInterface' => 'TaskNote\Mapper\Factory\NoteMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'task-note-create' => array(
                'title' => 'Create Task Note',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/task/[:taskId]/task-note/create',
                    'defaults' => array(
                        'controller' => 'TaskNote\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'task-note-delete' => array(
                'title' => 'Delete Task Note',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/task/[:taskId]/task-note/delete/[:taskNoteId]',
                    'defaults' => array(
                        'controller' => 'TaskNote\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'task-note-update' => array(
                'title' => 'Edit Task Note',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/task/[:taskId]/task-note/update/[:taskNoteId]',
                    'defaults' => array(
                        'controller' => 'TaskNote\Controller\Update',
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