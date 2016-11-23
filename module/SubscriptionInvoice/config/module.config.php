<?php
return array(
    'module' => array(
        'SubscriptionInvoice' => array(
            'name' => 'SubscriptionInvoice',
            'version' => '2.5'
        )
    ),
    // controller
    'controllers' => array(
        'factories' => array()
    ),
    // service manager
    'service_manager' => array(
        'factories' => array(
            'SubscriptionInvoice\Mapper\MysqlMapperInterface' => 'SubscriptionInvoice\Mapper\Factory\MysqlMapperFactory',
            'SubscriptionInvoice\Service\SubscriptionInvoiceServiceInterface' => 'SubscriptionInvoice\Service\Factory\SubscriptionInvoiceServiceFactory',
        )
    ),
    // routes
    'router' => array(
        'routes' => array()
    ),
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        )
    ),
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'GetSubscriptionInvoices' => 'SubscriptionInvoice\View\Helper\Factory\GetSubscriptionInvoicesFactory'
        )
    ),
    // navigation
    'navigation' => array(
        'default' => array()
    ),
    // menu
    'menu' => array(
        'default' => array()
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