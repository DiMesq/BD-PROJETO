<?php

/* Helper functions */

require_once("constants.php");

/**
 * Log out
 */
function logout() {

    // unset any session variables
    $_SESSION = [];

    // expire cookie
    if (!empty($_COOKIE[session_name()])) {
        setcookie(session_name(), "", time() - 42000);
    }

    // destroy session
    session_destroy();
}

/**
 * Renders a template.
 *
 * Input: - template file name;
 *        - array of variables to be available in the template.
 *
 * No return value.
 */
function render ($template, $values=[]){

	if (file_exists("../template/$template")){

		// extract values to local scope
		extract($values);

		require_once("../template/header.php");

		require_once("../template/$template");

		require_once("../template/footer.php");

	} else {
		trigger_error("Invalid template: $template", E_USER_ERROR);
	}
}

/**
 *	Starts the database
 */
function start_database () {
	// try to connect to database
    static $db;
    if (!isset($db)) {
	    try {
	        $db = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE, USERNAME, PASSWORD);
	        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    
		} catch (PDOException $e) {
			// tirgger error
	    	trigger_error($e->getMessage(), E_USER_ERROR);
	        exit;
		}
	}

	return $db;
}

/**
 * Makes UPDATE, INSERT AND DELETE updates to the database.
 * Takes as input the normal SQL syntax and additional 
 * parameters if needed.	
 *
 * Has no return value, only executes the statement.
 */
function update (/* $sql [...] */){

	// get the function input
	$args = func_get_args();

	// get the sql statement
	$sql = $args[0];

	// get the values for the prepared statement
	$params = array_slice($args, 1);

	// start the database
	$db = start_database();

	// prepare the sql update statement
    $statement = $db->prepare($sql);
    if ($statement === false) {
        // trigger error
        trigger_error($handle->errorInfo()[2], E_USER_ERROR);
        exit;
    }
	
    // execute the update
    $statement->execute($params);
    
}

/**
 * Makes SELECT queries.
 * Takes as input the normal SQL query syntax and additional 
 * parameters if needed.	
 *
 * Returns the resulting rows for the SELECT queries.
 */
function query (/* $sql [...] */){

	// get the function input
	$args = func_get_args();

	// get the sql statement
	$sql = $args[0];

	// get the values for the prepared statement
	$params = array_slice($args, 1);

	// start de database
	$db = start_database();

	// prepare the sql statement
    $statement = $db->prepare($sql);
    if ($statement === false) {
        // trigger error
        trigger_error($handle->errorInfo()[2], E_USER_ERROR);
        exit;
    }
	
    // execute the query - if its a SELECT still need to fetch
    $statement->execute($params);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
    
}

/**
 * Renders an apology message to the user
 */
function apologize($message){

	render("apology.php", ["title" => "Error", "message" => $message]);
	exit;

}



?>