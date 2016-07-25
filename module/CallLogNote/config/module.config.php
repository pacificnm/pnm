<?php
return array(
    'module' => array(
        'CallLogNote' => array(
            'name' => 'CallLogNote',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(
                    0 => 'call-log-note-create',
                    1 => 'call-log-note-delete',
                    2 => 'call-log-note-update',
                ),
                'accountant' => array(),
                'administrator' => array(),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'CallLogNote\\Controller\\CreateController' => 'CallLogNote\\Controller\\Factory\\CreateControllerFactory',
            'CallLogNote\\Controller\\UpdateController' => 'CallLogNote\\Controller\\Factory\\UpdateControllerFactory',
            'CallLogNote\\Controller\\DeleteController' => 'CallLogNote\\Controller\\Factory\\DeleteControllerFactory',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'CallLogNote\\Service\\NoteServiceInterface' => 'CallLogNote\\Service\\Factory\\NoteServiceFactory',
            'CallLogNote\\Mapper\\NoteMapperInterface' => 'CallLogNote\\Mapper\\Factory\\NoteMapperFactory',
            'CallLogNote\\V1\\Rest\\CallLogNote\\CallLogNoteResource' => 'CallLogNote\\V1\\Rest\\CallLogNote\\CallLogNoteResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'call-log-note-create' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/call-log/[:callLogId]/call-log-note/create',
                    'defaults' => array(
                        'controller' => 'CallLogNote\\Controller\\CreateController',
                        'action' => 'index',
                    ),
                ),
            ),
            'call-log-note-update' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/call-log/[:callLogId]/call-log-note/[:callLogNoteId]/update',
                    'defaults' => array(
                        'controller' => 'CallLogNote\\Controller\\UpdateController',
                        'action' => 'index',
                    ),
                ),
            ),
            'call-log-note-delete' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/call-log/[:callLogId]/call-log-note/[:callLogNoteId]/delete',
                    'defaults' => array(
                        'controller' => 'CallLogNote\\Controller\\DeleteController',
                        'action' => 'index',
                    ),
                ),
            ),
            'call-log-note.rest.call-log-note' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/api/call-log-note[/:call_log_note_id]',
                    'defaults' => array(
                        'controller' => 'CallLogNote\\V1\\Rest\\CallLogNote\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            0 => __DIR__ . '/../view',
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'call-log-note.rest.call-log-note',
        ),
    ),
    'zf-rest' => array(
        'CallLogNote\\V1\\Rest\\CallLogNote\\Controller' => array(
            'listener' => 'CallLogNote\\V1\\Rest\\CallLogNote\\CallLogNoteResource',
            'route_name' => 'call-log-note.rest.call-log-note',
            'route_identifier_name' => 'call_log_note_id',
            'collection_name' => 'call_log_note',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
                3 => 'POST',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(
                0 => 'callLogId',
            ),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'CallLogNote\\Entity\\NoteEntity',
            'collection_class' => 'CallLogNote\\V1\\Rest\\CallLogNote\\CallLogNoteCollection',
            'service_name' => 'CallLogNote',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'CallLogNote\\V1\\Rest\\CallLogNote\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'CallLogNote\\V1\\Rest\\CallLogNote\\Controller' => array(
                0 => 'application/vnd.call-log-note.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'CallLogNote\\V1\\Rest\\CallLogNote\\Controller' => array(
                0 => 'application/vnd.call-log-note.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'CallLogNote\\Entity\\NoteEntity' => array(
                'entity_identifier_name' => 'call_log_note_id',
                'route_name' => 'call-log-note.rest.call-log-note',
                'route_identifier_name' => 'call_log_note_id',
                'hydrator' => 'CallLogNote\\Hydrator\\NoteHydrator',
            ),
            'CallLogNote\\V1\\Rest\\CallLogNote\\CallLogNoteCollection' => array(
                'entity_identifier_name' => 'call_log_note_id',
                'route_name' => 'call-log-note.rest.call-log-note',
                'route_identifier_name' => 'call_log_note_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'CallLogNote\\V1\\Rest\\CallLogNote\\Controller' => array(
            'input_filter' => 'CallLogNote\\V1\\Rest\\CallLogNote\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'CallLogNote\\V1\\Rest\\CallLogNote\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogNoteId',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogId',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogNoteText',
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogNoteCreateBy',
            ),
            4 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'callLogCreated',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'CallLogNote\\V1\\Rest\\CallLogNote\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => true,
                    'POST' => true,
                    'PUT' => true,
                    'PATCH' => false,
                    'DELETE' => true,
                ),
            ),
        ),
    ),
);
