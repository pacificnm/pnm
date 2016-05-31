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
            ),
            'accountant' => array(),
            'administrator' => array(
                'employee-index',
                'employee-create',
                'employee-delete',
                'employee-update',
                'employee-view'
            )
        )
    ),
    
    'controllers' => array(
        'factories' => array(
            'Employee\Controller\Profile' => 'Employee\Controller\Factory\ProfileControllerFactory',
            'Employee\Controller\Index' => 'Employee\Controller\Factory\IndexControllerFactory',
            'Employee\Controller\View' => 'Employee\Controller\Factory\ViewControllerFactory',
            'Employee\Controller\Update' => 'Employee\Controller\Factory\UpdateControllerFactory',
            'Employee\Controller\Create' => 'Employee\Controller\Factory\CreateControllerFactory',
            'Employee\Controller\Delete' => 'Employee\Controller\Factory\DeleteControllerFactory',
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
            'employee-index' => array(
                'title' => 'Employees',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/employee',
                    'defaults' => array(
                        'controller' => 'Employee\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'employee-create' => array(
                'title' => 'Create Employee',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/employee/create',
                    'defaults' => array(
                        'controller' => 'Employee\Controller\Create',
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
            ),
            'employee-view' => array(
                'title' => 'View Employee',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/employee/view/[:employeeId]',
                    'defaults' => array(
                        'controller' => 'Employee\Controller\View',
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