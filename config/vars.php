<?php
$report_errors = TRUE;
// the default auth route to redirect to if route requires
//auth and they are not logged in. Can be overridden in routes.
$default_nonauth_redirect = 'login';

// the default route to redirect to if they try to visit an
//auth page and they are logged in
$default_auth_redirect = null;

// this is used in various places in the login scripts
$website_name = 'HavocPHP';

/**********************
 * Set Domain Name
 *********************/
//check if domain http or https needed for local server
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    $protocol = 'https';
} else {
    $protocol = 'http';
}
// set domain
$domain = $protocol . "://" . $_SERVER['HTTP_HOST'];

/**********************
 * Set linkers
 *********************/
$pathtopartials = $_SERVER['DOCUMENT_ROOT'].'/includes/partials/';
$pathtocontent = $_SERVER['DOCUMENT_ROOT'].'/includes/content/';
$pathtosections = $_SERVER['DOCUMENT_ROOT'].'/includes/sections/';
$pathtosnippets = $_SERVER['DOCUMENT_ROOT'].'/includes/snippets/';
$pathtotemplates = $_SERVER['DOCUMENT_ROOT'].'/includes/templates/';

// make east include for connect. just include $connect;
$connect =  $_SERVER['DOCUMENT_ROOT'].'/config/connect.php';

// set a town for the demo
$town = 'Midland, TX';

/***********************
 * Get URL Vars
 **********************/
if(isset($_GET['var1'])) $var1 = $_GET['var1']; else $var1 = null;
if(isset($_GET['var2'])) $var2 = $_GET['var2']; else $var2 = null;
if(isset($_GET['var3'])) $var3 = $_GET['var3']; else $var3 = null;
if(isset($_GET['var4'])) $var4 = $_GET['var4']; else $var4 = null;
if(isset($_GET['var5'])) $var5 = $_GET['var5']; else $var5 = null;
if(isset($_GET['var6'])) $var6 = $_GET['var6']; else $var6 = null;



