
$(document).ready(function(){

	$( "#datepicker" ).datepicker({
		changeYear: true,
		changeMonth: true,
		dateFormat: "yy-mm-dd"
	});

	$( "#datepicker1" ).datepicker({
		changeYear: true,
		changeMonth: true,
		dateFormat: "yy-mm-dd"
	});

	$( "#datepicker2" ).datepicker({
		changeYear: true,
		changeMonth: true,
		dateFormat: "yy-mm-dd"
	});
})


function openChild(id)
{
	$("[id^='child']").hide();
	$("#child" + id).show();
}
