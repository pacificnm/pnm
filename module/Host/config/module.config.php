<?php
return array(
    'module' => array(
        'Host' => array(
            'name' => 'Host',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    'host-list',
                    'host-view'
                ),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'host-create',
                    'host-update',
                    'host-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
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
            'Host\Form\HostForm' => 'Host\Form\Factory\HostFormFactory'
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
            )
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    // navigation
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Clients',
                'route' => 'client-index',
                'resource' => 'client-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'View Client',
                        'route' => 'client-view',
                        'resource' => 'client-view',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Hosts',
                                'route' => 'host-list',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'New Host',
                                        'route' => 'host-create',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'View Host',
                                        'route' => 'host-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Edit Host',
                                                'route' => 'host-update',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'Delete Host',
                                                'route' => 'host-delete',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'Add Attributes',
                                                'route' => 'host-attribute-map-create',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'Edit Attributes',
                                                'route' => 'host-attribute-map-update',
                                                'useRouteMatch' => true
                                            )
                                        )
                                    )
                                )
                            )
                        )
                    )
                    
                )
            )
        )
    ),
    // menu
    'menu' => array(
        'default' => array(
            'client' => array(
                array(
                    'label' => 'Hosts',
                    'icon' => 'fa fa-desktop',
                    'route' => 'host-list',
                    'resource' => 'host-list',
                    'order' => 6,
                    'useRouteMatch' => true
                )
            )
        )
    ),
    // acl
    'acl' => array(
        'default' => array()
    )
);