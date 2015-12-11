<?php

require_once("../utils/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET"){

	render("login_form.php", ["title" => "Login"]);

} else if ($_SERVER["REQUEST_METHOD"] == "POST"){

	if (empty($_POST["email"])) {
		apologize("Please enter your email.");
	}
	
	// get the user from the database
	$query = "SELECT userid, password FROM utilizador WHERE email = ?";

	$results = query (false, $query, $_POST["email"]);

	// if the user doesnt exist throw message
	if (count($results) != 1){
		apologize("Error with the input. Please check your email and password and enter them again.");
	}

	// login if passwords are the same (not encrypting passwords)
	$user = $results[0];
	
	if ($_POST["password"] == $user["password"]){
		$_SESSION["id"] = $user["userid"];
		header("Location: index.php");
	}
	// error message - wrong password
	else{
		apologize("Error with the input. Please check your email and password and enter them again.");
	}
	
}

?>
