<?php
return array(
    'WorkorderNote' => array(
        'name' => 'WorkorderNote',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(
                'workorder-note-create'
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'WorkorderNote\Controller\Create' => 'WorkorderNote\Controller\Factory\CreateControllerFactory'
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
                'title' => 'Create Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/work-order-note/create',
                    'defaults' => array(
                        'controller' => 'WorkorderNote\Controller\Create',
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