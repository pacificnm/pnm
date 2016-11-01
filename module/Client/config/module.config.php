<?php
return array(
    'module' => array(
        'Client' => array(
            'name' => 'Client',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(
                    0 => 'client-view'
                ),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    0 => 'client-index',
                    1 => 'client-view',
                    2 => 'client-update',
                    3 => 'client-create',
                    4 => 'client-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    'controllers' => array(
        'factories' => array(
            'Client\\Controller\\Index' => 'Client\\Controller\\Factory\\IndexControllerFactory',
            'Client\\Controller\\View' => 'Client\\Controller\\Factory\\ViewControllerFactory',
            'Client\\Controller\\Create' => 'Client\\Controller\\Factory\\CreateControllerFactory',
            'Client\\Controller\\Update' => 'Client\\Controller\\Factory\\UpdateControllerFactory',
            'Client\\Controller\\Delete' => 'Client\\Controller\\Factory\\DeleteControllerFactory'
        )
    ),
    'controller_plugins' => array(
        'factories' => array(
            'getClient' => 'Client\Controller\Plugin\Factory\ClientControllerPluginFactory'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Client\Mapper\MysqlMapperInterface' => 'Client\Mapper\Factory\MysqlMapperFactory',
            'Client\\Service\\ClientServiceInterface' => 'Client\\Service\\Factory\\ClientServiceFactory',
            'Client\\V1\\Rest\\Client\\ClientResource' => 'Client\\V1\\Rest\\Client\\ClientResourceFactory',
            'Client\\V1\\Rest\\ClientService\\ClientServiceResource' => 'Client\\V1\\Rest\\ClientService\\ClientServiceResourceFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'client-view' => array(
                'title' => 'View Client',
                'type' => 'segment',
                'activeMenuItem' => 'client',
                'activeSubMenuItem' => 'client-view',
                'options' => array(
                    'route' => '/client/[:clientId]',
                    'defaults' => array(
                        'controller' => 'Client\\Controller\\View',
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
                        'controller' => 'Client\\Controller\\Index',
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
                        'controller' => 'Client\\Controller\\Update',
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
                        'controller' => 'Client\\Controller\\Delete',
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
                        'controller' => 'Client\\Controller\\Create',
                        'action' => 'index'
                    )
                )
            ),
            'client.rest.client-service' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/client[/:client_id]',
                    'defaults' => array(
                        'controller' => 'Client\\V1\\Rest\\ClientService\\Controller'
                    )
                )
            )
        )
    ),
    'view_helpers' => array(
        'invokables' => array()
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view'
        )
    ),
    
    // navigation
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Clients',
                'route' => 'client-index',
                'resource' => 'client-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'New Client',
                        'route' => 'client-create',
                        'useRouteMatch' => true
                    ),
                    array(
                        'label' => 'View Client',
                        'route' => 'client-view',
                        'resource' => 'client-view',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Edit Client',
                                'route' => 'client-update',
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
        'default' => array(
            
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
    ),
    
    // api
    'zf-versioning' => array(
        'uri' => array(
            0 => 'client.rest.client-service'
        )
    ),
    'zf-rest' => array(
        'Client\\V1\\Rest\\ClientService\\Controller' => array(
            'listener' => 'Client\\V1\\Rest\\ClientService\\ClientServiceResource',
            'route_name' => 'client.rest.client-service',
            'route_identifier_name' => 'client_id_service',
            'collection_name' => 'client_service',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
                3 => 'POST'
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST'
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Client\\Entity\\ClientEntity',
            'collection_class' => 'Client\\V1\\Rest\\ClientService\\ClientServiceCollection',
            'service_name' => 'ClientService'
        )
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Client\\V1\\Rest\\ClientService\\Controller' => 'HalJson'
        ),
        'accept_whitelist' => array(
            'Client\\V1\\Rest\\ClientService\\Controller' => array(
                0 => 'application/vnd.client.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json'
            )
        ),
        'content_type_whitelist' => array(
            'Client\\V1\\Rest\\ClientService\\Controller' => array(
                0 => 'application/vnd.client.v1+json',
                1 => 'application/json'
            )
        )
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Client\\Entity\\ClientEntity' => array(
                'entity_identifier_name' => 'client_id',
                'route_name' => 'client.rest.client-service',
                'route_identifier_name' => 'client_id_service',
                'hydrator' => 'Client\\Hydrator\\ClientHydrator'
            ),
            'Client\\V1\\Rest\\ClientService\\ClientServiceCollection' => array(
                'entity_identifier_name' => 'client_id',
                'route_name' => 'client.rest.client-service',
                'route_identifier_name' => 'client_id_service',
                'is_collection' => true
            )
        )
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'Client\\V1\\Rest\\ClientService\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false
                ),
                'entity' => array(
                    'GET' => true,
                    'POST' => true,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true
                )
            )
        )
    )
);
