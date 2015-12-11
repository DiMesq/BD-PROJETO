<?php

require_once("../utils/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET"){
	
		header("Location: index.php");
		die();


} else if ($_SERVER["REQUEST_METHOD"] == "POST"){

	if (!empty($_POST["typeid"])){

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

		try {
			// begin transaction
			$db->begintransaction(); // <------------------ aqui inicia-se a transacao

			$sql = "SELECT 	MAX(regcounter) as max
		   		      FROM 	registo
		   		     WHERE 	userid = ?
		   		  			AND typecounter = ?";

		   	$params = [$_SESSION["id"], $_POST["typeid"]];

			// prepare the sql statement
		    $statement = $db->prepare($sql);
		    if ($statement === false) {
		    	$db->rollback();
		        // trigger error
		        trigger_error($handle->errorInfo()[2], E_USER_ERROR);
		        exit;
		    }
		    
		    // execute the query 
		    $statement->execute($params);
			$max = $statement->fetchAll(PDO::FETCH_ASSOC);

			// new page counter set to max + 1 or 1 if no pages before
			if ($max == NULL) {
				$regid = 1;
			
			} else {
				$regid = $max[0]["max"] + 1;
			}

			// idseq para inserir registo
			$idseq = next_idseq();

			$sql = "INSERT INTO registo (userid, typecounter, regcounter, nome, idseq, ativo)
				         					VALUES (?, ?, ?, ?, $idseq, true)";

			$params = [$_SESSION["id"], $_POST["typeid"], $regid, $_POST["regname"]];

			// prepare the sql update statement
		    $statement = $db->prepare($sql);
		    if ($statement === false) {
		        // trigger error
		        $db->rollback();
		        trigger_error($handle->errorInfo()[2], E_USER_ERROR);
		        exit;
		    }
			
		    // execute the update
		    $statement->execute($params);

			//idseq para inserir registo na página
			$idseq = next_idseq();
			
			$sql = "INSERT INTO reg_pag (userid, typeid, pageid, regid, idseq, ativa) 
							VALUES (?, ?, ?, $regid, $idseq, true)";

			$params = [$_SESSION['id'], $_POST['typeid'], $_POST['pageid']];

			// prepare the sql update statement
		    $statement = $db->prepare($sql);
		    if ($statement === false) {
		        // trigger error
		        $db->rollback();
		        trigger_error($handle->errorInfo()[2], E_USER_ERROR);
		        exit;
		    }
			
		    // execute the update
		    $statement->execute($params);

			$fields = $_SESSION["fields"];

			// insert all values
			foreach ($fields as $key => $field) {

				//idseq para inserir valor
				$idseq = next_idseq();

				$sql = "INSERT INTO valor (userid, typeid, campoid, regid, valor, idseq, ativo) 
								VALUES (?, ?, ?, $regid, ?, $idseq, true)";

				$params = [$_SESSION['id'], $_POST['typeid'], $field['campocnt'], $_POST[$key]];

				// prepare the sql update statement
			    $statement = $db->prepare($sql);
			    if ($statement === false) {
			        // trigger error
			        $db->rollback();
			        trigger_error($handle->errorInfo()[2], E_USER_ERROR);
			        exit;
			    }
				
			    // execute the update
			    $statement->execute($params);

			}

			$db->commit(); // <---------------- aqui termina-se a transação

		} catch (Exception $e){
			$db->rollBack();
			apologize("Some error occurred. Please try again.");
			exit;
		}

		header("Location: page.php");
		exit;



	}

}

?>