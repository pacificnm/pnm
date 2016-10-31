<?php
return array(
    'module' => array(
        'Labor' => array(
            'name' => 'Labor',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'labor-index',
                    'labor-create',
                    'labor-delete',
                    'labor-update',
                    'labor-view'
                )
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Labor\Controller\Index' => 'Labor\Controller\Factory\IndexControllerFactory',
            'Labor\Controller\Create' => 'Labor\Controller\Factory\CreateControllerFactory',
            'Labor\Controller\Delete' => 'Labor\Controller\Factory\DeleteControllerFactory',
            'Labor\Controller\Update' => 'Labor\Controller\Factory\UpdateControllerFactory',
            'Labor\Controller\View' => 'Labor\Controller\Factory\ViewControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Labor\Service\LaborServiceInterface' => 'Labor\Service\Factory\LaborServiceFactory',
            'Labor\Mapper\LaborMapperInterface' => 'Labor\Mapper\Factory\LaborMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'labor-index' => array(
                'title' => 'Labor Rates',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/labor-rates',
                    'defaults' => array(
                        'controller' => 'Labor\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'labor-create' => array(
                'title' => 'Create Labor Rate',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/labor-rates/create',
                    'defaults' => array(
                        'controller' => 'Labor\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'labor-delete' => array(
                'title' => 'Delete Labor Rate',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/labor-rates/delete/[:laborId]',
                    'defaults' => array(
                        'controller' => 'Labor\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'labor-update' => array(
                'title' => 'Edit Labor Rate',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/labor-rates/update/[:laborId]',
                    'defaults' => array(
                        'controller' => 'Labor\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'labor-view' => array(
                'title' => 'View Labor Rate',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/labor-rates/view/[:laborId]',
                    'defaults' => array(
                        'controller' => 'Labor\Controller\View',
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
                        'label' => 'Labor Rates',
                        'route' => 'labor-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'New Labor Rate',
                                'route' => 'labor-create',
                                'useRouteMatch' => true
                            ),
                            array(
                                'label' => 'View Labor Rate',
                                'route' => 'labor-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit Labor Rate',
                                        'route' => 'labor-update',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'Delete Labor Rate',
                                        'route' => 'labor-delete',
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
            array(
                'admin' => array(
                    'title' => 'Admin',
                    'icon' => 'fa fa-gears',
                    'route' => 'admin-index',
                    'submenu' => array(
                        array(
                            'labor-index' => array(
                                'title' => 'Labor Rates',
                                'icon' => 'fa fa-dollar',
                                'route' => 'labor-index'
                            )
                        )
                    )
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