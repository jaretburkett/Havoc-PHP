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
    ]
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
    ]
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
    ]
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
    ]
];

