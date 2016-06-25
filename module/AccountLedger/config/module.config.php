<?php
return array(
    'module' => array(
        'AccountLedger' => array(
            'name' => 'AccountLedger',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(),
                'accountant' => array(
                    'account-ledger-view'
                ),
                'administrator' => array()
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'AccountLedger\Controller\View' => 'AccountLedger\Controller\Factory\ViewControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'AccountLedger\Service\LedgerServiceInterface' => 'AccountLedger\Service\Factory\LedgerServiceFactory',
            'AccountLedger\Mapper\LedgerMapperInterface' => 'AccountLedger\Mapper\Factory\LedgerMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'account-ledger-view' => array(
                'title' => 'View Account',
                'type' => 'segment',
                'options' => array(
                    'route' => '/account/[:accountId]/ledger[:accountLedgerId]/view',
                    'defaults' => array(
                        'controller' => 'AccountLedger\Controller\View',
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
    )
);
