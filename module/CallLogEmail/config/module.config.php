<?php
return array(
    'module' => array(
        'CallLogEmail' => array(
            'name' => 'CallLogEmail',
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
            'CallLogEmail\Mapper\MysqlMapperInterface' => 'CallLogEmail\Mapper\Factory\MysqlMapperFactory',
            'CallLogEmail\Service\CallLogEmailServiceInterface' => 'CallLogEmail\Service\Factory\CallLogEmailServiceFactory',
            'CallLogEmail\Listener\CallLogEmailListener' => 'CallLogEmail\Listener\Factory\CallLogEmailListenerFactory'
        )
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        ),
        'template_map' => array(
            'call-log-create' => __DIR__ . '/../../../data/template/call-log-create.phtml',
        )
    )
);