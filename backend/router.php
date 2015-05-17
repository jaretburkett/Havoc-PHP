<?php

/**********************************************
 * Check for normal routes in routes/routes.php
 *********************************************/
foreach ($route as &$page) {
    // if the url matches first clean url var
    if($page['url'] == $var1){
        break;
    }
    // remove page array if a match not found
    unset($page);
}

/**********************************************
 * Check for Auth routes in routes/auth_routes.php
 *********************************************/
// only if we didnt get a hit before
if(empty($page)){
    foreach ($auth_route as &$page) {
        // if the url matches first clean url var
        if($page['url'] == $var1){
            // see if they are logged in and attempting to visit auth page.
            // check if they are allowed to see auth page while logged in
            if(isLoggedIn() && $page['allow_auth'] == false){
                // if an auth_redirect set
                if(isset($page['auth_redirect'])) {
                    if($page['auth_redirect'] == null ){
                        // if null, go to root directory
                        header( 'Location: '.$domain.'/' ) ;
                        break;
                    } else {
                        // if something else is specified, go there
                        header('Location: ' . $domain . '/' . $page['auth_redirect'] . '/');
                        break;
                    }
                } elseif($default_auth_redirect == null ){
                    // if null, go to root directory
                    header( 'Location: '.$domain.'/' ) ;
                    break;
                } else{
                    // if something else is specified, go there
                    header( 'Location: '.$domain.'/'.$default_auth_redirect.'/' ) ;
                    break;
                }
            }
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