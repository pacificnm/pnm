<?php
return array(
    'module' => array(
        'Employee' => array(
            'name' => 'Employee',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
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
            'employeeMenu' => 'Employee\\Service\\Factory\\MenuServiceFactory',
            'Employee\\V1\\Rest\\Employee\\EmployeeResource' => 'Employee\\V1\\Rest\\Employee\\EmployeeResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'employee-profile' => array(
                'type' => 'literal',
                'title' => 'My Profile',
                'pageTitle' => 'My Profile',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'employee',
                'activeSubMenuItem' => 'employee-profile',
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
                'title' => 'Edit My Profile',
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
            'employee.rest.employee' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/employee[/:employeeId]',
                    'defaults' => array(
                        'controller' => 'Employee\\V1\\Rest\\Employee\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'EmployeeAsideMenu' => 'Employee\\View\\Helper\\Factory\\EmployeeAsideMenuFactory',
            'GetEmployeeDetails' => 'Employee\\View\\Helper\\Factory\\GetEmployeeDetailsFactory',
        ),
        'invokables' => array(),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view',
        ),
    ),
    'navigation' => array(
        'default' => array(
            0 => array(
                'label' => 'Admin',
                'route' => 'admin-index',
                'useRouteMatch' => true,
                'pages' => array(
                    0 => array(
                        'label' => 'Employee',
                        'route' => 'employee-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            0 => array(
                                'label' => 'New Employee',
                                'route' => 'employee-create',
                                'useRouteMatch' => true,
                            ),
                            1 => array(
                                'label' => 'View Employee',
                                'route' => 'employee-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    0 => array(
                                        'label' => 'Edit Employee',
                                        'route' => 'employee-update',
                                        'useRouteMatch' => true,
                                    ),
                                    1 => array(
                                        'label' => 'Delete Employee',
                                        'route' => 'employee-delete',
                                        'useRouteMatch' => true,
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            1 => array(
                'label' => 'My Profile',
                'route' => 'employee-profile',
                'useRouteMatch' => true,
                'pages' => array(
                    0 => array(
                        'label' => 'Edit',
                        'route' => 'employee-profile-update',
                        'useRouteMatch' => true,
                    ),
                    1 => array(
                        'label' => 'Change Password',
                        'route' => 'employee-password',
                        'useRouteMatch' => true,
                    ),
                    2 => array(
                        'label' => 'Time Clock',
                        'route' => 'employee-time',
                        'useRouteMatch' => true,
                    ),
                ),
            ),
        ),
    ),
    'menu' => array(
        'default' => array(
            'admin' => array(
                0 => array(
                    'label' => 'Employees',
                    'icon' => 'fa fa-user',
                    'route' => 'employee-index',
                    'resource' => 'employee-index',
                    'order' => 5,
                ),
            ),
            'employee' => array(
                0 => array(
                    'label' => 'Home',
                    'icon' => 'fa fa-home',
                    'route' => 'employee-profile',
                    'resource' => 'employee-profile',
                    'order' => 1,
                ),
            ),
        ),
    ),
    'acl' => array(
        'default' => array(
            0 => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'employee.rest.employee-time',
            1 => 'employee.rest.employee',
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
        'Employee\\V1\\Rest\\Employee\\Controller' => array(
            'listener' => 'Employee\\V1\\Rest\\Employee\\EmployeeResource',
            'route_name' => 'employee.rest.employee',
            'route_identifier_name' => 'employeeId',
            'collection_name' => 'employee',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(
                0 => 'status',
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Employee\\Entity\\EmployeeEntity',
            'collection_class' => 'Employee\\V1\\Rest\\Employee\\EmployeeCollection',
            'service_name' => 'Employee',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Employee\\V1\\Rest\\EmployeeTime\\Controller' => 'HalJson',
            'Employee\\V1\\Rest\\Employee\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Employee\\V1\\Rest\\EmployeeTime\\Controller' => array(
                0 => 'application/vnd.employee.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Employee\\V1\\Rest\\Employee\\Controller' => array(
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
            'Employee\\V1\\Rest\\Employee\\Controller' => array(
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
            'Employee\\V1\\Rest\\Employee\\EmployeeEntity' => array(
                'entity_identifier_name' => 'employeeId',
                'route_name' => 'employee.rest.employee',
                'route_identifier_name' => 'employee_id',
                'hydrator' => 'Employee\\Hydrator\\EmployeeHydrator',
            ),
            'Employee\\V1\\Rest\\Employee\\EmployeeCollection' => array(
                'entity_identifier_name' => 'employeeId',
                'route_name' => 'employee.rest.employee',
                'route_identifier_name' => 'employeeId',
                'is_collection' => true,
            ),
            'Employee\\Entity\\EmployeeEntity' => array(
                'entity_identifier_name' => 'employeeId',
                'route_name' => 'employee.rest.employee',
                'route_identifier_name' => 'employeeId',
                'hydrator' => 'Employee\\Hydrator\\EmployeeHydrator',
            ),
        ),
    ),
);
