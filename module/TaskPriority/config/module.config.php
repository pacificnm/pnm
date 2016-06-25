<?php
return array(
    'module' => array(
        'TaskPriority' => array(
            'name' => 'TaskPriority',
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
            'factories' => array()
        ),
    
        // service manager
        'service_manager' => array(
            'factories' => array(
                'TaskPriority\Service\PriorityServiceInterface' => 'TaskPriority\Service\Factory\PriorityServiceFactory',
                'TaskPriority\Mapper\PriorityMapperInterface' => 'TaskPriority\Mapper\Factory\PriorityMapperFactory'
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