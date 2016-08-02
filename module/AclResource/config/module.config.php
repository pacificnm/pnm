<?php
return array(
    'module' => array(
        'AclResource' => array(
            'name' => 'AclResource',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'acl-resource-index',
                    'acl-resource-create',
                    'acl-resource-update',
                    'acl-resource-delete',
                    'acl-resource-view'
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
            'AclResource\Service\ResourceServiceInterface' => 'AclResource\Service\Factory\ResourceServiceFactory',
            'AclResource\Mapper\ResourceMapperInterface' => 'AclResource\Mapper\Factory\ResourceMapperFactory'
        )
    )
);
