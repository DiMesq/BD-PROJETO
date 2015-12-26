/* auxiliary functions */

// alert message using bootstrap - used for validation in sign up and login
function my_alert(message){
	return '<div class="alert alert-danger alert-dismissible" role="alert">' +
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close"' +
					'<span aria-hidden="true">&times;</span>' +
					'</button>' +
                '<strong>Error!</strong> '+message+
            '</div>';
}


