<?php
return array(
    'module' => array(
        'EmployeeEmail' => array(
            'name' => 'EmployeeEmail',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    'controllers' => array(
        'factories' => array()
    ),
    'service_manager' => array(
        'factories' => array(
            'EmployeeEmail\Service\EmployeeEmailServiceInterface' => 'EmployeeEmail\Service\Factory\EmployeeEmailServiceFactory',
            'EmployeeEmail\Mapper\EmployeeEmailMapperInterface' => 'EmployeeEmail\Mapper\Factory\EmployeeEmailMapperFactory'
        )
        
    ),
    'router' => array(
        'routes' => array()
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        )
    )
);