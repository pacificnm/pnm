<?php
return array(
    'HostAttribute' => array(
        'name' => 'HostAttribute',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(),
            'accountant' => array(),
            'administrator' => array(
                'host-attribute-index',
                'host-attribute-create',
                'host-attribute-delete',
                'host-attribute-update',
                'host-attribute-view'
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'HostAttribute\Controller\Index' => 'HostAttribute\Controller\Factory\IndexControllerFactory',
            'HostAttribute\Controller\Create' => 'HostAttribute\Controller\Factory\CreateControllerFactory',
            'HostAttribute\Controller\Delete' => 'HostAttribute\Controller\Factory\DeleteControllerFactory',
            'HostAttribute\Controller\Update' => 'HostAttribute\Controller\Factory\UpdateControllerFactory',
            'HostAttribute\Controller\View' => 'HostAttribute\Controller\Factory\ViewControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'HostAttribute\Service\AttributeServiceInterface' => 'HostAttribute\Service\Factory\AttributeServiceFactory',
            'HostAttribute\Mapper\AttributeMapperInterface' => 'HostAttribute\Mapper\Factory\AttributeMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'host-attribute-index' => array(
                'title' => 'Host Types',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/host-attribute',
                    'defaults' => array(
                        'controller' => 'HostAttribute\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'host-attribute-create' => array(
                'title' => 'Create Labor Rate',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/host-attribute/create',
                    'defaults' => array(
                        'controller' => 'HostAttribute\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'host-attribute-delete' => array(
                'title' => 'Delete Labor Rate',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/host-attribute/delete/[:hostAttributeId]',
                    'defaults' => array(
                        'controller' => 'HostAttribute\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'host-attribute-update' => array(
                'title' => 'Edit Labor Rate',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/host-attribute/update/[:hostAttributeId]',
                    'defaults' => array(
                        'controller' => 'HostAttribute\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'host-attribute-view' => array(
                'title' => 'View Labor Rate',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/host-attribute/view/[:hostAttributeId]',
                    'defaults' => array(
                        'controller' => 'HostAttribute\Controller\View',
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
    )
);