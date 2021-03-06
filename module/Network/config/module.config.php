<?php
return array(
    'module' => array(
        'Network' => array(
            'name' => 'Network',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(
                    'network-list',
                    'network-view'
                ),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'network-create',
                    'network-delete',
                    'network-update'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Network\Controller\Create' => 'Network\Controller\Factory\CreateControllerFactory',
            'Network\Controller\Delete' => 'Network\Controller\Factory\DeleteControllerFactory',
            'Network\Controller\Index' => 'Network\Controller\Factory\IndexControllerFactory',
            'Network\Controller\Update' => 'Network\Controller\Factory\UpdateControllerFactory',
            'Network\Controller\View' => 'Network\Controller\Factory\ViewControllerFactory'
        )
    )
    ,
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Network\Service\NetworkServiceInterface' => 'Network\Service\Factory\NetworkServiceFactory',
            'Network\Mapper\NetworkMapperInterface' => 'Network\Mapper\Factory\NetworkMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'network-list' => array(
                'title' => 'Client Network Settings',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/network',
                    'defaults' => array(
                        'controller' => 'Network\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'network-create' => array(
                'title' => 'Create Network Setting',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/network/create',
                    'defaults' => array(
                        'controller' => 'Network\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'network-view' => array(
                'title' => 'View Network Setting',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/network/view/[:networkId]',
                    'defaults' => array(
                        'controller' => 'Network\Controller\View',
                        'action' => 'index'
                    )
                )
            ),
            'network-update' => array(
                'title' => 'Edit Network Setting',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/network/update/[:networkId]',
                    'defaults' => array(
                        'controller' => 'Network\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'network-delete' => array(
                'title' => 'Delete Network Setting',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/network/delete/[:networkId]',
                    'defaults' => array(
                        'controller' => 'Network\Controller\Delete',
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
                        'label' => 'Network Settings',
                        'route' => 'network-list',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Create Network Setting',
                                'route' => 'network-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'View Network Setting',
                                'route' => 'network-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit Network Setting',
                                        'route' => 'network-update',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Delete Network Setting',
                                        'route' => 'network-delete',
                                        'useRouteMatch' => true
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
                    'label' => 'Network',
                    'icon' => 'fa fa-sitemap',
                    'route' => 'network-list',
                    'resource' => 'network-list',
                    'order' => 8,
                    'useRouteMatch' => true
                )
            )
        )
    ),
    // acl
    'acl' => array(
        'default' => array(
            array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    )
);