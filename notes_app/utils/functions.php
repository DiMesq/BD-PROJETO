<?php

/**
 * Renders a template.
 *
 * Input: - template file name;
 *        - array of variables to be available in the template.
 *
 * No return value.
 */
function render ($template, $values=[]){

	if (file_exists("../tempate/$template")){

		// extract values to local scope
		extract($values);

		require_once("../template/header.php");

		require_once("../tempate/$template");

		require_once("../template/footer.php");

	} else {
		trigger_error("Invalid template: $template", E_USER_ERROR);
	}
}

?>

