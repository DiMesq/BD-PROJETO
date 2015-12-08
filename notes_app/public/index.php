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
		query("UPDATE pagina SET ativa = false WHERE pagecounter = ?", $_POST["pageIdDelete"]);

	} else if (!empty($_POST["typeIdDelete"])){
		query("UPDATE tipo_registo SET ativo = false WHERE typecnt = ?", $_POST["typeIdDelete"]);
	}


	header("Location: index.php");
	die();
}
?>