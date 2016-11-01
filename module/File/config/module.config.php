<?php
return array(
    'module' => array(
        'File' => array(
            'name' => 'File',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    0 => 'file-view',
                    1 => 'file-download',
                    2 => 'file-index',
                    3 => 'file-create',
                    4 => 'file-delete'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
        )
    ),
    'controllers' => array(
        'factories' => array(
            'File\\Controller\\IndexController' => 'File\\Controller\\Factory\\IndexControllerFactory',
            'File\\Controller\\CreateController' => 'File\\Controller\\Factory\\CreateControllerFactory',
            'File\\Controller\\ViewController' => 'File\\Controller\\Factory\\ViewControllerFactory',
            'File\\Controller\\DownloadController' => 'File\\Controller\\Factory\\DownloadControllerFactory'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'File\\Service\\FileServiceInterface' => 'File\\Service\\Factory\\FileServiceFactory',
            'File\\Mapper\\FileMapperInterface' => 'File\\Mapper\\Factory\\FileMapperFactory',
            'File\\V1\\Rest\\ClientFile\\ClientFileResource' => 'File\\V1\\Rest\\ClientFile\\ClientFileResourceFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'file-index' => array(
                'title' => 'Files',
                'type' => 'segment',
                'options' => array(
                    'route' => '/file/[:clientId]',
                    'defaults' => array(
                        'controller' => 'File\\Controller\\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'file-create' => array(
                'title' => 'Create File',
                'type' => 'segment',
                'options' => array(
                    'route' => '/file/[:clientId]/create',
                    'defaults' => array(
                        'controller' => 'File\\Controller\\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'file-view' => array(
                'title' => 'View File',
                'type' => 'segment',
                'options' => array(
                    'route' => '/file/[:fileId]/view',
                    'defaults' => array(
                        'controller' => 'File\\Controller\\ViewController',
                        'action' => 'index'
                    )
                )
            ),
            'file-download' => array(
                'title' => 'Download File',
                'type' => 'segment',
                'options' => array(
                    'route' => '/file/[:fileId]/download',
                    'defaults' => array(
                        'controller' => 'File\\Controller\\DownloadController',
                        'action' => 'index'
                    )
                )
            ),
            'file.rest.client-file' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/client-file[/:file_id]',
                    'defaults' => array(
                        'controller' => 'File\\V1\\Rest\\ClientFile\\Controller'
                    )
                )
            )
        )
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
                        'label' => 'View Client',
                        'route' => 'client-view',
                        'resource' => 'client-view',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'Files',
                                'route' => 'client-file-index',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'New File',
                                        'route' => 'client-file-create',
                                        'useRouteMatch' => true
                                    ),
                                    array(
                                        'label' => 'View File',
                                        'route' => 'client-file-view',
                                        'useRouteMatch' => true,
                                        'pages' => array(
                                            array(
                                                'label' => 'Delete File',
                                                'route' => 'client-file-delete',
                                                'useRouteMatch' => true
                                            )
                                        )
                                    )
                                )
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
            'client' => array(
                array(
                    'label' => 'Files',
                    'icon' => 'fa fa-file',
                    'route' => 'client-file-index',
                    'resource' => 'client-file-index',
                    'order' => 5,
                    'useRouteMatch' => true
                )
            )
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
            0 => 'file.rest.client-file'
        )
    ),
    'zf-rest' => array(
        'File\\V1\\Rest\\ClientFile\\Controller' => array(
            'listener' => 'File\\V1\\Rest\\ClientFile\\ClientFileResource',
            'route_name' => 'file.rest.client-file',
            'route_identifier_name' => 'client_file_id',
            'collection_name' => 'client_file',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE'
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST'
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'File\\V1\\Rest\\ClientFile\\ClientFileEntity',
            'collection_class' => 'File\\V1\\Rest\\ClientFile\\ClientFileCollection',
            'service_name' => 'ClientFile'
        )
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'File\\V1\\Rest\\ClientFile\\Controller' => 'HalJson'
        ),
        'accept_whitelist' => array(
            'File\\V1\\Rest\\ClientFile\\Controller' => array(
                0 => 'application/vnd.file.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json'
            )
        ),
        'content_type_whitelist' => array(
            'File\\V1\\Rest\\ClientFile\\Controller' => array(
                0 => 'application/vnd.file.v1+json',
                1 => 'application/json'
            )
        )
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'File\\V1\\Rest\\ClientFile\\ClientFileEntity' => array(
                'entity_identifier_name' => 'file_id',
                'route_name' => 'file.rest.client-file',
                'route_identifier_name' => 'client_file_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable'
            ),
            'File\\V1\\Rest\\ClientFile\\ClientFileCollection' => array(
                'entity_identifier_name' => 'file_id',
                'route_name' => 'file.rest.client-file',
                'route_identifier_name' => 'client_file_id',
                'is_collection' => true
            )
        )
    )
);
