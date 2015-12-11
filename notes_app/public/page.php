<?php

require_once("../utils/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET"){
	if (isset($_GET["page"])){

		// get all notes in this page (with the type name) and the fields
		$notes = getPage($_GET["page"]);
		render("page_template.php", ["title" => "Page", "notes" => $notes, "showmodal" => false, "pageid" => $_GET["page"]]);
	
	} else {
		header("Location: index.php");
		die();
	}


} else if ($_SERVER["REQUEST_METHOD"] == "POST"){

	// add a new note
	if (!empty($_POST["typename"])){
		// get the fields from the specified type
		$fields = query(false,  'SELECT C.campocnt, C.nome, T.typecnt
								   FROM campo C, tipo_registo T
								  WHERE C.userid = ?
								 		AND C.typecnt = T.typecnt
								 		AND C.userid = T.userid
								 		AND C.ativo = true
								 		AND T.ativo = true
								 		AND T.nome = ?',
						 $_SESSION["id"],
						 $_POST["typename"]
					);
		// check the reason why the result set was empty 
		if (count($fields) < 1){
			$type = query(false,  "SELECT 	typecnt
								     FROM 	tipo_registo
								    WHERE 	userid = ?
								    		AND ativo = true
								    		AND nome = ?",
								    $_SESSION["id"],
								    $_POST["typename"]
					);

			// if there is no type with that name apologize
			if (count($type) < 1){
				apologize("You have no type with that name. Please enter a valid type.");
				header("Location: page.php");
				die();

			// if the type exists, there are no fields for this type, then get the typeid anyway
			} else {
				$typeid = $type[0]["typecnt"];
			}
		// if everything ok, get the typeid
		} else {
			$typeid = $fields[0]["typecnt"];
		}

		$_SESSION["fields"] = $fields;

		// get all notes in this page (with the type name) and the fields
		$notes = getPage($_POST["pageid"]);
		render("page_template.php", ["title" => "Insert values", 
									 "typeid" => $typeid, 
									 "fields" => $fields, 
									 "showmodal" => true,
									 "notes" => $notes,
									 "pageid" => $_POST["pageid"]]);

	}
}

?>