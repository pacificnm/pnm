<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
return array(
    'module' => array(
        'Employee' => array(
            'name' => 'Employee',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(
                    'employee-profile',
                    'employee-profile-update',
                    'employee-password',
                    'employee-time',
                    'employee-time-print'
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
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Employee\Controller\Profile' => 'Employee\Controller\Factory\ProfileControllerFactory',
            'Employee\Controller\Index' => 'Employee\Controller\Factory\IndexControllerFactory',
            'Employee\Controller\View' => 'Employee\Controller\Factory\ViewControllerFactory',
            'Employee\Controller\Update' => 'Employee\Controller\Factory\UpdateControllerFactory',
            'Employee\Controller\Create' => 'Employee\Controller\Factory\CreateControllerFactory',
            'Employee\Controller\Delete' => 'Employee\Controller\Factory\DeleteControllerFactory',
            'Employee\Controller\Time' => 'Employee\Controller\Factory\TimeControllerFactory',
            'Employee\Controller\TimePrint' => 'Employee\Controller\Factory\TimePrintControllerFactory',
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Employee\Mapper\EmployeeMapperInterface' => 'Employee\Mapper\Factory\EmployeeMapperFactory',
            'Employee\Service\EmployeeServiceInterface' => 'Employee\Service\Factory\EmployeeServiceFactory',
            'Employee\Form\PasswordForm' => 'Employee\Form\Factory\PasswordFormFactory',
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
            'employee-profile-update' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/employee/profile/update',
                    'defaults' => array(
                        'controller' => 'Employee\Controller\Update',
                        'action' => 'employee'
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
                    'route' => '/admin/employee/[:employeeId]/delete',
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
                    'route' => '/admin/employee/[:employeeId]/update',
                    'defaults' => array(
                        'controller' => 'Employee\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'employee-password' => array(
                'title' => 'Change Password',
                'type' => 'literal',
                'options' => array(
                    'route' => '/employee/profile/change-password',
                    'defaults' => array(
                        'controller' => 'Employee\Controller\Update',
                        'action' => 'password'
                    )
                )
            ),
            'employee-view' => array(
                'title' => 'View Employee',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/employee/[:employeeId]/view',
                    'defaults' => array(
                        'controller' => 'Employee\Controller\View',
                        'action' => 'index'
                    )
                )
            ),
            'employee-time' => array(
                'title' => 'Time Clock',
                'type' => 'segment',
                'options' => array(
                    'route' => '/employee/profile/time',
                    'defaults' => array(
                        'controller' => 'Employee\Controller\Time',
                        'action' => 'index'
                    )
                )
            ),
            'employee-time-print' => array(
                'title' => 'Time Clock',
                'type' => 'segment',
                'options' => array(
                    'route' => '/employee/profile/time/print',
                    'defaults' => array(
                        'controller' => 'Employee\Controller\TimePrint',
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