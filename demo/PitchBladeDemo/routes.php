<?php

$routes = [
    'dashboard' => [
        'requirements' => [
            'path' => '#^/?$#',
            'method' => 'get',
        ],
        'view' => '\\PitchBladeDemo\\Views\\FrontPage',
        'controller' => [
            'name' => '\\PitchBladeDemo\\Controllers\\Index',
            'action' => 'frontpage',
        ],
    ],
];
