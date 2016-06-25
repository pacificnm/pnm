<?php
return array(
    'module' => array(
        'Acl' => array(
            'name' => 'Acl',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'acl-index',
                    'acl-create',
                    'acl-update',
                    'acl-delete',
                    'acl-view'
                )
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array()
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Acl\Service\AclServiceInterface' => 'Acl\Service\Factory\AclServiceFactory',
            'Acl\Mapper\AclMapperInterface' => 'Acl\Mapper\Factory\AclMapperFactory'
        )
    )
);