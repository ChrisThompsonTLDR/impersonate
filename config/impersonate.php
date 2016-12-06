<?php
return [
    'require_debug' => false,  //  only allow impersonation if debugging is enabled

    'routes' => [
        'prefix'     => '',
        'start'      => 'impersonate/{id}',
        'stop'       => 'impersonate/stop',
        'afterStart' => '/',  //  where user goes after starting impersonation
        'afterStop'  => '/',  //  where user goes after stopping impersonation
    ],

    'flash' => [
        'error'   => 'error',  //  what errors are keyed with
        'success' => 'success'  //  what errors are keyed with
    ]
];