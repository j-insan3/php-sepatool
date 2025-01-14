<?php

/**
 * A simple, clean and secure PHP Login Script / MINIMAL VERSION
 * For more versions (one-file, advanced, framework-like) visit http://www.php-login.net
 *
 * Uses PHP SESSIONS, modern password-hashing and salting and gives the basic functions a proper login system needs.
 *
 * @author Panique
 * @link https://github.com/panique/php-login-minimal/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("config/db.php");

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

define('APP_PATH', realpath(dirname(__FILE__)));

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
	
	//Bepaal pagina
	$page = htmlspecialchars($_GET["page"]);	
    
	if ($page == 'overzicht') {
	include("views/overzicht.php");
	}
        elseif ($page == 'uitschrijven') {
        include("views/uitschrijven.php");
        }
	elseif ($page == 'verwijder') {
	include("views/verwijder.php");
	}
	elseif ($page == 'create') {
	include("views/create.php");
	}
	elseif ($page == 'update') {
	include("views/update.php");
	}
	elseif ($page == 'updateform') {
	include("views/updateform.php");
	}
	elseif ($page == 'invoeren') {
	include("views/invoeren.php");
	}
	elseif ($page == 'home') {
	include("views/home.php");
	}
        elseif ($page == 'sepaexport') {
        include("views/sepa_xml.php");
        }
	else { 
	echo '<meta http-equiv="refresh" content="0; url=index.php?page=home" />';
	}

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include("views/not_logged_in.php");
}
