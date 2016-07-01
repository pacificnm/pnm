<?php
return array(
    'module' => array(
        'Employee' => array(
            'name' => 'Employee',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(
                    0 => 'employee-profile',
                    1 => 'employee-profile-update',
                    2 => 'employee-password',
                    3 => 'employee-time',
                    4 => 'employee-time-print',
                    5 => 'employee-calendar',
                ),
                'accountant' => array(),
                'administrator' => array(
                    0 => 'employee-index',
                    1 => 'employee-create',
                    2 => 'employee-delete',
                    3 => 'employee-update',
                    4 => 'employee-view',
                ),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Employee\\Controller\\Profile' => 'Employee\\Controller\\Factory\\ProfileControllerFactory',
            'Employee\\Controller\\Index' => 'Employee\\Controller\\Factory\\IndexControllerFactory',
            'Employee\\Controller\\View' => 'Employee\\Controller\\Factory\\ViewControllerFactory',
            'Employee\\Controller\\Update' => 'Employee\\Controller\\Factory\\UpdateControllerFactory',
            'Employee\\Controller\\Create' => 'Employee\\Controller\\Factory\\CreateControllerFactory',
            'Employee\\Controller\\Delete' => 'Employee\\Controller\\Factory\\DeleteControllerFactory',
            'Employee\\Controller\\Time' => 'Employee\\Controller\\Factory\\TimeControllerFactory',
            'Employee\\Controller\\TimePrint' => 'Employee\\Controller\\Factory\\TimePrintControllerFactory',
            'Employee\\Controller\\Calendar' => 'Employee\\Controller\\Factory\\CalendarControllerFactory',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Employee\\Mapper\\EmployeeMapperInterface' => 'Employee\\Mapper\\Factory\\EmployeeMapperFactory',
            'Employee\\Service\\EmployeeServiceInterface' => 'Employee\\Service\\Factory\\EmployeeServiceFactory',
            'Employee\\Form\\PasswordForm' => 'Employee\\Form\\Factory\\PasswordFormFactory',
            'Employee\\V1\\Rest\\EmployeeTime\\EmployeeTimeResource' => 'Employee\\V1\\Rest\\EmployeeTime\\EmployeeTimeResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'employee-profile' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/employee/profile',
                    'defaults' => array(
                        'controller' => 'Employee\\Controller\\Profile',
                        'action' => 'index',
                    ),
                ),
            ),
            'employee-profile-update' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/employee/profile/update',
                    'defaults' => array(
                        'controller' => 'Employee\\Controller\\Update',
                        'action' => 'employee',
                    ),
                ),
            ),
            'employee-index' => array(
                'title' => 'Employees',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/employee',
                    'defaults' => array(
                        'controller' => 'Employee\\Controller\\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'employee-create' => array(
                'title' => 'Create Employee',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/employee/create',
                    'defaults' => array(
                        'controller' => 'Employee\\Controller\\Create',
                        'action' => 'index',
                    ),
                ),
            ),
            'employee-delete' => array(
                'title' => 'Delete Employee',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/employee/[:employeeId]/delete',
                    'defaults' => array(
                        'controller' => 'Employee\\Controller\\Delete',
                        'action' => 'index',
                    ),
                ),
            ),
            'employee-update' => array(
                'title' => 'Edit Employee',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/employee/[:employeeId]/update',
                    'defaults' => array(
                        'controller' => 'Employee\\Controller\\Update',
                        'action' => 'index',
                    ),
                ),
            ),
            'employee-password' => array(
                'title' => 'Change Password',
                'type' => 'literal',
                'options' => array(
                    'route' => '/employee/profile/change-password',
                    'defaults' => array(
                        'controller' => 'Employee\\Controller\\Update',
                        'action' => 'password',
                    ),
                ),
            ),
            'employee-view' => array(
                'title' => 'View Employee',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/employee/[:employeeId]/view',
                    'defaults' => array(
                        'controller' => 'Employee\\Controller\\View',
                        'action' => 'index',
                    ),
                ),
            ),
            'employee-time' => array(
                'title' => 'Time Clock',
                'type' => 'segment',
                'options' => array(
                    'route' => '/employee/profile/time',
                    'defaults' => array(
                        'controller' => 'Employee\\Controller\\Time',
                        'action' => 'index',
                    ),
                ),
            ),
            'employee-time-print' => array(
                'title' => 'Time Clock',
                'type' => 'segment',
                'options' => array(
                    'route' => '/employee/profile/time/print',
                    'defaults' => array(
                        'controller' => 'Employee\\Controller\\TimePrint',
                        'action' => 'index',
                    ),
                ),
            ),
            'employee-calendar' => array(
                'title' => 'Time Clock',
                'type' => 'segment',
                'options' => array(
                    'route' => '/employee/profile/calendar',
                    'defaults' => array(
                        'controller' => 'Employee\\Controller\\Calendar',
                        'action' => 'index',
                    ),
                ),
            ),
            'employee.rest.employee-time' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/employee/employee-time[/:employee_id]',
                    'defaults' => array(
                        'controller' => 'Employee\\V1\\Rest\\EmployeeTime\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'EmployeeAsideMenu' => 'Employee\\View\\Helper\\EmployeeAsideMenu',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view',
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'employee.rest.employee-time',
        ),
    ),
    'zf-rest' => array(
        'Employee\\V1\\Rest\\EmployeeTime\\Controller' => array(
            'listener' => 'Employee\\V1\\Rest\\EmployeeTime\\EmployeeTimeResource',
            'route_name' => 'employee.rest.employee-time',
            'route_identifier_name' => 'employee_id',
            'collection_name' => 'employee_time',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(
                0 => 'start',
                1 => 'end',
                2 => 'employee',
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Employee\\V1\\Rest\\EmployeeTime\\EmployeeTimeEntity',
            'collection_class' => 'Employee\\V1\\Rest\\EmployeeTime\\EmployeeTimeCollection',
            'service_name' => 'EmployeeTime',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Employee\\V1\\Rest\\EmployeeTime\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Employee\\V1\\Rest\\EmployeeTime\\Controller' => array(
                0 => 'application/vnd.employee.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'Employee\\V1\\Rest\\EmployeeTime\\Controller' => array(
                0 => 'application/vnd.employee.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Employee\\V1\\Rest\\EmployeeTime\\EmployeeTimeEntity' => array(
                'entity_identifier_name' => 'employee_id',
                'route_name' => 'employee.rest.employee-time',
                'route_identifier_name' => 'employee_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'Employee\\V1\\Rest\\EmployeeTime\\EmployeeTimeCollection' => array(
                'entity_identifier_name' => 'employee_id',
                'route_name' => 'employee.rest.employee-time',
                'route_identifier_name' => 'employee_id',
                'is_collection' => true,
            ),
        ),
    ),
);
