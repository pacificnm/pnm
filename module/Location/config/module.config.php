<?php
return array(
    'Location' => array(
        'name' => 'Location',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'location-update',
                'location-view',
                'location-create'
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Location\Controller\Update' => 'Location\Controller\Factory\UpdateControllerFactory',
            'Location\Controller\View' => 'Location\Controller\Factory\ViewControllerFactory',
            'Location\Controller\Create' => 'Location\Controller\Factory\CreateControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Location\Service\LocationServiceInterface' => 'Location\Service\Factory\LocationServiceFactory',
            'Location\Mapper\LocationMapperInterface' => 'Location\Mapper\Factory\LocationMapperFactory',
            'Location\Form\LocationForm' => 'Location\Form\Factory\LocationFormFactory'
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
            
            'location-update' => array(
                'title' => 'View Location',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/location/update/[:locationId]',
                    'defaults' => array(
                        'controller' => 'Location\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            
            'location-create' => array(
                'title' => 'New Location',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/location/create',
                    'defaults' => array(
                        'controller' => 'Location\Controller\Create',
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