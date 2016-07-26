<?php
return array(
    'module' => array(
        'File' => array(
            'name' => 'File',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(
                    'file-view',
                    'file-download'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'File\Controller\ViewController' => 'File\Controller\Factory\ViewControllerFactory',
            'File\Controller\DownloadController' => 'File\Controller\Factory\DownloadControllerFactory',
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'File\Service\FileServiceInterface' => 'File\Service\Factory\FileServiceFactory',
            'File\Mapper\FileMapperInterface' => 'File\Mapper\Factory\FileMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'file-view' => array(
                'title' => 'View File',
                'type' => 'segment',
                'options' => array(
                    'route' => '/file/[:fileId]/view',
                    'defaults' => array(
                        'controller' => 'File\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            ),
            'file-download' => array(
                'title' => 'Download File',
                'type' => 'segment',
                'options' => array(
                    'route' => '/file/[:fileId]/download',
                    'defaults' => array(
                        'controller' => 'File\Controller\DownloadController',
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