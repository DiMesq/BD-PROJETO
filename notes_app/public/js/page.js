$(function() {
	var triggerId;
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

	$("#editField").on("submit", function(e) {
		var input = $("<input>")
               		   .attr("type", "hidden")
               		   .attr("name", "typeIdDelete").val(triggerId)
					   .appendTo("#deleteType");
	});

	$(".clickable-row").on("click", function(){
		window.document.location = $(this).data("href");
	});
});