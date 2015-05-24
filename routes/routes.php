<?php
/********************
 * Main Dashboard
 *******************/
$route[] = [
    'url' => null,
    'template' => 'main',
    'content' => 'home',
    'data' => [
        'title' => $website_name,
        'description' => 'Welcome to '. $website_name
    ],
    'needs_auth' => true, // needs to be logged in to access
    'auth_redirect' => 'login' // redirects to auth route if not logged in
];



/**********************
 * 404 not found
 *********************/
$route_404[] = [
    'template' => 'main',
    'content' => '404',
    'data' => [
        'title' => '404 '.$website_name,
        'description' => 'Welcome to havoc'
    ]
];