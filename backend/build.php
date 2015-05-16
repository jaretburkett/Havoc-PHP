<?php
/*******************************************************************
 * Build the Framework
 *
 * This is the sonic screwdriver. It is where all the magic happens.
 *******************************************************************/

// include framework variables
include ($_SERVER['DOCUMENT_ROOT'].'/config/vars.php');

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
include ($_SERVER['DOCUMENT_ROOT'].'/backend/auth/auth_functions.php');

// include the routes
include($_SERVER['DOCUMENT_ROOT'] . '/routes/routes.php');
include($_SERVER['DOCUMENT_ROOT'] . '/routes/auth_routes.php');

// include router
include($_SERVER['DOCUMENT_ROOT'] . '/backend/router.php');

//content added to var for easy include
$content = ($_SERVER['DOCUMENT_ROOT'].'/views/content/'. $page['content'].'.php');

// get the template
include ($_SERVER['DOCUMENT_ROOT'].'/views/templates/'. $page['template'].'.php');


