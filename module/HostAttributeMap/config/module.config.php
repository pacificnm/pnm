<?php
return array(
    'module' => array(
        'HostAttributeMap' => array(
            'name' => 'HostAttributeMap',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'user-accountant' => array(),
                'user-manager' => array(),
                'employee' => array(
                    'host-attribute-map-index',
                    'host-attribute-map-create',
                    'host-attribute-map-delete',
                    'host-attribute-map-update',
                    'host-attribute-map-view'
                ),
                'accountant' => array(),
                'administrator' => array()
            )
            
        )
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array(
            'HostAttributeMap\Controller\Index' => 'HostAttributeMap\Controller\Factory\IndexControllerFactory',
            'HostAttributeMap\Controller\Create' => 'HostAttributeMap\Controller\Factory\CreateControllerFactory',
            'HostAttributeMap\Controller\Delete' => 'HostAttributeMap\Controller\Factory\DeleteControllerFactory',
            'HostAttributeMap\Controller\Update' => 'HostAttributeMap\Controller\Factory\UpdateControllerFactory',
            'HostAttributeMap\Controller\View' => 'HostAttributeMap\Controller\Factory\ViewControllerFactory',
            
          )
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'HostAttributeMap\Service\MapServiceInterface' => 'HostAttributeMap\Service\Factory\MapServiceFactory',
            'HostAttributeMap\Mapper\MapMapperInterface' => 'HostAttributeMap\Mapper\Factory\MapMapperFactory',
            'HostAttributeMap\Form\WorkstationForm' => 'HostAttributeMap\Form\Factory\WorkstationFormFactory',
            'HostAttributeMap\Form\ServerForm' => 'HostAttributeMap\Form\Factory\ServerFormFactory',
            'HostAttributeMap\Form\TabletForm' => 'HostAttributeMap\Form\Factory\TabletFormFactory',
            'HostAttributeMap\Form\LaptopForm' => 'HostAttributeMap\Form\Factory\LaptopFormFactory',
            'HostAttributeMap\Form\PrinterForm' => 'HostAttributeMap\Form\Factory\PrinterFormFactory',
            'HostAttributeMap\Form\CopierForm' => 'HostAttributeMap\Form\Factory\CopierFormFactory',
            'HostAttributeMap\Form\ScannerForm' => 'HostAttributeMap\Form\Factory\ScannerFormFactory',
            'HostAttributeMap\Form\RouterForm' => 'HostAttributeMap\Form\Factory\RouterFormFactory',
            'HostAttributeMap\Form\WirelessRouterForm' => 'HostAttributeMap\Form\Factory\WirelessRouterFactory',
            'HostAttributeMap\Form\AccessPointForm' => 'HostAttributeMap\Form\Factory\AccessPointFormFactory',
            'HostAttributeMap\Form\OtherForm' => 'HostAttributeMap\Form\Factory\OtherFormFactory',
        )
    ),
    
    // router
    'router' => array(
        'routes' => array(
            'host-attribute-map-index' => array(
                'title' => 'Host Attributes',
                'type' => 'literal',
                'options' => array(
                    'route' => '/client/[:clientId]/host/[:hostId]/attribute',
                    'defaults' => array(
                        'controller' => 'HostAttributeMap\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'host-attribute-map-create' => array(
                'title' => 'Create Host Attributes',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/host/[:hostId]/attribute/create',
                    'defaults' => array(
                        'controller' => 'HostAttributeMap\Controller\Create',
                        'action' => 'index'
                    )
                )
            ),
            'host-attribute-map-delete' => array(
                'title' => 'Delete Host Attributes',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/host/[:hostId]/attribute/delete',
                    'defaults' => array(
                        'controller' => 'HostAttributeMap\Controller\Delete',
                        'action' => 'index'
                    )
                )
            ),
            'host-attribute-map-update' => array(
                'title' => 'Edit Host Attributes',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/host/[:hostId]/attribute/update',
                    'defaults' => array(
                        'controller' => 'HostAttributeMap\Controller\Update',
                        'action' => 'index'
                    )
                )
            ),
            'host-attribute-map-view' => array(
                'title' => 'View Host Attributes',
                'type' => 'segment',
                'options' => array(
                    'route' => '/client/[:clientId]/host/[:hostId]/attribute/[:hostAttributeMapId]/view',
                    'defaults' => array(
                        'controller' => 'HostAttributeMap\Controller\View',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);