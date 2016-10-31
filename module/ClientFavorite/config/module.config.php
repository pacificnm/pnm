<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
return array(
    'module' => array(
        'ClientFavorite' => array(
            'name' => 'ClientFavorite',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'client-favorite-index',
                    'client-favorite-create',
                    'client-favorite-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
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
            'favorites' => 'ClientFavorite\View\Helper\Factory\FavoriteViewHelperFactory',
            'hasFavorite' => 'ClientFavorite\View\Helper\Factory\HasFavoriteFactory'
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
                'label' => 'My Profile',
                'route' => 'employee-profile',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Favorite Clients',
                        'route' => 'client-favorite-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Delete',
                                'route' => 'client-favorite-delete',
                                'useRouteMatch' => true
                            )
                        )
                    )
                )
            )
            
        )
    ),
    // menu
    'menu' => array(
        // admin
        'admin' => array(
            array()
        ),
        // employee
        'employee' => array(
            array(
                'label' => 'My Profile',
                'icon' => 'fa fa-gears',
                'route' => 'employee-profile',
                'submenu' => array(
                    array(
                        'label' => 'Favorite Clients',
                        'icon' => 'fa fa-star',
                        'route' => 'client-favorite-index'
                    )
                )
            )
        ),
        // client
        'client' => array(
            array()
        ),
        // user
        'user' => array(
            array()
        )
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
);