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
                'user-list'
            ),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    'controllers' => array(
        'factories' => array(
            'User\Controller\Profile' => 'User\Controller\Factory\ProfileControllerFactory',
            'User\Controller\Index' => 'User\Controller\Factory\IndexControllerFactory',
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'User\Service\UserServiceInterface' => 'User\Service\Factory\UserServiceFactory',
            'User\Mapper\UserMapperInterface' => 'User\Mapper\Factory\UserMapperFactory',
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
        )
    ),
    
    // view manager
        'view_manager' => array(
            'template_path_stack' => array(
                __DIR__ . '/../view'
            )
        )
);