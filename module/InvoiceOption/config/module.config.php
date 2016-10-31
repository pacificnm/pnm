<?php
return array(
    'module' => array(
        'InvoiceOption' => array(
            'name' => 'InvoiceOption',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'invoice-option-index',
                    'invoice-option-update'
                )
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'InvoiceOption\Controller\Index' => 'InvoiceOption\Controller\Factory\IndexControllerFactory',
            'InvoiceOption\Controller\Update' => 'InvoiceOption\Controller\Factory\UpdateControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'InvoiceOption\Mapper\OptionMapperInterface' => 'InvoiceOption\Mapper\Factory\OptionMapperFactory',
            'InvoiceOption\Service\OptionServiceInterface' => 'InvoiceOption\Service\Factory\OptionServiceFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'invoice-option-index' => array(
                'title' => 'Payment Options',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/invoice-options',
                    'defaults' => array(
                        'controller' => 'InvoiceOption\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'invoice-option-update' => array(
                'title' => 'Payment Options',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/invoice-options/update',
                    'defaults' => array(
                        'controller' => 'InvoiceOption\Controller\Update',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    // navigation
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Admin',
                'route' => 'admin-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Invoice Options',
                        'route' => 'invoice-option-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Edit',
                                'route' => 'invoice-option-update',
                                'useRouteMatch' => true
                            ),
                        )
                    )
                )
            )
        )
    ),
    // menu
    'menu' => array(
        'default' => array(
            array(
                'admin' => array(
                    'title' => 'Admin',
                    'icon' => 'fa fa-gears',
                    'route' => 'admin-index',
                    'submenu' => array(
                        array(
                            'invoice-option-index' => array(
                                'title' => 'Invoice Options',
                                'icon' => 'fa fa-dollar',
                                'route' => 'invoice-option-index'
                            )
                        )
                    )
                )
            )
        )
        
    ),
    // acl
    'acl' => array(
        'default' => array(
            array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    )
);