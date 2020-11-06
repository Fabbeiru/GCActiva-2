function burguer_navbar_sup () {
	
	var state = document.getElementById("navbar_sup");

	if (state.style.display == "block") {
		state.style.display = "none";
	} else {
		state.style.display = "block";
	}

}

var typingTimer;                //timer identifier
var doneTypingInterval = 1000;  //time in ms, 5 second for example

function searchTour() {
	$("document").ready(function() {
		var searchValue = $("#search").val();
		$("#activities").load("searchActivity.php", {
			search: searchValue
		});
	});
}

function startTimer() {

	clearTimeout(typingTimer);
  	typingTimer = setTimeout(searchTour, doneTypingInterval);

}

function restartTimer() {
	clearTimeout(typingTimer);
}

function preview_image(event) 
{
	var reader = new FileReader();
	reader.onload = function()
	{
		var output = document.getElementById('output_image');
		output.src = reader.result;
	}
	reader.readAsDataURL(event.target.files[0]);
}