<?php
return array(
    'module' => array(
        'AclRole' => array(
            'name' => 'AclRole',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'acl-role-index',
                    'acl-role-create',
                    'acl-role-update',
                    'acl-role-delete',
                    'acl-role-view'
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
            'AclRole\Service\RoleServiceInterface' => 'AclRole\Service\Factory\RoleServiceFactory',
            'AclRole\Mapper\RoleMapperInterface' => 'AclRole\Mapper\Factory\RoleMapperFactory'
        )
    )
);