<?php

require_once("../utils/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET"){

	if (isset($_GET["type"])){

		// get all fields in this type 
		$fields = query("SELECT campocnt, nome
					      FROM 	campo
					     WHERE 	userid = ?
					     		AND ativo  = true
					     		AND typecnt = ?",
			     $_SESSION["id"],
			     $_GET["type"]
			    );
		// get the type name
		$typename = query("SELECT 	nome
						   FROM 	tipo_registo
						   WHERE 	userid = ?
						   			AND typecnt = ?",
							$_SESSION["id"],
							$_GET["type"]);
		$tname = $typename[0]["nome"];

		render("type_template.php", ["title" => "Fields", 
									"fields" => $fields, 
									"typeid" => $_GET["type"], 
									"tname" => $tname
		]);
	
	} else {
		header("Location: index.php");
		die();
	}


} else if ($_SERVER["REQUEST_METHOD"] == "POST"){

 	// add a new field
	if (!empty($_POST["fieldname"])){
		
		// gets the max value for the campocnt
		$max = query("SELECT 	MAX(campocnt) as max
				   		FROM 	campo
				   		WHERE 	userid = ?
				   		      	AND typecnt = ?",
			   		  $_SESSION["id"],
			   		  $_POST["typeid"]
			   	);

		// new type counter set to max + 1 or 1 if no fields before
		if ($max == NULL) {
			$campoid = 1;
		
		} else {
			$campoid = $max[0]["max"] + 1;
		}

		// insert the new action in sequence and get the next value to insert
		$idseq = next_idseq();

		$lastInserted = update("INSERT INTO campo (userid, typecnt, campocnt, nome, idseq, ativo)
			         				VALUES (?, ?, $campoid, ?, $idseq, true)",
			   			  $_SESSION["id"],
			   			  $_POST["typeid"],
			              $_POST["fieldname"]
		);

		if ($lastInserted == -1){
			apologize("Duplicate name for field. Please pick a different name for your field.");
		}

		// get the notes of this type
		$notes = query("SELECT 	R.regcounter
						FROM 	registo R
						WHERE 	R.userid = ?
								AND R.typecounter = ?",
						$_SESSION['id'],
						$_POST['typeid']);

		// insert the new field in every note of this type with empty value
		foreach ($notes as $key => $note) {

			// get the idseq value
			$iseq = next_idseq();

			update("INSERT INTO valor (userid, typeid, campoid, regid, valor, idseq, ativo) 
						VALUES (?, ?, $campoid, ?, '', $idseq, true)",
					$_SESSION["id"],
					$_POST["typeid"],
					$note["regcounter"]);
		}
	}

	// delete field
	if (!empty($_POST["fieldIdDelete"])){
		update("UPDATE 	campo
				   SET 	ativo = false 
			     WHERE 	campocnt = ?
					    AND userid = ?
					    AND typecnt = ?", 
			   $_POST["fieldIdDelete"],
			   $_SESSION["id"],
			   $_POST["typeid"]
		);
	}

	header("Location: type.php?type=" . $_POST["typeid"]);
	exit;
}

?>