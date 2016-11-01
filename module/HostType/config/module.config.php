<?php
return array(
    'module' => array(
        'HostType' => array(
            'name' => 'HostType',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'host-type-index',
                    'host-type-create',
                    'host-type-delete',
                    'host-type-update',
                    'host-type-view'
                )
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'HostType\Controller\Index' => 'HostType\Controller\Factory\IndexControllerFactory',
            'HostType\Controller\Create' => 'HostType\Controller\Factory\CreateControllerFactory',
            'HostType\Controller\Delete' => 'HostType\Controller\Factory\DeleteControllerFactory',
            'HostType\Controller\Update' => 'HostType\Controller\Factory\UpdateControllerFactory',
            'HostType\Controller\View' => 'HostType\Controller\Factory\ViewControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'HostType\Service\TypeServiceInterface' => 'HostType\Service\Factory\TypeServiceFactory',
            'HostType\Mapper\TypeMapperInterface' => 'HostType\Mapper\Factory\TypeMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'host-type-index' => array(
                'title' => 'Host Types',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/host-type',
                    'defaults' => array(
                        'controller' => 'HostType\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'host-type-create' => array(
                'title' => 'Create Labor Rate',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/host-type/create',
                    'defaults' => array(
                        'controller' => 'HostType\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'host-type-delete' => array(
                'title' => 'Delete Labor Rate',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/host-type/delete/[:hostTypeId]',
                    'defaults' => array(
                        'controller' => 'HostType\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'host-type-update' => array(
                'title' => 'Edit Labor Rate',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/host-type/update/[:hostTypeId]',
                    'defaults' => array(
                        'controller' => 'HostType\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'host-type-view' => array(
                'title' => 'View Labor Rate',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/host-type/view/[:hostTypeId]',
                    'defaults' => array(
                        'controller' => 'HostType\Controller\View',
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
                'label' => 'Admin',
                'route' => 'admin-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Host Types',
                        'route' => 'host-type-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New Host Type',
                                'route' => 'host-type-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'View',
                                'route' => 'host-type-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit',
                                        'route' => 'host-type-update',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'host-type-delete',
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
            'admin' => array(
                array(
                    'label' => 'Host Types',
                    'icon' => 'fa fa-desktop',
                    'route' => 'host-type-index',
                    'resource' => 'host-type-index',
                    'order' => 7
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