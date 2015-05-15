<?php
/********************
 * Main Dashboard
 *******************/
$route[] = [
    'url' => null,
    'template' => 'main',
    'content' => 'dashboard',
    'data' => [
        'title' => 'iNeed',
        'description' => 'Everything'
    ],
    'needs_auth' => true, // needs to be logged in to access
    'auth_redirect' => 'login' // redirects to auth route if not logged in
];


