<?php

/**
 * Require authentication for the pages that need it
 */

// display errors, warnings, and notices
ini_set("display_errors", true);
error_reporting(E_ALL);

// requirements
require("constants.php");
require("functions.php");

// enable sessions
session_start();

// require authentication for all pages except the specified
if (!in_array($_SERVER["PHP_SELF"], ["/login.php", "/logout.php", "/register.php", "/index.php"])){

	if (isempty($_SESSION["id"])){
		render("index.php");
	}
}

?>

