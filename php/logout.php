<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL-E_NOTICE);
/**
*
*	This is the login page, it collects login credentials and attempt to log onto the system.
*	It will set the initial log in session and allow for access to the reset of the system. 
*	-Gavin Palmer || March 2016
*
*/

$dir="../";
require_once($dir."classes/Session_Manager.php");


$Session_Manager = new Session_Manager();  //Create Session Manager Objetc -Gavin Palmer || March 2016

$sid = $Session_Manager->logout(); //log out -Gavin Palmer || March 2016

session_destroy(); 


?>