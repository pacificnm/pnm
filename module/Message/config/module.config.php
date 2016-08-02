<?php
return array(
    'module' => array(
        'Message' => array(
            'name' => 'Message',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Message\Service\MessageServiceInterface' => 'Message\Service\Factory\MessageServiceFactory',
            'Message\Mapper\MessageMapperInterface' => 'Message\Mapper\Factory\MessageMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'message-list' => array(
                'title' => 'Messages',
                'type' => 'segment',
                'options' => array(
                    'route' => '/messages',
                    'defaults' => array(
                        'controller' => 'Message\Controller\View',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'invokables' => array(
            'NavBarMessage' => 'Message\View\Helper\NavBarMessage'
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);