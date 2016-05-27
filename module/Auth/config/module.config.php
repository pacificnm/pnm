<?php
use Auth\View\Helper\AuthNavBar;
return array(
    'Auth' => array(
        'name' => 'Auth',
        'version' => '2.5'
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'Auth\Controller\SignIn' => 'Auth\Controller\Factory\SignInControllerFactory',
            'Auth\Controller\SignOut' => 'Auth\Controller\Factory\SignOutControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'Auth\Adapter\AuthAdapter' => 'Auth\Adapter\Factory\AuthAdapterFactory',
            'Auth\Service\AuthServiceInterface' => 'Auth\Service\Factory\AuthServiceFactory',
            'Auth\Mapper\AuthMapperInterface' => 'Auth\Mapper\Factory\AuthMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'auth-sign-in' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/sign-in',
                    'defaults' => array(
                        'controller' => 'Auth\Controller\SignIn',
                        'action' => 'index'
                    )
                )
            ),
            
            'auth-sign-out' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/sign-out',
                    'defaults' => array(
                        'controller' => 'Auth\Controller\SignOut',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'invokables' => array(
            'AuthNavBar' => 'Auth\View\Helper\AuthNavBar',
            'AuthAside' => 'Auth\View\Helper\AuthAside'
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);