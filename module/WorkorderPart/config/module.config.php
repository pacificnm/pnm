<?php
return array(
    'module' => array(
        'WorkorderPart' => array(
            'name' => 'WorkorderPart',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'workorder-part-create',
                    'workorder-part-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'WorkorderPart\Controller\Create' => 'WorkorderPart\Controller\Factory\CreateControllerFactory',
            'WorkorderPart\Controller\Delete' => 'WorkorderPart\Controller\Factory\DeleteControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'WorkorderPart\Service\PartServiceInterface' => 'WorkorderPart\Service\Factory\PartServiceFactory',
            'WorkorderPart\Mapper\PartMapperInterface' => 'WorkorderPart\Mapper\Factory\PartMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'workorder-part-create' => array(
                'title' => 'Create Work Order Part',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/work-order-part/create',
                    'defaults' => array(
                        'controller' => 'WorkorderPart\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-part-delete' => array(
                'title' => 'Delete Work Order Part',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/work-order-part/delete/[:workorderPartId]',
                    'defaults' => array(
                        'controller' => 'WorkorderPart\Controller\Delete',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'GetWorkorderParts' => 'WorkorderPart\View\Helper\Factory\GetWorkorderPartsFactory'
        ),
        'invokables' => array()
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
                                'label' => 'Work Orders',
                                'route' => 'workorder-list',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'View Work Order',
                                        'route' => 'workorder-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Delete Part',
                                                'route' => 'workorder-part-delete',
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
            array()
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
    )
);