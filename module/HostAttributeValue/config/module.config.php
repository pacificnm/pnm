<?php
return array(
    'module' => array(
        'HostAttributeValue' => array(
            'name' => 'HostAttributeValue',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(
                    'host-attribute-value-index',
                    'host-attribute-value-create',
                    'host-attribute-value-delete',
                    'host-attribute-value-update',
                    'host-attribute-value-view'
                )
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'HostAttributeValue\Controller\Index' => 'HostAttributeValue\Controller\Factory\IndexControllerFactory',
            'HostAttributeValue\Controller\Create' => 'HostAttributeValue\Controller\Factory\CreateControllerFactory',
            'HostAttributeValue\Controller\Delete' => 'HostAttributeValue\Controller\Factory\DeleteControllerFactory',
            'HostAttributeValue\Controller\Update' => 'HostAttributeValue\Controller\Factory\UpdateControllerFactory',
            'HostAttributeValue\Controller\View' => 'HostAttributeValue\Controller\Factory\ViewControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'HostAttributeValue\Service\ValueServiceInterface' => 'HostAttributeValue\Service\Factory\ValueServiceFactory',
            'HostAttributeValue\Mapper\ValueMapperInterface' => 'HostAttributeValue\Mapper\Factory\ValueMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'host-attribute-value-index' => array(
                'title' => 'Host Attribute Value',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/host-attribute-value',
                    'defaults' => array(
                        'controller' => 'HostAttributeValue\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'host-attribute-value-create' => array(
                'title' => 'New Host Attribute Value',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/host-attribute/[:hostAttributeId]/host-attribute-value/create',
                    'defaults' => array(
                        'controller' => 'HostAttributeValue\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'host-attribute-value-delete' => array(
                'title' => 'Delete Host Attribute Value',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/host-attribute/[:hostAttributeId]/host-attribute-value/delete/[:hostAttributeValueId]',
                    'defaults' => array(
                        'controller' => 'HostAttributeValue\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'host-attribute-value-update' => array(
                'title' => 'Edit Host Attribute Value',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/host-attribute/[:hostAttributeId]/host-attribute-value/update/[:hostAttributeValueId]',
                    'defaults' => array(
                        'controller' => 'HostAttributeValue\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'host-attribute-value-view' => array(
                'title' => 'View Host Attribute Value',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/host-attribute/[:hostAttributeId]/host-attribute-value/view/[:hostAttributeValueId]',
                    'defaults' => array(
                        'controller' => 'HostAttributeValue\Controller\View',
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
                        'label' => 'Host Attributes',
                        'route' => 'host-attribute-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'View Attribute',
                                'route' => 'host-attribute-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'New Value',
                                        'route' => 'host-attribute-value-create',
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
        'default' => array()
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