<?php
return array(
    'module' => array(
        'Panorama' => array(
            'name' => 'Panorama',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'panorama-index',
                    'panorama-view',
                    'panorama-view-device',
                    'panorama-user'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Panorama\Controller\IndexController' => 'Panorama\Controller\Factory\IndexControllerFactory',
            'Panorama\Controller\ViewController' => 'Panorama\Controller\Factory\ViewControllerFactory',
            'Panorama\Controller\DeviceController' => 'Panorama\Controller\Factory\DeviceControllerFactory',
            'Panorama\Controller\UserController' => 'Panorama\Controller\Factory\UserControllerFactory',
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Panorama\Service\MspServiceInterface' => 'Panorama\Service\Factory\MspServiceFactory',
            'Panorama\Service\IssueServiceInterface' => 'Panorama\Service\Factory\IssueServiceFactory',
            'Panorama\Service\DeviceServiceInterface' => 'Panorama\Service\Factory\DeviceServiceFactory',
            'Panorama\Service\UserServiceInterface' => 'Panorama\Service\Factory\UserServiceFactory',
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'panorama-index' => array(
                'title' => 'Panorama9',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/panorama',
                    'defaults' => array(
                        'controller' => 'Panorama\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'panorama-view' => array(
                'title' => 'Panorama9',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/panorama/client/[:cid]',
                    'defaults' => array(
                        'controller' => 'Panorama\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            ),
            'panorama-view-device' => array(
                'title' => 'Panorama9',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/panorama/client/[:cid]/device/[:deviceId]',
                    'defaults' => array(
                        'controller' => 'Panorama\Controller\DeviceController',
                        'action' => 'index'
                    )
                )
            ),
            'panorama-user' => array(
                'title' => 'Panorama9',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/panorama/client/[:cid]/user',
                    'defaults' => array(
                        'controller' => 'Panorama\Controller\UserController',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    'view_helpers' => array(
        'invokables' => array(
            'PanoramaAsideMenu' => 'Panorama\View\Helper\PanoramaAsideMenu',
        ),
        'factories' => array(
            'GetClientIssues' => 'Panorama\View\Helper\Factory\GetClientIssuesFactory',
            'GetDeviceDetails' => 'Panorama\View\Helper\Factory\GetDeviceDetailsFactory',
            'GetAllIssues' => 'Panorama\View\Helper\Factory\GetAllIssuesFactory',
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Admin',
                'route' => 'admin-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Panorama9',
                        'route' => 'panorama-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Client',
                                'route' => 'panorama-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'View Device',
                                        'route' => 'panorama-view-device',
                                        'useRouteMatch' => true,
                                    )
                                )
                            )
                        )
                    )
                )
            )
        )
    )
);