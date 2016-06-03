<?php
return array(
    'WorkorderPart' => array(
        'name' => 'WorkorderPart',
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
                'WorkorderPart\Service\PartServiceInterface' => 'WorkorderPart\Service\Factory\PartServiceFactory',
                'WorkorderPart\Mapper\PartMapperInterface' => 'WorkorderPart\Mapper\Factory\PartMapperFactory'
            )
        ),
    
        // router
            'router' => array(
                'routes' => array()
            ),
    
            // view manager
            'view_manager' => array(
                'template_path_stack' => array(
                    __DIR__ . '/../view'
                )
            )
);