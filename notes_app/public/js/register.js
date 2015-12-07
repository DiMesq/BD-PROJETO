$(function(){
  

  $('#register_input').on('submit', function(e){
      // prevent native form submission here
      e.preventDefault();
      // submit the form
      $.ajax({
          type: $(this).attr('method'), // <-- get method of form
          url: $(this).attr('action'), // <-- get action of form
          data: $(this).serialize(), // <-- serialize all fields into a string that is ready to be posted to your PHP file
          cache: false,
          success: function(resp){
              if (JSON.parse(resp).result == "1") {
                	//successful validation
                  window.location.replace("user.php");            	
              // not successeful
            	} else {
          	  	$.each(JSON.parse(resp), function(i, message) {
                  $('#register_input input[name=password]').val('');
                  $('#register_input input[name=confirm]').val('');
                  
        			    $('#alert_placeholder').html(my_alert(message));
        			    
                  return false;	
                  
                });
          	}
            	
            	return false;
        	},
        	error: function() {
        		console.log('there was a problem checking the fields');
        	}
      });
  });
});


