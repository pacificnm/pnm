<?php
return array(
    'module' => array(
        'WorkorderFile' => array(
            'name' => 'WorkorderFile',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'workorder-file-create',
                    'workorder-file-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'WorkorderFile\Controller\CreateController' => 'WorkorderFile\Controller\Factory\CreateControllerFactory',
            'WorkorderFile\Controller\DeleteController' => 'WorkorderFile\Controller\Factory\DeleteControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'WorkorderFile\Service\WorkorderFileServiceInterface' => 'WorkorderFile\Service\Factory\WorkorderFileServiceFactory',
            'WorkorderFile\Mapper\WorkorderFileMapperInterface' => 'WorkorderFile\Mapper\Factory\WorkorderFileMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'workorder-file-create' => array(
                'title' => 'Add File To Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/file/create',
                    'defaults' => array(
                        'controller' => 'WorkorderFile\Controller\CreateController',
                        'action' => 'index'
                     )
                )
            ),
            'workorder-file-delete' => array(
                'title' => 'Remove File From Work Order',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/work-order/[:workorderId]/file/[:workorderFileId]/delete',
                    'defaults' => array(
                        'controller' => 'WorkorderFile\Controller\DeleteController',
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