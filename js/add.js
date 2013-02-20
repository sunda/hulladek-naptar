function tab(num){
	$(".active").removeClass("active");
	$("#step"+num).addClass("active");
}

function setcity(){
	$.get("ajax/getcity.php",{"countyID":$("#county").val()},function(data){
		$("#city").html(data);
		$("#city").attr("disabled",false);
	});
}
