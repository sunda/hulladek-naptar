function tab(num){
	$(".active").removeClass("active");
	$("#step"+num).addClass("active");
}

function setcity(){
	$.get("ajax/getcity.php",{"postalcode":$("#step2 input").val()},function(data){
		$("#step2 p").html(data);
	});
}
