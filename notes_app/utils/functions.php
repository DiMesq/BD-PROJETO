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
 *	Starts the database.
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
 * 
 * Takes as input a parameter indicating if a transaction should be started, 
 * the normal SQL syntax and additional parameters if needed.
 *
 * If transaction flag parameter is true it is the caller's responsability
 * to end the transaction. 	
 *
 * Executes the statement, returns the primary key for the last row inserted
 * in case of success and -1 in case of failure. Most often returns false 
 * when the statement violates some constraint of the table or database
 */
function update (/* transaction, $sql, [...] */){

	// get the function input
	$args = func_get_args();

	// get the transaction flag
	$transaction = $args[0];

	// get the sql statement
	$sql = $args[1];

	// get the values for the prepared statement
	$params = array_slice($args, 2);

	// start the database
	$db = start_database();

	// begin transaction if requested
	if ($transaction) $db->begintransaction();

	// prepare the sql update statement
    $statement = $db->prepare($sql);
    if ($statement === false) {
        // trigger error
        if ($transaction) $db->rollback();
        trigger_error($handle->errorInfo()[2], E_USER_ERROR);
        exit;
    }
	
	try{
	    // execute the update
	    $statement->execute($params);

	} catch (PDOException $e){
		if ($transaction) $db->rollback();
		return -1;
	}

    return $db->lastInsertId();
}

/**
 * Makes SELECT queries.
 *
 * Takes as input a parameter indicating if a transaction should be started, 
 * the normal SQL query syntax and additional parameters if needed.	
 *
 * If transaction flag parameter is true it is the caller's responsability
 * to end the transaction. 
 * 
 * Returns the resulting rows for the SELECT queries.
 */
function query (/* $transaction, $sql , [...] */){

	// get the function input
	$args = func_get_args();

	// get the transaction flag
	$transaction = $args[0];

	// get the sql statement
	$sql = $args[1];

	// get the values for the prepared statement
	$params = array_slice($args, 2);

	// start de database
	$db = start_database();

	// begin transaction if requested
	if ($transaction) $db->begintransaction();

	// prepare the sql statement
    $statement = $db->prepare($sql);
    if ($statement === false) {
    	if($transaction) $db->rollback();
        // trigger error
        trigger_error($handle->errorInfo()[2], E_USER_ERROR);
        exit;
    }
    try{
    	// execute the query - if its a SELECT still need to fetch
	    $statement->execute($params);
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e){
    	if($transaction) $db->rollback();
    	apologize("Some error occurred.");
    	exit;
    }

    return $results;   
}

/**
 * Ends a transaction
 */
function end_transaction(){
	if (isset($db)){
		$db->commit();
	}
}

/**
 * Inserts the new action in sequencia.
 * Returns the new value of idseq inserted
 */
function next_idseq(){
	// insert the new action in sequence (-1 if error)
	$lastInserted = update(false, "INSERT INTO sequencia (moment, userid)
								 		VALUES (NOW(), ?)",
						   $_SESSION["id"]);
	if ($lastInserted == -1) apologize("Some error ocurred. Please try again.");

	// returns the seqid
	return $lastInserted;
}
/**
 * Renders an apology message to the user
 */
function apologize($message){

	render("apology.php", ["title" => "Error", "message" => $message]);
	exit;

}



?>