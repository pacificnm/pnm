<?php
return array(
    'module' => array(
        'CallLog' => array(
            'name' => 'CallLog',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    0 => 'call-log-index',
                    1 => 'call-log-view'
                ),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    0 => 'call-log-create',
                    1 => 'call-log-delete',
                    2 => 'call-log-update'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    'controllers' => array(
        'factories' => array(
            'CallLog\\Controller\\CreateController' => 'CallLog\\Controller\\Factory\\CreateControllerFactory',
            'CallLog\\Controller\\DeleteController' => 'CallLog\\Controller\\Factory\\DeleteControllerFactory',
            'CallLog\\Controller\\IndexController' => 'CallLog\\Controller\\Factory\\IndexControllerFactory',
            'CallLog\\Controller\\UpdateController' => 'CallLog\\Controller\\Factory\\UpdateControllerFactory',
            'CallLog\\Controller\\ViewController' => 'CallLog\\Controller\\Factory\\ViewControllerFactory'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'CallLog\\Service\\LogServiceInterface' => 'CallLog\\Service\\Factory\\LogServiceFactory',
            'CallLog\Mapper\MysqlMapperInterface' => 'CallLog\Mapper\Factory\MysqlMapperFactory',
            'CallLog\\Form\\LogForm' => 'CallLog\\Form\\Factory\\LogFormFactory',
            'CallLog\\V1\\Rest\\CallLog\\CallLogResource' => 'CallLog\\V1\\Rest\\CallLog\\CallLogResourceFactory',
            'CallLog\Listener\CallLogListener' => 'CallLog\Listener\Factory\CallLogListenerFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'call-log-index' => array(
                'title' => 'Client Call Logs',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'call-log-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/call-log',
                    'defaults' => array(
                        'controller' => 'CallLog\\Controller\\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'call-log-create' => array(
                'title' => 'New Call Log',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'call-log-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/call-log/create',
                    'defaults' => array(
                        'controller' => 'CallLog\\Controller\\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'call-log-update' => array(
                'title' => 'Edit Call Log',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'call-log-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/call-log/update/[:callLogId]',
                    'defaults' => array(
                        'controller' => 'CallLog\\Controller\\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'call-log-delete' => array(
                'title' => 'Delete Call Log',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'call-log-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/call-log/delete/[:callLogId]',
                    'defaults' => array(
                        'controller' => 'CallLog\\Controller\\DeleteController',
                        'action' => 'index'
                    )
                )
            ),
            'call-log-view' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/call-log/view/[:callLogId]',
                    'defaults' => array(
                        'controller' => 'CallLog\\Controller\\ViewController',
                        'action' => 'index'
                    )
                )
            ),
            'call-log.rest.call-log' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/call-log[/:callLogId]',
                    'defaults' => array(
                        'controller' => 'CallLog\\V1\\Rest\\CallLog\\Controller'
                    )
                )
            )
        )
    ),
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        )
    ),
    // view helper
    'view_helpers' => array(
        'factories' => array(
            'GetEmployeeCallLogs' => 'CallLog\View\Helper\Factory\GetEmployeeCallLogsFactory'
        )
    ),
    // navigation
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Clients',
                'route' => 'client-index',
                'resource' => 'client-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'View Client',
                        'route' => 'client-view',
                        'resource' => 'client-view',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Call Log',
                                'route' => 'call-log-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'New',
                                        'route' => 'call-log-create',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'View',
                                        'route' => 'call-log-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Edit',
                                                'route' => 'call-log-update',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'Delete',
                                                'route' => 'call-log-delete',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'New Note',
                                                'route' => 'call-log-note-create',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'Edit Note',
                                                'route' => 'call-log-note-update',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'Delete Note',
                                                'route' => 'call-log-note-delete',
                                                'useRouteMatch' => true
                                            )
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            )
        )

        
    ),
    // menu
    'menu' => array(
        'default' => array(
           'client' => array(
               array(
                   'label' => 'Call Log',
                   'icon' => 'fa fa-phone',
                   'route' => 'call-log-index',
                   'resource' => 'call-log-index',
                   'order' => 3,
                   'useRouteMatch' => true
               )
           )
        )
    ),
    // api
    'zf-versioning' => array(
        'uri' => array(
            0 => 'call-log.rest.call-log'
        )
    ),
    'zf-rest' => array(
        'CallLog\\V1\\Rest\\CallLog\\Controller' => array(
            'listener' => 'CallLog\\V1\\Rest\\CallLog\\CallLogResource',
            'route_name' => 'call-log.rest.call-log',
            'route_identifier_name' => 'call_log_id',
            'collection_name' => 'call_log',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
                3 => 'POST'
            ),
            'collection_http_methods' => array(
                0 => 'GET'
            ),
            'collection_query_whitelist' => array(
                0 => 'clientId',
                1 => 'employeeId'
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'CallLog\\V1\\Rest\\CallLog\\CallLogEntity',
            'collection_class' => 'CallLog\\V1\\Rest\\CallLog\\CallLogCollection',
            'service_name' => 'CallLog'
        )
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'CallLog\\V1\\Rest\\CallLog\\Controller' => 'HalJson'
        ),
        'accept_whitelist' => array(
            'CallLog\\V1\\Rest\\CallLog\\Controller' => array(
                0 => 'application/vnd.call-log.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json'
            )
        ),
        'content_type_whitelist' => array(
            'CallLog\\V1\\Rest\\CallLog\\Controller' => array(
                0 => 'application/vnd.call-log.v1+json',
                1 => 'application/json'
            )
        )
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'CallLog\\Entity\\LogEntity' => array(
                'entity_identifier_name' => 'call_log_id',
                'route_name' => 'call-log.rest.call-log',
                'route_identifier_name' => 'call_log_id',
                'hydrator' => 'CallLog\\Hydrator\\LogHydrator'
            ),
            'CallLog\\V1\\Rest\\CallLog\\CallLogCollection' => array(
                'entity_identifier_name' => 'call_log_id',
                'route_name' => 'call-log.rest.call-log',
                'route_identifier_name' => 'call_log_id',
                'is_collection' => true
            ),
            'CallLog\\V1\\Rest\\CallLog\\CallLogEntity' => array(
                'entity_identifier_name' => 'call_log_id',
                'route_name' => 'call-log.rest.call-log',
                'route_identifier_name' => 'call_log_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable'
            )
        )
    ),
    'zf-content-validation' => array(
        'CallLog\\V1\\Rest\\CallLog\\Controller' => array(
            'input_filter' => 'CallLog\\V1\\Rest\\CallLog\\Validator'
        )
    ),
    'input_filter_specs' => array(
        'CallLog\\V1\\Rest\\ClientCallLog\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogId'
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'clientId'
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'employeeId'
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogTime'
            ),
            4 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogDetail'
            ),
            5 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogRequireCallBack'
            ),
            6 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogWillCallBack'
            ),
            7 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogVoiceMail'
            ),
            8 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogUrgent'
            ),
            9 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogRead'
            ),
            10 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogCreatedBy'
            )
        ),
        'CallLog\\V1\\Rest\\CallLog\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogId'
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'clientId'
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'employeeId'
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogTime'
            ),
            4 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogDetail'
            ),
            5 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogRequireCallBack'
            ),
            6 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogWillCallBack'
            ),
            7 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogVoiceMail'
            ),
            8 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogUrgent'
            ),
            9 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogRead'
            ),
            10 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogCreatedBy'
            )
        )
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'CallLog\\V1\\Rest\\CallLog\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false
                ),
                'entity' => array(
                    'GET' => true,
                    'POST' => true,
                    'PUT' => true,
                    'PATCH' => false,
                    'DELETE' => true
                )
            )
        )
    )
);
