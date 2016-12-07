<?php
return [
    'require_debug' => false,  //  only allow impersonation if debugging is enabled

    'routes' => [
        'prefix'          => '',
        'start'           => 'impersonate/{id}',
        'stop'            => 'impersonate/stop',
        'afterStart'      => '/',  //  where user goes after starting impersonation
        'afterStop'       => '/',  //  where user goes after stopping impersonation
        'middlewareGroup' => 'web',  //  middleware group that impersonate is attached to
    ],

    'flash' => [
        'error'   => 'error',  //  what errors are keyed with
        'success' => 'success'  //  what errors are keyed with
    ],

    'btn' => [
        'id'    => 'btn-impersonate',
        'class' => 'btn btn-sm btn-danger',
        'style' => 'position: absolute;top: 0;right: 0;',
        'icon'  => 'glyphicon glyphicon-repeat',
        'text'  => '',
    ]
];