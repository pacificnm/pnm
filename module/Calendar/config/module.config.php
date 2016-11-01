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
        
        // employee
        'employee' => array(
            array(
                array(
                    'label' => 'My Profile',
                    'icon' => 'fa fa-gears',
                    'route' => 'employee-profile',
                    'submenu' => array(
                        array(
                            'label' => 'Calendar',
                            'icon' => 'fa fa-calendar',
                            'route' => 'employee-calendar'
                        )
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