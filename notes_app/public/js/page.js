$(function() {
	var triggerId;

	if (showmodal == true){
		$("#enterFieldsModal").modal('show');
	}

	// get the button that triggered the modal
	$('.modal').on('show.bs.modal', function (e) {
    	triggerId = $(e.relatedTarget).attr('id');
	});

	$("#deleteNote").on("submit", function(e) {
		var input = $("<input>")
               		   .attr("type", "hidden")
               		   .attr("name", "noteIdDelete").val(triggerId)
					   .appendTo("#deleteNote");
	});

	$("#addNote").on("submit", function(e) {
		var input = $("<input>")
               		   .attr("type", "hidden")
               		   .attr("name", "pageid").val(pageid)
					   .appendTo("#addNote");
	});

});