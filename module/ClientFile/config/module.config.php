<?php
return array(
    'module' => array(
        'ClientFile' => array(
            'name' => 'ClientFile',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    'client-file-index',
                    'client-file-view'
                ),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'client-file-create',
                    'client-file-update',
                    'client-file-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    'controllers' => array(
        'factories' => array(
            'ClientFile\Controller\CreateController' => 'ClientFile\Controller\Factory\CreateControllerFactory',
            'ClientFile\Controller\DeleteController' => 'ClientFile\Controller\Factory\DeleteControllerFactory',
            'ClientFile\Controller\IndexController' => 'ClientFile\Controller\Factory\IndexControllerFactory',
            'ClientFile\Controller\UpdateController' => 'ClientFile\Controller\Factory\UpdateControllerFactory',
            'ClientFile\Controller\ViewController' => 'ClientFile\Controller\Factory\ViewControllerFactory'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'ClientFile\Mapper\ClientFileMapperInterface' => 'ClientFile\Mapper\Factory\ClientFileMapperFactory',
            'ClientFile\Service\ClientFileServiceInterface' => 'ClientFile\Service\Factory\ClientFileServiceFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'client-file-index' => array(
                'title' => 'Files',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/file',
                    'defaults' => array(
                        'controller' => 'ClientFile\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'client-file-create' => array(
                'title' => 'Create File',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/file/create',
                    'defaults' => array(
                        'controller' => 'ClientFile\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'client-file-update' => array(
                'title' => 'Create File',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/file/[:clientFileId]/update',
                    'defaults' => array(
                        'controller' => 'ClientFile\Controller\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'client-file-view' => array(
                'title' => 'View File',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/file/[:clientFileId]/view',
                    'defaults' => array(
                        'controller' => 'ClientFile\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            ),
            'client-file-delete' => array(
                'title' => 'Delete File',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/file/[:clientFileId]/delete',
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
    )
);