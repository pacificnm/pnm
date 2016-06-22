<?php
return array(
    'AccountLedger' => array(
        'name' => 'AccountLedger',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array()
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'AccountLedger\Service\LedgerServiceInterface' => 'AccountLedger\Service\Factory\LedgerServiceFactory',
            'AccountLedger\Mapper\LedgerMapperInterface' => 'AccountLedger\Mapper\Factory\LedgerMapperFactory'
        )
    )
);
