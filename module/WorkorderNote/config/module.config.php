<?php
return array(
    'module' => array(
        'WorkorderNote' => array(
            'name' => 'WorkorderNote',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'workorder-note-create',
                    'workorder-note-update',
                    'workorder-note-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'WorkorderNote\Controller\Create' => 'WorkorderNote\Controller\Factory\CreateControllerFactory',
            'WorkorderNote\Controller\Update' => 'WorkorderNote\Controller\Factory\UpdateControllerFactory',
            'WorkorderNote\Controller\Delete' => 'WorkorderNote\Controller\Factory\DeleteControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'WorkorderNote\Mapper\NoteMapperInterface' => 'WorkorderNote\Mapper\Factory\NoteMapperFactory',
            'WorkorderNote\Service\NoteServiceInterface' => 'WorkorderNote\Service\Factory\NoteServiceFactory',
            'WorkorderNote\Form\NoteForm' => 'WorkorderNote\Form\Factory\NoteFormFactory'
        )
        
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'workorder-note-create' => array(
                'title' => 'Create Work Order Note',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/work-order-note/create',
                    'defaults' => array(
                        'controller' => 'WorkorderNote\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-note-update' => array(
                'title' => 'Update Work Order Note',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/work-order-note/update/[:workorderNotesId]',
                    'defaults' => array(
                        'controller' => 'WorkorderNote\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'workorder-note-delete' => array(
                'title' => 'Delete Work Order Note',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/work-order-note/delete/[:workorderNotesId]',
                    'defaults' => array(
                        'controller' => 'WorkorderNote\Controller\Delete',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'GetWorkorderNotes' => 'WorkorderNote\View\Helper\Factory\GetWorkorderNotesFactory'
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
                                                'label' => 'Edit Note',
                                                'route' => 'workorder-note-update',
                                                'useRouteMatch' => true
                                            ),
                                            array(
                                                'label' => 'Delete Note',
                                                'route' => 'workorder-note-delete',
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
)
;