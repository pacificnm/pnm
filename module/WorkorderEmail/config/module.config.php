<?php
return array(
    'module' => array(
        'WorkorderEmail' => array(
            'name' => 'WorkorderEmail',
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
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'WorkorderEmail\Mapper\MysqlMapperInterface' => 'WorkorderEmail\Mapper\Factory\MysqlMapperFactory',
            'WorkorderEmail\Service\WorkorderEmailServiceInterface' => 'WorkorderEmail\Service\Factory\WorkorderEmailServiceFactory',
        )
    ),
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        ),
        'template_map' => array(
            'work-order-create' => __DIR__ . '/../../../data/template/work-order-create.phtml',
        )
    )
);