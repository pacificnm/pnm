<?php
return array(
    'module' => array(
        'PanoramaIssue' => array(
            'name' => 'PanoramaIssue',
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
            'PanoramaIssue\Controller\ConsoleController' => 'PanoramaIssue\Controller\Factory\ConsoleControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'PanoramaIssue\Mapper\MysqlMapperInterface' => 'PanoramaIssue\Mapper\Factory\MysqlMapperFactory',
            'PanoramaIssue\Service\PanoramaIssueServiceInterface' => 'PanoramaIssue\Service\Factory\PanoramaIssueServiceFactory'
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
                'panorama-issue-sync' => array(
                    'options' => array(
                        'route' => 'panorama-issue --sync',
                        'defaults' => array(
                            'controller' => 'PanoramaIssue\Controller\ConsoleController',
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