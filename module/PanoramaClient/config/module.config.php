<?php
return array(
    'module' => array(
        'PanoramaClient' => array(
            'name' => 'PanoramaClient',
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
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'PanoramaClient\Controller\ConsoleController' => 'PanoramaClient\Controller\Factory\ConsoleControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'PanoramaClient\Mapper\MysqlMapperInterface' => 'PanoramaClient\Mapper\Factory\MysqlMapperFactory',
            'PanoramaClient\Service\PanoramaClientServiceInterface' => 'PanoramaClient\Service\Factory\PanoramaClientServiceFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array()
    ),
    
    // console routes
    'console' => array(
        'router' => array(
            'routes' => array(
                'panorama-client-sync' => array(
                    'options' => array(
                        'route' => 'panorama-client --sync',
                        'defaults' => array(
                            'controller' => 'PanoramaClient\Controller\ConsoleController',
                            'action' => 'sync'
                        )
                    )
                )
            )
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);