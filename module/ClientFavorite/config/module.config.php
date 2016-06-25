<?php
return array(
    'module' => array(
        'ClientFavorite' => array(
            'name' => 'ClientFavorite',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(
                    'client-favorite-index',
                    'client-favorite-create',
                    'client-favorite-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'ClientFavorite\Controller\Index' => 'ClientFavorite\Controller\Factory\IndexControllerFactory',
            'ClientFavorite\Controller\Create' => 'ClientFavorite\Controller\Factory\CreateControllerFactory',
            'ClientFavorite\Controller\Delete' => 'ClientFavorite\Controller\Factory\DeleteControllerFactory'
        )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'ClientFavorite\Service\FavoriteServiceInterface' => 'ClientFavorite\Service\Factory\FavoriteServiceFactory',
            'ClientFavorite\Mapper\FavoriteMapperInterface' => 'ClientFavorite\Mapper\Factory\FavoriteMapperFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'client-favorite-index' => array(
                'title' => 'Favorite Clients',
                'type' => 'literal',
                'options' => array(
                    'route' => '/employee/profile/client-favorite',
                    'defaults' => array(
                        'controller' => 'ClientFavorite\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            
            'client-favorite-create' => array(
                'title' => 'Create Favorite Clients',
                'type' => 'segment',
                'options' => array(
                    'route' => '/employee/profile/client-favorite/create/[:clientId]',
                    'defaults' => array(
                        'controller' => 'ClientFavorite\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            
            'client-favorite-delete' => array(
                'title' => 'View Favorite Clients',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client-favorite/delete/[:clientFavoriteId]',
                    'defaults' => array(
                        'controller' => 'ClientFavorite\Controller\Delete',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view helpers
    'view_helpers' => array(
        'factories' => array(
            'favorites' => 'ClientFavorite\View\Helper\Factory\FavoriteViewHelperFactory'
        ),
        'invokables' => array()
    )
    ,
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);