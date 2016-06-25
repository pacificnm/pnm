<?php
return array(
    'module' => array(
        'History' => array(
            'name' => 'History',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array()
    ),
    
    // controller plugins
    'controller_plugins' => array(
        'factories' => array(
            'SetHistory' => 'History\Controller\Plugin\Factory\SetHistoryFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'History\Mapper\HistoryMapperInterface' => 'History\Mapper\Factory\HistoryMapperFactory',
            'History\Service\HistoryServiceInterface' => 'History\Service\Factory\HistoryServiceFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array()
    ),
    
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'getAuthHistory' => 'History\View\Helper\Factory\GetAuthHistoryFactory'
        ),
        'invokables' => array()
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);