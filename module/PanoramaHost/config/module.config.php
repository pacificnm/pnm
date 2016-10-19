<?php
return array(
    'module' => array(
        'PanoramaHost' => array(
            'name' => 'PanoramaHost',
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
                'PanoramaHost\Controller\ConsoleController' => 'PanoramaHost\Controller\Factory\ConsoleControllerFactory',
            )
        ),
    
        // service manager
    'service_manager' => array(
        'factories' => array(
            'PanoramaHost\Mapper\MysqlMapperInterface' => 'PanoramaHost\Mapper\Factory\MysqlMapperFactory',
            'PanoramaHost\Service\PanoramaHostServiceInterface' => 'PanoramaHost\Service\Factory\PanoramaHostServiceFactory',
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
                'panorama-host-sync' => array(
                    'options' => array(
                        'route' => 'panorama-host --sync',
                        'defaults' => array(
                            'controller' => 'PanoramaHost\Controller\ConsoleController',
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