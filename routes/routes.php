<?php
/********************
 * Main Dashboard
 *******************/
$route[] = [
    'url' => null,
    'template' => 'main',
    'content' => 'home',
    'data' => [
        'title' => 'Havoc',
        'description' => 'Welcome to havoc'
    ],
    'needs_auth' => true, // needs to be logged in to access
    'auth_redirect' => 'login' // redirects to auth route if not logged in
];


