<?php

/**
 * Require authentication for the pages that need it
 */

// display errors, warnings, and notices
ini_set("display_errors", true);
error_reporting(E_ALL);

// requirements
require_once("constants.php");
require_once("functions.php");

// enable sessions
session_start();


$aux = $_SERVER["PHP_SELF"];
$aux = strrev($aux);
$tamanho = strpos($aux, '/');
$aux = substr($aux, 0, $tamanho+1);

$resultado = strrev($aux);

// require authentication for all pages except the specified

if (!in_array($resultado, ["/login.php", "/logout.php", "/register.php", "/home.php"])){

	if (empty($_SESSION["id"])){

		header("Location: home.php");
		die();
	} 
}

?>