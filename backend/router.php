<?php

/**********************************************
 * Check for normal routes in routes/routes.php
 *********************************************/
foreach ($route as &$page) {
    // if the url matches first clean url var
    if($page['url'] == $var1){
        break;
    }
    unset($page);
}

/**********************************************
 * Check for Auth routes in routes/auth_routes.php
 *********************************************/
if(empty($page)){
    foreach ($auth_route as &$page) {
        // if the url matches first clean url var
        if($page['url'] == $var1){
            break;
        }
        unset($page);
    }
}

// TODO add 404 routes


// check if needs auth
if (array_key_exists('needs_auth', $page)) {
    if($page['needs_auth']) {
        // if a non auth redirect is defined in route
        if (array_key_exists('auth_redirect', $page)) {
            // if not logged in, redirect
            if(!isLoggedIn()){
                // redirect to the route var auth_redirect
                header( 'Location: '.$domain.'/'.$page['auth_redirect'].'/' ) ;
            }
        } else {
            // if not logged in
            if(!isLoggedIn()) {
                // redirect to the default redirect if no auth redirect passed on route
                header('Location: ' . $domain . '/' . $default_nonauth_redirect . '/');
            }
        }
    }
}

// These are the droids you are looking for.

/******************************
 *  Route is now in $page array
 *****************************/

// put data in simple $data array for simplicity
$data = $page['data'];