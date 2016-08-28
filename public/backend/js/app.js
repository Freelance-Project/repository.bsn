
$(document).ready(function(){

	$( "#datepicker" ).datepicker({
		changeYear: true,
		changeMonth: true,
		dateFormat: "dd-mm-yy"
	});
})


function openChild(id)
{
	$("[id^='child']").hide();
	$("#child" + id).show();
}
