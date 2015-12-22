<?php
/*
 * Set specific configuration variables here
 */
return [
    // automatic loading of routes through main service provider
    'routes'     => true,

    // email view
    'activation' => 'email::activation',

    // where to redirect user to change their current email, if CheckEmail middleware applied
    'redirect'   => 'my/email',

    // don't apply CheckPassword middleware to following url pattern
    'except'     => [
        'my/email/activation/*',
        '_debugbar/*',
    ]
];
