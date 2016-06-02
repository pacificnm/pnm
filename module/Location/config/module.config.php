<?php
return array(
    'Location' => array(
        'name' => 'Location',
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
            'Location\Service\LocationServiceInterface' => 'Location\Service\Factory\LocationServiceFactory',
            'Location\Mapper\LocationMapperInterface' => 'Location\Mapper\Factory\LocationMapperFactory',
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'location-view' => array(
                'title' => 'View Location',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/location/view/[:locationId]',
                    'defaults' => array(
                        'controller' => 'Location\Controller\View',
                        'action' => 'index'
                    )
                )
            ),
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);