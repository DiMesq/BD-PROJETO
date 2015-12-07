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

// require authentication for all pages except the specified
if (!in_array($_SERVER["PHP_SELF"], ["/login.php", "/logout.php", "/register.php", "/home.php"])){

	if (empty($_SESSION["id"])){

		header("Location: home.php");
		die();
	}
}

?>