<?php
return array(
    'module' => array(
        'Payroll' => array(
            'name' => 'Payroll',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(
                    'payroll-create',
                    'payroll-delete',
                    'payroll-index',
                    'payroll-print',
                    'payroll-update',
                    'payroll-view',
                ),
                'administrator' => array()
            )
        )
    ),
    // controller
    'controllers' => array(
        'factories' => array(
            'Payroll\Controller\CreateController' => 'Payroll\Controller\Factory\CreateControllerFactory',
            'Payroll\Controller\DeleteController' => 'Payroll\Controller\Factory\DeleteControllerFactory',
            'Payroll\Controller\IndexController' => 'Payroll\Controller\Factory\IndexControllerFactory',
            'Payroll\Controller\PrintController' => 'Payroll\Controller\Factory\PrintControllerFactory',
            'Payroll\Controller\UpdateController' => 'Payroll\Controller\Factory\UpdateControllerFactory',
            'Payroll\Controller\ViewController' => 'Payroll\Controller\Factory\ViewControllerFactory'
        )
        
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Payroll\Mapper\MysqlMapperInterface' => 'Payroll\Mapper\Factory\MysqlMapperFactory',
            'Payroll\Service\PayrollServiceInterface' => 'Payroll\Service\Factory\PayrollServiceFactory',
            'Payroll\Form\PayrollForm' => 'Payroll\Form\Factory\PayrollFormFactory',
        )
    ),
    // routes
    'router' => array(
        'routes' => array(
            'payroll-index' => array(
                'title' => 'Payroll',
                'pageTitle' => 'Payroll',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/payroll',
                    'defaults' => array(
                        'controller' => 'Payroll\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-create' => array(
                'title' => 'New Payroll',
                'pageTitle' => 'New Payroll',
                'pageSubTitle' => '',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/payroll/create',
                    'defaults' => array(
                        'controller' => 'Payroll\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-print' => array(
                'title' => 'Print Payroll',
                'pageTitle' => 'Print Payroll',
                'pageSubTitle' => '',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payroll/print/[:payrollId]',
                    'defaults' => array(
                        'controller' => 'Payroll\Controller\PrintController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-view' => array(
                'title' => 'View Payroll',
                'pageTitle' => 'View Payroll',
                'pageSubTitle' => '',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payroll/view/[:payrollId]',
                    'defaults' => array(
                        'controller' => 'Payroll\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-update' => array(
                'title' => 'Edit Payroll',
                'pageTitle' => 'Edit Payroll',
                'pageSubTitle' => '',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payroll/update/[:payrollId]',
                    'defaults' => array(
                        'controller' => 'Payroll\Controller\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'payroll-delete' => array(
                'title' => 'Delete Payroll',
                'pageTitle' => 'Delete Payroll',
                'pageSubTitle' => '',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'payroll-index',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/payroll/delete/[:payrollId]',
                    'defaults' => array(
                        'controller' => 'Payroll\Controller\DeleteController',
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
                        'label' => 'Payroll',
                        'route' => 'payroll-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New',
                                'route' => 'payroll-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'View',
                                'route' => 'payroll-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit',
                                        'route' => 'payroll-update',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'payroll-delete',
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
                    'label' => 'Payroll',
                    'icon' => 'fa fa-dollar',
                    'route' => 'payroll-index',
                    'resource' => 'payroll-index',
                    'order' => 5
                )
            )
        )
    )
);