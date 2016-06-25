<?php
return array(
    'module' => array(
        'WorkorderEmployee' => array(
            'name' => 'WorkorderEmployee',
            'version' => '2.5',
            'acl' => array(
                'guest' => array(),
                'user' => array(),
                'employee' => array(),
                'accountant' => array(),
                'administrator' => array()
            )
        ),
    ),
    
    // controllers
    'controllers' => array(
        'factories' => array()
    ),
    
    // service manager
    'service_manager' => array(
        'factories' => array(
            'WorkorderEmployee\Mapper\WorkorderEmployeeMapperInterface' => 'WorkorderEmployee\Mapper\Factory\WorkorderEmployeeMapperFactory',
            'WorkorderEmployee\Service\WorkorderEmployeeServiceInterface' => 'WorkorderEmployee\Service\Factory\WorkorderEmployeeServiceFactory',
       
            'WorkorderEmployee\Form\WorkorderEmployeeForm' => 'WorkorderEmployee\Form\Factory\WorkorderEmployeeFormFactory'
        )
    ),
    
    // router
    'router' => array(
        'routes' => array()
    ),
    
    // view manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);