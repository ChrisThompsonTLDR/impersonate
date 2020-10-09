<?php
return [
    'require_debug' => false,  //  only allow impersonation if debugging is enabled

    'routes' => [
        'prefix'          => '',
        'start'           => 'impersonate/{user}',
        'stop'            => 'impersonate/stop',
        'afterStart'      => '/',  //  where user goes after starting impersonation
        'afterStop'       => '/',  //  where user goes after stopping impersonation
        'middlewareGroup' => 'web',  //  middleware group that impersonate is attached to
    ],

    'flash' => [
        'error'   => 'error',  //  what errors are keyed with
        'success' => 'success'  //  what errors are keyed with
    ],

    'blade' => 'impersonate::stop',  //  set to null to disable/show no blade
];
