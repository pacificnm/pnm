<?php
return array(
    'module' => array(
        'PayrollDeduction' => array(
            'name' => 'PayrollDeduction',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(
                    'payroll-deduction-create',
                    'payroll-deduction-delete',
                    'payroll-deduction-index',
                    'payroll-deduction-update',
                    'payroll-deduction-view'
                ),
                'administrator' => array()
            )
        )
    ),
    // controller
    'controllers' => array(
        'factories' => array(
            'PayrollDeduction\Controller\CreateController' => 'PayrollDeduction\Controller\Factory\CreateControllerFactory',
            'PayrollDeduction\Controller\DeleteController' => 'PayrollDeduction\Controller\Factory\DeleteControllerFactory',
            'PayrollDeduction\Controller\IndexController' => 'PayrollDeduction\Controller\Factory\IndexControllerFactory',
            'PayrollDeduction\Controller\UpdateController' => 'PayrollDeduction\Controller\Factory\UpdateControllerFactory',
            'PayrollDeduction\Controller\ViewController' => 'PayrollDeduction\Controller\Factory\ViewControllerFactory'
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'PayrollDeduction\Mapper\MysqlMapperInterface' => 'PayrollDeduction\Mapper\Factory\MysqlMapperFactory',
            'PayrollDeduction\Service\PayrollDeductionServiceInterface' => 'PayrollDeduction\Service\Factory\PayrollDeductionServiceFactory',
            'PayrollDeduction\Form\PayrollDeductionForm' => 'PayrollDeduction\Form\Factory\PayrollDeductionFormFactory'
        )
    ),
    // routes
    'router' => array(
        'routes' => array(
            'payroll-deduction-index' => array(
                'title' => 'Payroll Deduction',
                'pageTitle' => 'Payroll Deduction',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-deduction-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/payroll-deduction',
                    'defaults' => array(
                        'controller' => 'PayrollDeduction\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-deduction-create' => array(
                'title' => 'New Payroll Deduction',
                'pageTitle' => 'New Payroll Deduction',
                'pageSubTitle' => '',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-deduction-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/payroll-deduction/create',
                    'defaults' => array(
                        'controller' => 'PayrollDeduction\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-deduction-view' => array(
                'title' => 'View Payroll Deduction',
                'pageTitle' => 'View Payroll Deduction',
                'pageSubTitle' => '',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-deduction-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payroll-deduction/view/[:payrollDeductionId]',
                    'defaults' => array(
                        'controller' => 'PayrollDeduction\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-deduction-update' => array(
                'title' => 'Edit Payroll Deduction',
                'pageTitle' => 'Edit Payroll Deduction',
                'pageSubTitle' => '',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-deduction-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payroll-deduction/update/[:payrollDeductionId]',
                    'defaults' => array(
                        'controller' => 'PayrollDeduction\Controller\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-deduction-delete' => array(
                'title' => 'Delete Payroll Deduction',
                'pageTitle' => 'Delete Payroll Deduction',
                'pageSubTitle' => '',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-deduction-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payroll-deduction/delete/[:payrollDeductionId]',
                    'defaults' => array(
                        'controller' => 'PayrollDeduction\Controller\DeleteController',
                        'action' => 'index'
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
    // navigation
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Accounting',
                'route' => 'account-home',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Payroll Deduction',
                        'route' => 'payroll-deduction-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New',
                                'route' => 'payroll-deduction-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'View',
                                'route' => 'payroll-deduction-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit',
                                        'route' => 'payroll-deduction-update',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'payroll-deduction-delete',
                                        'useRouteMatch' => true
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
            'accounting' => array()

            
        )
    )
);