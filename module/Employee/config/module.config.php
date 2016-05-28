<?php
return array(
    'Employee' => array(
        'name' => 'Employee',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'employee-profile',
                'employee-delete',
                'employee-update'
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    'controllers' => array(
        'factories' => array(
            'Employee\Controller\Profile' => 'Employee\Controller\Factory\ProfileControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Employee\Mapper\EmployeeMapperInterface' => 'Employee\Mapper\Factory\EmployeeMapperFactory',
            'Employee\Service\EmployeeServiceInterface' => 'Employee\Service\Factory\EmployeeServiceFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'employee-profile' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/employee/profile',
                    'defaults' => array(
                        'controller' => 'Employee\Controller\Profile',
                        'action' => 'index'
                    )
                )
            ),
            'employee-delete' => array(
                'title' => 'Delete Employee',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/employee/delete/[:employeeId]',
                    'defaults' => array(
                        'controller' => 'Employee\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'employee-update' => array(
                'title' => 'Edit Employee',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/employee/update/[:employeeId]',
                    'defaults' => array(
                        'controller' => 'Employee\Controller\Update',
                        'action' => 'index'
                    )
                )
            )
        )
        
    ),
    
    // view helpers
    'view_helpers' => array(
        'invokables' => array(
            'EmployeeAsideMenu' => 'Employee\View\Helper\EmployeeAsideMenu'
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);