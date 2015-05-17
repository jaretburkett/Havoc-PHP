<?php

/**********************
 *  Login Page
 *********************/
$auth_route[]=[
    'url' => 'login',
    'template' => 'auth',
    'content' => 'auth/login',
    'data' => [
        'title' => 'Havoc - Login',
        'description' => 'Login to Havoc'
    ],
    'allow_auth' => false, // dont allows authenticated users to visit
    'auth_redirect' => null // redirect to home page if logged in
];

/**********************
 *  Register Page
 *********************/
$auth_route[]=[
    'url' => 'register',
    'template' => 'auth',
    'content' => 'auth/register',
    'data' => [
        'title' => 'Havoc - Register',
        'description' => 'Sign Up to Havoc'
    ],
    'allow_auth' => false, // dont allows authenticated users to visit
    'auth_redirect' => null // redirect to home page if logged in
];

/**********************
 *  Confirm Email Page
 *********************/
$auth_route[]=[
    'url' => 'confirm_email',
    'template' => 'auth',
    'content' => 'auth/confirm_email',
    'data' => [
        'title' => 'Havoc - Email Confirmed',
        'description' => 'You have sucessfully confirmed your email'
    ],
    'allow_auth' => false, // dont allows authenticated users to visit
    'auth_redirect' => null // redirect to home page if logged in
];

/**********************
 * Forgot Password
 *********************/
$auth_route[]=[
    'url' => 'forgot_password',
    'template' => 'auth',
    'content' => 'auth/forgot_password',
    'data' => [
        'title' => 'Havoc - Forgot Password',
        'description' => 'Reset your password'
    ],
    'allow_auth' => false, // dont allows authenticated users to visit
    'auth_redirect' => null // redirect to home page if logged in
];

/**********************
 *  logout page
 *********************/
$auth_route[]=[
    'url' => 'logout',
    'template' => 'auth',
    'content' => 'auth/logout',
    'data' => [
        'title' => 'Havoc - Logout',
        'description' => 'Logging you out'
    ],
    'allow_auth' => true // allows authenticated users to visit
];

