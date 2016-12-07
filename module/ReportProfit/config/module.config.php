<?php
return array(
    'module' => array(
        'ReportProfit' => array(
            'name' => 'ReportProfit',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(
                    'report-profit-index'
                ),
                'administrator' => array()
            )
        )
    ),
    // controller
    'controllers' => array(
        'factories' => array(
            'ReportProfit\Controller\IndexController' => 'ReportProfit\Controller\Factory\IndexControllerFactory',
            'ReportProfit\Controller\ConsoleController' => 'ReportProfit\Controller\Factory\ConsoleControllerFactory',
        )
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'ReportProfit\Mapper\MysqlMapperInterface' => 'ReportProfit\Mapper\Factory\MysqlMapperFactory',
            'ReportProfit\Service\ReportProfitServiceInterface' => 'ReportProfit\Service\Factory\ReportProfitServiceFactory'
        )
    ),
    // routes
    'router' => array(
        'routes' => array(
            'report-profit-index' => array(
                'title' => 'Profit Report',
                'pageTitle' => 'Profit Report',
                'pageSubTitle' => '',
                'activeMenuItem' => 'account',
                'activeSubMenuItem' => 'report-profit-index',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/report-profit',
                    'defaults' => array(
                        'controller' => 'ReportProfit\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    // console routes
    'console' => array(
        'router' => array(
            'routes' => array(
                'report-profit-console-index' => array(
                    'options' => array(
                        'route' => 'report-profit --run',
                        'defaults' => array(
                            'controller' => 'ReportProfit\Controller\ConsoleController',
                            'action' => 'index'
                        )
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
                        'label' => 'Profit Report',
                        'route' => 'report-profit-index',
                        'useRouteMatch' => true
                    )
                )
                
            )
        )
    )
    ,
    // menu
    'menu' => array(
        'default' => array(
            'accounting' => array(
                array(
                    'label' => 'Profit Report',
                    'icon' => 'fa fa-shopping-cart',
                    'route' => 'report-profit-index',
                    'resource' => 'report-profit-index',
                    'order' => 9
                )
            )
        )
    )
);