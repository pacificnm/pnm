<?php
return array(
    'module' => array(
        'Client' => array(
            'name' => 'Client',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    'client-view',
                ),
                'employee' => array(
                    'client-index',
                    'client-view',
                    'client-update',
                    'client-create',
                    'client-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Client\Controller\Index' => 'Client\Controller\Factory\IndexControllerFactory',
            'Client\Controller\View' => 'Client\Controller\Factory\ViewControllerFactory',
            'Client\Controller\Create' => 'Client\Controller\Factory\CreateControllerFactory',
            'Client\Controller\Update' => 'Client\Controller\Factory\UpdateControllerFactory',
            'Client\Controller\Delete' => 'Client\Controller\Factory\DeleteControllerFactory',
        )
        
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Client\Mapper\ClientMapperInterface' => 'Client\Mapper\Factory\ClientMapperFactory',
            'Client\Service\ClientServiceInterface' => 'Client\Service\Factory\ClientServiceFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'client-view' => array(
                'title' => 'View Client',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]',
                    'defaults' => array(
                        'controller' => 'Client\Controller\View',
                        'action' => 'index'
                    )
                )
            ),
            
            'client-index' => array(
                'title' => 'List Clients',
                'type' => 'literal',
                'options' => array(
                    'route' => '/client',
                    'defaults' => array(
                        'controller' => 'Client\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            
            'client-update' => array(
                'title' => 'Edit Client',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/update',
                    'defaults' => array(
                        'controller' => 'Client\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            
            'client-delete' => array(
                'title' => 'Delete Client',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/delete',
                    'defaults' => array(
                        'controller' => 'Client\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            
            'client-create' => array(
                'title' => 'New Client',
                'type' => 'literal',
                'options' => array(
                    'route' => '/client/create',
                    'defaults' => array(
                        'controller' => 'Client\Controller\Create',
                        'action' => 'index'
                    )
                )
            )
        )
    )
    ,
    
    // view helpers
    'view_helpers' => array(
        'invokables' => array()

        
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);