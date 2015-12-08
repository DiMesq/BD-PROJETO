$(function() {
	var triggerId;
	// get the button that triggered the modal
	$('.modal').on('show.bs.modal', function (e) {
    	triggerId = $(e.relatedTarget).attr('id');
	});

	$("#deletePage").on("submit", function(e) {
		var input = $("<input>")
               		   .attr("type", "hidden")
               		   .attr("name", "pageIdDelete").val(triggerId)
					   .appendTo("#deletePage");
	});

	$("#deleteType").on("submit", function(e) {
		var input = $("<input>")
               		   .attr("type", "hidden")
               		   .attr("name", "typeIdDelete").val(triggerId)
					   .appendTo("#deleteType");
	});
});