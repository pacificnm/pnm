<?php
return array(
    'module' => array(
        'Email' => array(
            'name' => 'Email',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    'controllers' => array(
        'factories' => array()        
    ),
    'service_manager' => array(
        'factories' => array(
            'Email\Service\EmailServiceInterface' => 'Email\Service\Factory\EmailServiceFactory',
            'Email\Mapper\EmailMapperInterface' => 'Email\Mapper\Factory\EmailMapperFactory'
        )
    ),
    'router' => array(
        'routes' => array()
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        ),
        
    )
);