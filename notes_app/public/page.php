<?php

require_once("../utils/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET"){
	if (isset($_GET["page"])){

		// get all notes in this page (with the type name)
		$notes = query(false,  "SELECT 	RP.pageid, R.regcounter, R.nome as rnome, T.typecnt, T.nome as tnome
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
					     $_GET["page"]
			    );

		// for each note in the page get the associated values
		foreach ($notes as $key => $note) {
			$fields = query(false,  "SELECT C.campocnt, C.nome as cnome, V.valor
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
		render("page_template.php", ["title" => "Page", "notes" => $notes, "showmodal" => false]);
	
	} else {
		header("Location: index.php");
		die();
	}


} else if ($_SERVER["REQUEST_METHOD"] == "POST"){

	if (!empty($_POST["typename"])){
		// get the fields from the specified type
		$fields = query(false,  "SELECT C.campocnt, C.nome, T.typecnt
								   FROM campo C, tipo_registo T
								  WHERE C.userid = ?
								 		AND C.typecnt = T.typecnt
								 		AND C.userid = T.userid
								 		AND C.ativo = true
								 		AND T.nome = ?",
						 $_SESSION["id"],
						 $_POST["typename"]
					);
		// check the reason why the result set was empty 
		if (count($fields) < 1){
			$type = query(false,  "SELECT 	typecnt
								     FROM 	tipo_registo
								    WHERE 	userid = ?
								    		AND nome = ?",
								    $_SESSION,
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
			$typeid = $fields[0]["tyepcnt"];
		}

		render("insert_note_template.php", ["title" => "Insert values", "typeid" => $typeid, "fields" => $fields]);

	}
}

?>