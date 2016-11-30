<?php
return array(
    'module' => array(
        'PayrollDeductionType' => array(
            'name' => 'PayrollDeductionType',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'payroll-deduction-type-index',
                    'payroll-deduction-type-create',
                    'payroll-deduction-type-delete',
                    'payroll-deduction-type-update',
                    'payroll-deduction-type-view'
                )
            )
        )
    ),
    // controller
    'controllers' => array(
        'factories' => array(
            'PayrollDeductionType\Controller\IndexController' => 'PayrollDeductionType\Controller\Factory\IndexControllerFactory',
            'PayrollDeductionType\Controller\CreateController' => 'PayrollDeductionType\Controller\Factory\CreateControllerFactory',
            'PayrollDeductionType\Controller\DeleteController' => 'PayrollDeductionType\Controller\Factory\DeleteControllerFactory',
            'PayrollDeductionType\Controller\UpdateController' => 'PayrollDeductionType\Controller\Factory\UpdateControllerFactory',
            'PayrollDeductionType\Controller\ViewController' => 'PayrollDeductionType\Controller\Factory\ViewControllerFactory',
            
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'PayrollDeductionType\Mapper\MysqlMapperInterface' => 'PayrollDeductionType\Mapper\Factory\MysqlMapperFactory',
            'PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface' => 'PayrollDeductionType\Service\Factory\PayrollDeductionTypeServiceFactory',
            
        )
    ),
    // routes
    'router' => array(
        'routes' => array(
            'payroll-deduction-type-index' => array(
                'title' => 'Payroll Deduction Types',
                'pageTitle' => 'Payroll Deduction Types',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-deduction-type-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/payroll-deduction-type',
                    'defaults' => array(
                        'controller' => 'PayrollDeductionType\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-deduction-type-create' => array(
                'title' => 'New Payroll Deduction Types',
                'pageTitle' => 'New Payroll Deduction Types',
                'pageSubTitle' => '',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-deduction-type-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/payroll-deduction-type/create',
                    'defaults' => array(
                        'controller' => 'PayrollDeductionType\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-deduction-type-view' => array(
                'title' => 'View Payroll Deduction Types',
                'pageTitle' => 'View Payroll Deduction Types',
                'pageSubTitle' => '',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-deduction-type-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payroll-deduction-type/view/[:payrollDeductionTypeId]',
                    'defaults' => array(
                        'controller' => 'PayrollDeductionType\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-deduction-type-update' => array(
                'title' => 'Edit Payroll Deduction Types',
                'pageTitle' => 'Edit Payroll Deduction Types',
                'pageSubTitle' => '',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-deduction-type-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payroll-deduction-type/update/[:payrollDeductionTypeId]',
                    'defaults' => array(
                        'controller' => 'PayrollDeductionType\Controller\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-deduction-type-delete' => array(
                'title' => 'Delete Payroll Deduction Types',
                'pageTitle' => 'Delete Payroll Deduction Types',
                'pageSubTitle' => '',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-deduction-type-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payroll-deduction-type/delete/[:payrollDeductionTypeId]',
                    'defaults' => array(
                        'controller' => 'PayrollDeductionType\Controller\DeleteController',
                        'action' => 'index'
                    )
                )
            ),
        )
    ),
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        )
    ),
    // navigation
    'navigation' => array(
        'default' => array(
            array(
                 'label' => 'Accounting',
                'route' => 'account-home',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Payroll Deduction Types',
                        'route' => 'payroll-deduction-type-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New',
                                'route' => 'payroll-deduction-type-create',
                                'useRouteMatch' => true,
                            ),
                            array(
                                'label' => 'View',
                                'route' => 'payroll-deduction-type-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit',
                                        'route' => 'payroll-deduction-type-update',
                                        'useRouteMatch' => true,
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'payroll-deduction-type-delete',
                                        'useRouteMatch' => true,
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
            'accounting' => array(
                array(
                    'label' => 'Payroll Deduction Types',
                    'icon' => 'fa fa-dollar',
                    'route' => 'payroll-deduction-type-index',
                    'resource' => 'payroll-deduction-type-index',
                    'order' => 12
                )
            )
        )
    )
);