<?php
return array(
    'Host' => array(
        'name' => 'Host',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'host-list',
                'host-create',
                'host-update',
                'host-view',
                'host-delete'
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Host\Controller\Index' => 'Host\Controller\Factory\IndexControllerFactory',
            'Host\Controller\Create' => 'Host\Controller\Factory\CreateControllerFactory',
            'Host\Controller\Update' => 'Host\Controller\Factory\UpdateControllerFactory',
            'Host\Controller\Delete' => 'Host\Controller\Factory\DeleteControllerFactory',
            'Host\Controller\View' => 'Host\Controller\Factory\ViewControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Host\Service\HostServiceInterface' => 'Host\Service\Factory\HostServiceFactory',
            'Host\Mapper\HostMapperInterface' => 'Host\Mapper\Factory\HostMapperFactory',
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'host-list' => array(
                'title' => 'Hosts',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/host',
                    'defaults' => array(
                        'controller' => 'Host\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'host-create' => array(
                'title' => 'Create Host',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/host/create',
                    'defaults' => array(
                        'controller' => 'Host\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'host-view' => array(
                'title' => 'View Host',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/host/view/[:hostId]',
                    'defaults' => array(
                        'controller' => 'Host\Controller\View',
                        'action' => 'index'
                    )
                )
            ),
            'host-update' => array(
                'title' => 'Edit Host',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/host/update/[:hostId]',
                    'defaults' => array(
                        'controller' => 'Host\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'host-delete' => array(
                'title' => 'Edit Host',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/host/delete/[:hostId]',
                    'defaults' => array(
                        'controller' => 'Host\Controller\Delete',
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