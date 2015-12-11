$(function() {
	var triggerId;

	// get the button that triggered the modal
	$('.modal').on('show.bs.modal', function (e) {
    	triggerId = $(e.relatedTarget).attr('id');
	});

	$("#deleteField").on("submit", function(e) {
		var input = $("<input>")
               		   .attr("type", "hidden")
               		   .attr("name", "fieldIdDelete").val(triggerId)
					   .appendTo("#deleteField");
	});

	$("#addNoteModal").on("submit", function(e) {
		var input = $("<input>")
               		   .attr("type", "hidden")
               		   .attr("name", "pageid").val(pageid)
					   .appendTo("#addNote");
	});

});