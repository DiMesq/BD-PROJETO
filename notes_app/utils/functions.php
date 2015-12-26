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
 * Takes as input the normal SQL syntax and additional parameters if needed.
 *
 * Executes the statement, returns the primary key for the last row inserted
 * in case of success and -1 in case of failure. The primary reason for returning
 * false is that the update violates some constraint of the table or database.
 */
function update (/* transaction, $sql, [...] */){

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
	
	try{
	    // execute the update
	    $statement->execute($params);

	} catch (PDOException $e){
		return -1;
	}

    return $db->lastInsertId();
}

/**
 * Makes SELECT queries.
 *
 * Takes as input the normal SQL query syntax and additional parameters if needed.	
 * 
 * Returns the resulting rows for the SELECT queries.
 */
function query (/* $transaction, $sql , [...] */){

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
    try{
	    	// execute the query - if its a SELECT still need to fetch
	    $statement->execute($params);
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);


    } catch (PDOException $e){
    	apologize("Some error occurred.");
    	exit;
    }

    return $results;   
}

/**
 * Inserts the new action in sequencia.
 * Returns the new value of idseq inserted
 */
function next_idseq(){
	// insert the new action in sequence (-1 if error)
	$lastInserted = update("INSERT INTO sequencia (moment, userid)
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

/**
 * Gets all the content in a page.
 * This includes all the notes and all the fields in the notes
 */
function getPage($page){
	// get all notes in this page (with the type name)
	$notes = query("SELECT 	RP.pageid, R.regcounter, R.nome as rnome, T.typecnt, T.nome as tnome
				      FROM 	registo R, tipo_registo T, reg_pag RP
				     WHERE 	R.userid = ?
				     		AND RP.pageid = ?
				     		AND RP.regid = R.regcounter
				     		AND R.userid = T.userid
				     		AND R.userid = RP.userid
				     		AND RP.ativa = true
				     		AND R.ativo  = true
				     		AND T.ativo  = true
				     		AND R.typecounter = T.typecnt
				     		AND RP.typeid = T.typecnt",
				     $_SESSION["id"],
				     $page
		    );

	// for each note in the page get the associated values
	foreach ($notes as $key => $note) {
		$fields = query("SELECT C.campocnt, C.nome as cnome, V.valor
						   FROM registo R, campo C, valor V
						  WHERE R.userid = ?
						 		AND R.regcounter = ?
						 		AND R.typecounter = ?
						 		AND R.ativo = true
						 		AND C.typecnt = R.typecounter
						 		AND C.userid = R.userid
						 		AND C.ativo = true
						 		AND V.userid = R.userid
						 		AND V.typeid = C.typecnt
						 		AND V.campoid = C.campocnt
						 		AND V.regid = R.regcounter
						 		AND V.ativo = true",
						 $_SESSION["id"],
						 $note["regcounter"],
						 $note["typecnt"]
						);
		// put the notes values info on the array
		$notes[$key]["fields"] = $fields;
	}

	return $notes;
}

?>