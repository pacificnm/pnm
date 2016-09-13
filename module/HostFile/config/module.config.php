<?php
return array(
    'module' => array(
        'HostFile' => array(
            'name' => 'HostFile',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    'host-file-index',
                    'host-file-view'
                ),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'host-file-create',
                    'host-file-update',
                    'host-file-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    'controllers' => array(
        'factories' => array(

        )
    ),
    'service_manager' => array(
        'factories' => array(
            'HostFile\Service\HostFileServiceInterface' => 'HostFile\Service\Factory\HostFileServiceFactory',
            'HostFile\Mapper\HostFileMapperInterface' => 'HostFile\Mapper\Factory\HostFileMapperFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'host-file-index' => array(
                'title' => 'Files',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/host/[:hostId]/file',
                    'defaults' => array(
                        'controller' => 'ClientFile\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'host-file-create' => array(
                'title' => 'Create File',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/host/[:hostId]/file/create',
                    'defaults' => array(
                        'controller' => 'ClientFile\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'host-file-update' => array(
                'title' => 'Create File',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/host/[:hostId]/file/[:hostFileId]/update',
                    'defaults' => array(
                        'controller' => 'ClientFile\Controller\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'host-file-view' => array(
                'title' => 'View File',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/host/[:hostId]/file/[:hostFileId]/view',
                    'defaults' => array(
                        'controller' => 'ClientFile\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            ),
            'host-file-delete' => array(
                'title' => 'Delete File',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/host/[:hostId]/file/[:hostFileId]/delete',
                    'defaults' => array(
                        'controller' => 'ClientFile\Controller\DeleteController',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        )
    ),
    'view_helpers' => array(
        'invokables' => array(),
        'factories' => array(
            'HostFile' => 'HostFile\View\Helper\Factory\HostFileFactory'
        )
    ),
);