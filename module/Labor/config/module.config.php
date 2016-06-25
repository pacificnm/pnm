<?php
return array(
    'module' => array(
        'Labor' => array(
            'name' => 'Labor',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
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
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Labor\Controller\Index' => 'Labor\Controller\Factory\IndexControllerFactory',
            'Labor\Controller\Create' => 'Labor\Controller\Factory\CreateControllerFactory',
            'Labor\Controller\Delete' => 'Labor\Controller\Factory\DeleteControllerFactory',
            'Labor\Controller\Update' => 'Labor\Controller\Factory\UpdateControllerFactory',
            'Labor\Controller\View' => 'Labor\Controller\Factory\ViewControllerFactory',
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Labor\Service\LaborServiceInterface' => 'Labor\Service\Factory\LaborServiceFactory',
            'Labor\Mapper\LaborMapperInterface' => 'Labor\Mapper\Factory\LaborMapperFactory',
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