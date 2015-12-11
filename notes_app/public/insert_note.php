<?php

require_once("../utils/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET"){
	
		header("Location: index.php");
		die();


} else if ($_SERVER["REQUEST_METHOD"] == "POST"){

	if (!empty($_POST["typeid"])){

		// ver se registo já existe 

		// se já existir fazer update nos valores e meter flag ativa a true na reg_pag (ou inserir), 
		// meter flag a true no registo e no tipo?

		// se não, inserir os valores
		//achar novo valor do regcounter
		$max = query(false, "SELECT 	MAX(regcounter) as max
					   		   FROM 	registo
					   		  WHERE 	userid = ?
					   		  			AND typecounter = ?",
			   		  $_SESSION["id"],
			   		  $_POST["typeid"]
			   	);

		// new page counter set to max + 1 or 1 if no pages before
		if ($max == NULL) {
			$regid = 1;
		
		} else {
			$regid = $max[0]["max"] + 1;
		}

		// idseq para inserir registo
		$idseq = next_idseq();

		//inserir registo
		$lastInserted = update(false, "INSERT INTO registo (userid, typecounter, regcounter, nome, idseq, ativo)
			         					VALUES (?, ?, ?, ?, $idseq, true)",
			   			  		$_SESSION["id"],
			              		$_POST["typeid"],
			              		$regid,
			              		$_POST["regname"]
			              		
		);

		if ($lastInserted == -1){
			apologize("Duplicate name for note. Please pick a different name for your note.");
			exit;
		}

		//idseq para inserir registo na página
		$idseq = next_idseq();

		update(false, "INSERT INTO reg_pag (userid, typeid, pageid, regid, idseq, ativa) 
						VALUES (?, ?, ?, $regid, $idseq, true)",
				$_SESSION['id'],
				$_POST['typeid'],
				$_POST['pageid']);

		$fields = $_SESSION["fields"];

		// insert all values
		foreach ($fields as $key => $field) {

			//idseq para inserir valor
			$idseq = next_idseq();

			//inserir valor
			update(false, "INSERT INTO valor (userid, typeid, campoid, regid, valor, idseq, ativo) 
							VALUES (?, ?, ?, $regid, ?, $idseq, true)",
					$_SESSION['id'],
					$_POST['typeid'],
					$field['campocnt'],
					$_POST[$key]
			);
		}

		header("Location: page.php");
		exit;



	}

}

?>