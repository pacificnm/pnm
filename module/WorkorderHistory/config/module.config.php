<?php
return array(
    'module' => array(
        'WorkorderHistory' => array(
            'name' => 'WorkorderHistory',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array(),
            ),
        ),
    ),
    'controller_plugins' => array(
        'factories' => array(
            'SetWorkorderHistory' => 'WorkorderHistory\\Controller\\Factory\\WorkorderHistoryPluginFactory',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'WorkorderHistory\\Service\\WorkorderHistoryServiceInterface' => 'WorkorderHistory\\Service\\Factory\\WorkorderHistoryServiceFactory',
            'WorkorderHistory\\Mapper\\WorkorderHistoryMapperInterface' => 'WorkorderHistory\\Mapper\\Factory\\WorkorderHistoryMapperFactory',
            'WorkorderHistory\\V1\\Rest\\WorkorderHistory\\WorkorderHistoryResource' => 'WorkorderHistory\\V1\\Rest\\WorkorderHistory\\WorkorderHistoryResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'workorder-history.rest.workorder-history' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/workorder-history[/:workorder_history_id]',
                    'defaults' => array(
                        'controller' => 'WorkorderHistory\\V1\\Rest\\WorkorderHistory\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'workorder-history.rest.workorder-history',
        ),
    ),
    'zf-rest' => array(
        'WorkorderHistory\\V1\\Rest\\WorkorderHistory\\Controller' => array(
            'listener' => 'WorkorderHistory\\V1\\Rest\\WorkorderHistory\\WorkorderHistoryResource',
            'route_name' => 'workorder-history.rest.workorder-history',
            'route_identifier_name' => 'workorder_history_id',
            'collection_name' => 'workorder_history',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(
                0 => 'workorderId',
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'WorkorderHistory\\V1\\Rest\\WorkorderHistory\\WorkorderHistoryEntity',
            'collection_class' => 'WorkorderHistory\\V1\\Rest\\WorkorderHistory\\WorkorderHistoryCollection',
            'service_name' => 'WorkorderHistory',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'WorkorderHistory\\V1\\Rest\\WorkorderHistory\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'WorkorderHistory\\V1\\Rest\\WorkorderHistory\\Controller' => array(
                0 => 'application/vnd.workorder-history.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'WorkorderHistory\\V1\\Rest\\WorkorderHistory\\Controller' => array(
                0 => 'application/vnd.workorder-history.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'WorkorderHistory\\Entity\\WorkorderHistoryEntity' => array(
                'entity_identifier_name' => 'workorder_history_id',
                'route_name' => 'workorder-history.rest.workorder-history',
                'route_identifier_name' => 'workorder_history_id',
                'hydrator' => 'WorkorderHistory\\Hydrator\\WorkorderHistoryHydrator',
            ),
            'WorkorderHistory\\V1\\Rest\\WorkorderHistory\\WorkorderHistoryCollection' => array(
                'entity_identifier_name' => 'workorder_history_id',
                'route_name' => 'workorder-history.rest.workorder-history',
                'route_identifier_name' => 'workorder_history_id',
                'is_collection' => true,
            ),
        ),
    ),
);
