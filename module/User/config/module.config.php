<?php
return array(
    'User' => array(
        'name' => 'User',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(
                'user-profile'
            ),
            'employee' => array(
                'user-list',
                'user-create',
                'user-delete',
                'user-update',
                'user-view'
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    'controllers' => array(
        'factories' => array(
            'User\Controller\Profile' => 'User\Controller\Factory\ProfileControllerFactory',
            'User\Controller\Create' => 'User\Controller\Factory\CreateControllerFactory',
            'User\Controller\Delete' => 'User\Controller\Factory\DeleteControllerFactory',
            'User\Controller\Index' => 'User\Controller\Factory\IndexControllerFactory',
            'User\Controller\Update' => 'User\Controller\Factory\UpdateControllerFactory',
            'User\Controller\View' => 'User\Controller\Factory\ViewControllerFactory'
        )
        
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'User\Service\UserServiceInterface' => 'User\Service\Factory\UserServiceFactory',
            'User\Mapper\UserMapperInterface' => 'User\Mapper\Factory\UserMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'user-profile' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/user/profile',
                    'defaults' => array(
                        'controller' => 'User\Controller\Profile',
                        'action' => 'index'
                    )
                )
            ),
            
            'user-list' => array(
                'title' => 'Client Users',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/user',
                    'defaults' => array(
                        'controller' => 'User\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'user-create' => array(
                'title' => 'Create User',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/user/create',
                    'defaults' => array(
                        'controller' => 'User\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'user-delete' => array(
                'title' => 'Delete User',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/user/delete/[:userId]',
                    'defaults' => array(
                        'controller' => 'User\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'user-update' => array(
                'title' => 'Edit User',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/user/update/[:userId]',
                    'defaults' => array(
                        'controller' => 'User\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'user-view' => array(
                'title' => 'View User',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/user/view/[:userId]',
                    'defaults' => array(
                        'controller' => 'User\Controller\View',
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