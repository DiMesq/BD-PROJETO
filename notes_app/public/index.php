<?php
	
require_once("../utils/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET"){
	// get the user pages
	$pages = query("SELECT pagecounter, nome 
					FROM pagina 
					WHERE userid = ? and ativa = true", 
					$_SESSION["id"]);

	// get the user types
	$types = query("SELECT typecnt, nome 
					FROM tipo_registo
					WHERE userid = ? and ativo = true", 
					$_SESSION["id"]);

	render("user.php", ["title" => "Home", "pages" => $pages, "types" => $types]);

} else if ($_SERVER["REQUEST_METHOD"] == "POST"){

	// delete page
	if (!empty($_POST["pageIdDelete"])){
		query("UPDATE 	pagina
			      SET 	ativa = false 
			    WHERE 	pagecounter = ?
			         	AND userid = ?", 
			   $_POST["pageIdDelete"],
			   $_SESSION["id"]
		);

	// delete type 
	} else if (!empty($_POST["typeIdDelete"])){
		query("UPDATE 	tipo_registo 
			      SET   ativo = false 
			   WHERE 	typecnt = ?
			   			AND userid = ?",
			   	$_POST["typeIdDelete"],
			   	$_SESSION["id"]
		);
	
	// add page	
	} else if (!empty($_POST["pagename"])){

		// gets the max value for the pagecounter
		$max = query("SELECT 	MAX(pagecounter) as max
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

		query("INSERT INTO 	pagina (userid, pagecounter, nome, idseq, ativa)
			        VALUES (?, $pageid, ?, 1, true)",
			   $_SESSION["id"],
			   $_POST["pagename"]
		);

	}


	header("Location: index.php");
	die();
}
?>