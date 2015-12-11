<?php

require_once("../utils/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET"){
	if (isset($_GET["page"])){

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
					     $_GET["page"]
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
		render("page_template.php", ["title" => "Page", "notes" => $notes, "showmodal" => false]);
	
	} else {
		header("Location: index.php");
		die();
	}


} else if ($_SERVER["REQUEST_METHOD"] == "POST"){

	if (!empty($_POST["typename"])){

		

	}
}

?>