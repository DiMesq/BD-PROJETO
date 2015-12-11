<?php
	
require_once("../utils/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET"){
	// get the user pages
	$pages = query(false, "SELECT pagecounter, nome 
							FROM pagina 
							WHERE userid = ? and ativa = true", 
					$_SESSION["id"]);

	// get the user types
	$types = query(false, "SELECT typecnt, nome 
							FROM tipo_registo
							WHERE userid = ? and ativo = true", 
					$_SESSION["id"]);

	render("user.php", ["title" => "Home", "pages" => $pages, "types" => $types]);

} else if ($_SERVER["REQUEST_METHOD"] == "POST"){

	// delete page
	if (!empty($_POST["pageIdDelete"])){
		update(false, "UPDATE 	pagina
					      SET 	ativa = false 
					    WHERE 	pagecounter = ?
					         	AND userid = ?", 
			   $_POST["pageIdDelete"],
			   $_SESSION["id"]
		);

	// delete type 
	} else if (!empty($_POST["typeIdDelete"])){
		update(false, "UPDATE 	tipo_registo 
					      SET   ativo = false 
					   WHERE 	typecnt = ?
					   			AND userid = ?",
			   	$_POST["typeIdDelete"],
			   	$_SESSION["id"]
		);
	
	// add page	
	} else if (!empty($_POST["pagename"])){
		// gets the max value for the pagecounter
		$max = query(false, "SELECT 	MAX(pagecounter) as max
					   		   FROM 	pagina
					   		  WHERE 	userid = ?",
			   		  $_SESSION["id"]
			   	);

		// new page counter set to max + 1 or 1 if no pages before
		if ($max == NULL) {
			$pageid = 1;
		
		} else {
			$pageid = $max[0]["max"] + 1;
		}

		// gets the next ideseq and inserts the action in the sequencia table
		$idseq = next_idseq();

		// inserts the new page in the table
		$lastInserted = update(false, "INSERT INTO 	pagina (userid, pagecounter, nome, idseq, ativa)
			         						VALUES 	(?, $pageid, ?, $idseq, true)",
			   			   $_SESSION["id"],
			               $_POST["pagename"]
		);

		// apologize if the user gave an already existing name for the page
		if ($lastInserted == -1){
			apologize("Duplicate name for page. Please pick a different name for your page.");
		}

	//add type
	} else if (!empty($_POST["typename"])){
		// gets the max value for the typecnt
		$max = query(false, "SELECT 	MAX(typecnt) as max
				   			   FROM 	tipo_registo
				   		      WHERE 	userid = ?",
			   		  $_SESSION["id"]
			   	);

		// new type counter set to max + 1 or 1 if no pages before
		if ($max == NULL) {
			$typeid = 1;
		
		} else {
			$typeid = $max[0]["max"] + 1;
		}

		// insert the new action in sequence
		$idseq = next_idseq();

		$lastInserted = update(false, "INSERT INTO tipo_registo (userid, typecnt, nome, idseq, ativo)
			         						VALUES (?, $typeid, ?, $idseq, true)",
			   			  $_SESSION["id"],
			              $_POST["typename"]
		);

		if ($lastInserted == -1){
			apologize("Duplicate name for type. Please pick a different name for your type.");
		}

	}


	header("Location: index.php");
	die();
}
?>