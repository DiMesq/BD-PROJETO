$(function (){

	$('#login_input').on('submit', function(e){

		// error message if no email
		if ($('#email').val() == ""){
			e.preventDefault();
			v = "Please enter your email.";
			$('#alert_placeholder').html(my_alert(v));
		}
	});
});


