<?php
return array(
    'Phone' => array(
        'name' => 'Phone',
        'version' => '2.5',
        'acl' => array(
            'guest' => array(),
            'user' => array(),
            'employee' => array(),
            'accountant' => array(),
            'administrator' => array()
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array()
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Phone\Service\PhoneServiceInterface' => 'Phone\Service\Factory\PhoneServiceFactory',
            'Phone\Mapper\PhoneMapperInterface' => 'Phone\Mapper\Factory\PhoneMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'phone-view' => array(
                'title' => 'View Phone',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/phone/view/[:phoneId]',
                    'defaults' => array(
                        'controller' => 'Phone\Controller\View',
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