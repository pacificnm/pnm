<?php
return array(
    'module' => array(
        'PayrollTax' => array(
            'name' => 'PayrollTax',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'payroll-tax-index',
                    'payroll-tax-create',
                    'payroll-tax-delete',
                    'payroll-tax-update',
                    'payroll-tax-view'
                )
            )
        )
    ),
    // controller
    'controllers' => array(
        'factories' => array(
            'PayrollTax\Controller\CreateController' => 'PayrollTax\Controller\Factory\CreateControllerFactory',
            'PayrollTax\Controller\DeleteController' => 'PayrollTax\Controller\Factory\DeleteControllerFactory',
            'PayrollTax\Controller\IndexController' => 'PayrollTax\Controller\Factory\IndexControllerFactory',
            'PayrollTax\Controller\UpdateController' => 'PayrollTax\Controller\Factory\UpdateControllerFactory',
            'PayrollTax\Controller\ViewController' => 'PayrollTax\Controller\Factory\ViewControllerFactory'
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'PayrollTax\Mapper\MysqlMapperInterface' => 'PayrollTax\Mapper\Factory\MysqlMapperFactory',
            'PayrollTax\Service\PayrollTaxServiceInterface' => 'PayrollTax\Service\Factory\PayrollTaxServiceFactory'
        )
    ),
    // routes
    'router' => array(
        'routes' => array(
            'payroll-tax-index' => array(
                'title' => 'Payroll Tax',
                'pageTitle' => 'Payroll Tax',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-tax-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/payroll-tax',
                    'defaults' => array(
                        'controller' => 'PayrollTax\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-tax-create' => array(
                'title' => 'New Payroll Tax',
                'pageTitle' => 'New Payroll Tax',
                'pageSubTitle' => 'New',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-tax-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/payroll-tax/create',
                    'defaults' => array(
                        'controller' => 'PayrollTax\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-tax-view' => array(
                'title' => 'View Payroll Tax',
                'pageTitle' => 'View Payroll Tax',
                'pageSubTitle' => 'View',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-tax-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payroll-tax/view/[:payrollTaxId]',
                    'defaults' => array(
                        'controller' => 'PayrollTax\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-tax-update' => array(
                'title' => 'Edit Payroll Tax',
                'pageTitle' => 'Edit Payroll Tax',
                'pageSubTitle' => 'Edit',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-tax-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payroll-tax/update/[:payrollTaxId]',
                    'defaults' => array(
                        'controller' => 'PayrollTax\Controller\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-tax-delete' => array(
                'title' => 'Delete Payroll Tax',
                'pageTitle' => 'Delete Payroll Tax',
                'pageSubTitle' => 'Delete',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-tax-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payroll-tax/delete/[:payrollTaxId]',
                    'defaults' => array(
                        'controller' => 'PayrollTax\Controller\DeleteController',
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
                        'label' => 'Payroll Tax',
                        'route' => 'payroll-tax-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New',
                                'route' => 'payroll-tax-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'View',
                                'route' => 'payroll-tax-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit',
                                        'route' => 'payroll-tax-update',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'payroll-tax-delete',
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
            'accounting' => array(
                array(
                    'label' => 'Payroll Tax',
                    'icon' => 'fa fa-dollar',
                    'route' => 'payroll-tax-index',
                    'resource' => 'payroll-tax-index',
                    'order' => 7
                )
            )
        )
    )
);