<?php
return array(
    'module' => array(
        'EmailTemplate' => array(
            'name' => 'EmailTemplate',
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
        'factories' => array()
    ),
    'router' => array(
        'routes' => array()
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        )
    )
);