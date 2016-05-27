<?php
return array(
    'Task' => array(
        'name' => 'Task',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'task-list'
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Task\Controller\Index' => 'Task\Controller\Factory\IndexControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array()
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'task-list' => array(
                'title' => 'Client Tasks',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/task',
                    'defaults' => array(
                        'controller' => 'Task\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'task-create' => array(
                'title' => 'Create Task',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/task/create',
                    'defaults' => array(
                        'controller' => 'Task\Controller\Create',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'invokables' => array(
            'NavBarTask' => 'Task\View\Helper\NavBarTask'
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);