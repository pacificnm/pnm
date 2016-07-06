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
                    0 => 'task-list',
                    1 => 'task-create',
                    2 => 'task-delete',
                    3 => 'task-update',
                    4 => 'task-view',
                    5 => 'task-reminder',
                ),
                'accountant' => array(),
                'administrator' => array(),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Task\\Controller\\Create' => 'Task\\Controller\\Factory\\CreateControllerFactory',
            'Task\\Controller\\Delete' => 'Task\\Controller\\Factory\\DeleteControllerFactory',
            'Task\\Controller\\Index' => 'Task\\Controller\\Factory\\IndexControllerFactory',
            'Task\\Controller\\Update' => 'Task\\Controller\\Factory\\UpdateControllerFactory',
            'Task\\Controller\\View' => 'Task\\Controller\\Factory\\ViewControllerFactory',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Task\\Service\\TaskServiceInterface' => 'Task\\Service\\Factory\\TaskServiceFactory',
            'Task\\Mapper\\TaskMapperInterface' => 'Task\\Mapper\\Factory\\TaskMapperFactory',
            'Task\\Form\\TaskForm' => 'Task\\Form\\Factory\\TaskFormFactory',
            'Task\\V1\\Rest\\TaskReminder\\TaskReminderResource' => 'Task\\V1\\Rest\\TaskReminder\\TaskReminderResourceFactory',
            'Task\\V1\\Rest\\TaskDismissReminder\\TaskDismissReminderResource' => 'Task\\V1\\Rest\\TaskDismissReminder\\TaskDismissReminderResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'task-list' => array(
                'title' => 'Client Tasks',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/task',
                    'defaults' => array(
                        'controller' => 'Task\\Controller\\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'task-create' => array(
                'title' => 'Create Task',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/task/create',
                    'defaults' => array(
                        'controller' => 'Task\\Controller\\Create',
                        'action' => 'index',
                    ),
                ),
            ),
            'task-delete' => array(
                'title' => 'Delete Task',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/task/delete/[:taskId]',
                    'defaults' => array(
                        'controller' => 'Task\\Controller\\Delete',
                        'action' => 'index',
                    ),
                ),
            ),
            'task-update' => array(
                'title' => 'Edit Task',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/task/update/[:taskId]',
                    'defaults' => array(
                        'controller' => 'Task\\Controller\\Update',
                        'action' => 'index',
                    ),
                ),
            ),
            'task-view' => array(
                'title' => 'View Task',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/task/view/[:taskId]',
                    'defaults' => array(
                        'controller' => 'Task\\Controller\\View',
                        'action' => 'index',
                    ),
                ),
            ),
            'task.rest.task-reminder' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/task/get-reminder',
                    'defaults' => array(
                        'controller' => 'Task\\V1\\Rest\\TaskReminder\\Controller',
                    ),
                ),
            ),
            'task.rest.task-dismiss-reminder' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/task/dismiss-reminder[/:task_dismiss_reminder_id]',
                    'defaults' => array(
                        'controller' => 'Task\\V1\\Rest\\TaskDismissReminder\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'NavBarTask' => 'Task\\View\\Helper\\Factory\\NavBarTaskFactory',
        ),
        'invokables' => array(),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view',
        ),
        'strategies' => array(
            0 => 'ViewJsonStrategy',
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'task.rest.task-reminder',
            1 => 'task.rest.task-dismiss-reminder',
        ),
    ),
    'zf-rest' => array(
        'Task\\V1\\Rest\\TaskReminder\\Controller' => array(
            'listener' => 'Task\\V1\\Rest\\TaskReminder\\TaskReminderResource',
            'route_name' => 'task.rest.task-reminder',
            'route_identifier_name' => 'taskReminderId',
            'collection_name' => 'task_reminder',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Task\\Entity\\TaskEntity',
            'collection_class' => 'Task\\V1\\Rest\\TaskReminder\\TaskReminderCollection',
            'service_name' => 'TaskReminder',
        ),
        'Task\\V1\\Rest\\TaskDismissReminder\\Controller' => array(
            'listener' => 'Task\\V1\\Rest\\TaskDismissReminder\\TaskDismissReminderResource',
            'route_name' => 'task.rest.task-dismiss-reminder',
            'route_identifier_name' => 'task_dismiss_reminder_id',
            'collection_name' => 'task_dismiss_reminder',
            'entity_http_methods' => array(
                0 => 'PUT',
            ),
            'collection_http_methods' => array(),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Task\\Entity\\TaskEntity',
            'collection_class' => 'Task\\V1\\Rest\\TaskDismissReminder\\TaskDismissReminderCollection',
            'service_name' => 'TaskDismissReminder',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Task\\V1\\Rest\\TaskReminder\\Controller' => 'HalJson',
            'Task\\V1\\Rest\\TaskDismissReminder\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Task\\V1\\Rest\\TaskReminder\\Controller' => array(
                0 => 'application/vnd.task.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Task\\V1\\Rest\\TaskDismissReminder\\Controller' => array(
                0 => 'application/vnd.task.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'Task\\V1\\Rest\\TaskReminder\\Controller' => array(
                0 => 'application/vnd.task.v1+json',
                1 => 'application/json',
            ),
            'Task\\V1\\Rest\\TaskDismissReminder\\Controller' => array(
                0 => 'application/vnd.task.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Task\\V1\\Rest\\TaskReminder\\TaskReminderEntity' => array(
                'entity_identifier_name' => 'task_id',
                'route_name' => 'task.rest.task-reminder',
                'route_identifier_name' => 'taskReminderId',
                'hydrator' => 'Task\\Hydrator\\TaskHydrator',
            ),
            'Task\\V1\\Rest\\TaskReminder\\TaskReminderCollection' => array(
                'entity_identifier_name' => 'task_id',
                'route_name' => 'task.rest.task-reminder',
                'route_identifier_name' => 'taskReminderId',
                'is_collection' => true,
            ),
            'Task\\V1\\Rest\\TaskDismissReminder\\TaskDismissReminderEntity' => array(
                'entity_identifier_name' => 'task_id',
                'route_name' => 'task.rest.task-dismiss-reminder',
                'route_identifier_name' => 'task_dismiss_reminder_id',
                'hydrator' => 'Task\\Hydrator\\TaskHydrator',
            ),
            'Task\\V1\\Rest\\TaskDismissReminder\\TaskDismissReminderCollection' => array(
                'entity_identifier_name' => 'task_id',
                'route_name' => 'task.rest.task-dismiss-reminder',
                'route_identifier_name' => 'task_dismiss_reminder_id',
                'is_collection' => true,
            ),
            'Task\\Entity\\TaskEntity' => array(
                'entity_identifier_name' => 'task_id',
                'route_name' => 'task.rest.task-reminder',
                'route_identifier_name' => 'taskReminderId',
                'hydrator' => 'Task\\Hydrator\\TaskHydrator',
            ),
        ),
    ),
    'zf-content-validation' => array(),
    'input_filter_specs' => array(
        'Task\\V1\\Rest\\TaskDismissReminder\\Validator' => array(),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'Task\\V1\\Rest\\TaskReminder\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
            ),
            'Task\\V1\\Rest\\TaskDismissReminder\\Controller' => array(
                'collection' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
            ),
        ),
    ),
);
