<?php
return array(
    'module' => array(
        'Calendar' => array(
            'name' => 'Calendar',
            'version' => '2.5'
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
                        'label' => 'Calendar',
                        'route' => 'employee-calendar',
                        'useRouteMatch' => true
                    )
                )
            )
        )
    ),
    // menu
    'menu' => array(    
        'default' => array(
            'employee' => array(
                array(
                    'label' => 'View calendar',
                    'icon' => 'fa fa-calendar',
                    'route' => 'employee-calendar',
                    'resource' => 'employee-calendar',
                    'order' => 4
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
    )
);