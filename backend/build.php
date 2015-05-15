<?php
/*******************************************************************
 * Build the Framework
 *
 * This is the sonic screwdriver. It is where all the magic happens.
 *******************************************************************/

// include framework variables
include (DIR_ROOT.'/config/vars.php');

/***********************
 * Process Vars
 **********************/

if($report_errors){
    // report errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(-1);
}

// include auth functions
include (DIR_ROOT.'/backend/auth/auth_functions.php');

// include the routes
include(DIR_ROOT . '/routes/routes.php');
include(DIR_ROOT . '/routes/auth_routes.php');

// include router
include(DIR_ROOT . '/backend/router.php');

//content added to var for easy include
$content = $pathtocontent. $page['content'].'.php';

// get the template
include $pathtotemplates . $page['template'].'.php';


