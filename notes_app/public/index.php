<?php
	
	require_once("../utils/config.php");

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
?>