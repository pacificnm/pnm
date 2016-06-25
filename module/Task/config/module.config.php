<?php
return array(
    'module' => array(
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
                    'task-reminder'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Task\Controller\Create' => 'Task\Controller\Factory\CreateControllerFactory',
            'Task\Controller\Delete' => 'Task\Controller\Factory\DeleteControllerFactory',
            'Task\Controller\Index' => 'Task\Controller\Factory\IndexControllerFactory',
            'Task\Controller\Update' => 'Task\Controller\Factory\UpdateControllerFactory',
            'Task\Controller\View' => 'Task\Controller\Factory\ViewControllerFactory',
            'Task\Controller\Reminder' => 'Task\Controller\Factory\ReminderControllerFactory',
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Task\Service\TaskServiceInterface' => 'Task\Service\Factory\TaskServiceFactory',
            'Task\Mapper\TaskMapperInterface' => 'Task\Mapper\Factory\TaskMapperFactory',
            'Task\Form\TaskForm' => 'Task\Form\Factory\TaskFormFactory'
        )
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
            ),
            'task-reminder' => array(
                'title' => 'Task Reminder',
                'type' => 'segment',
                'options' => array(
                    'route' => '/api/task/reminder',
                    'defaults' => array(
                        'controller' => 'Task\Controller\Reminder',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'NavBarTask' => 'Task\View\Helper\Factory\NavBarTaskFactory'
        ),
        'invokables' => array()
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    )
);