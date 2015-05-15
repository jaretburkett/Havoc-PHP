<?php

/**********************
 *  Login Page
 *********************/
$auth_route[]=[
    'url' => 'login',
    'template' => 'auth',
    'content' => 'login',
    'data' => [
        'title' => 'iNeed - Login',
        'description' => 'Login to iNeed'
    ]
];

/**********************
 *  Register Page
 *********************/
$auth_route[]=[
    'url' => 'register',
    'template' => 'auth',
    'content' => 'register',
    'data' => [
        'title' => 'iNeed - Register',
        'description' => 'Sign Up to iNeed'
    ]
];


