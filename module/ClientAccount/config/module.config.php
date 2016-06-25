<?php
return array(
    'module' => array(
        'ClientAccount' => array(
            'name' => 'ClientAccount',
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
        'factories' => array( )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'ClientAccount\Service\AccountServiceInterface' => 'ClientAccount\Service\Factory\AccountServiceFactory',
            'ClientAccount\Mapper\AccountMapperInterface' => 'ClientAccount\Mapper\Factory\AccountMapperFactory'
        )
    )
);