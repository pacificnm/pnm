<?php
return array(
    'module' => array(
        'VendorAccount' => array(
            'name' => 'VendorAccount',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array()
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'VendorAccount\Service\AccountServiceInterface' => 'VendorAccount\Service\Factory\AccountServiceFactory',
            'VendorAccount\Mapper\AccountMapperInterface' => 'VendorAccount\Mapper\Factory\AccountMapperFactory'
        )
    )
);