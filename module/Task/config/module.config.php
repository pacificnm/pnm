<?php
return array(
    'Task' => array(
        'name' => 'Task',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'task-list',
                'task-create',
                'task-delete',
                'task-update',
                'task-view',
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Task\Controller\Create' => 'Task\Controller\Factory\CreateControllerFactory',
            'Task\Controller\Delete' => 'Task\Controller\Factory\DeleteControllerFactory',
            'Task\Controller\Index' => 'Task\Controller\Factory\IndexControllerFactory',
            'Task\Controller\Update' => 'Task\Controller\Factory\UpdateControllerFactory',
            'Task\Controller\View' => 'Task\Controller\Factory\ViewControllerFactory',
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
            ),
            'task-delete' => array(
                'title' => 'Delete Task',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/task/delete/[:taskId]',
                    'defaults' => array(
                        'controller' => 'Task\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'task-update' => array(
                'title' => 'Edit Task',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/task/update/[:taskId]',
                    'defaults' => array(
                        'controller' => 'Task\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'task-view' => array(
                'title' => 'View Task',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/task/view/[:taskId]',
                    'defaults' => array(
                        'controller' => 'Task\Controller\View',
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