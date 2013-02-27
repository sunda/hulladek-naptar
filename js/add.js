function setcity(){
	$val=$("article input").val();
	if(($val.length!=4) || isNaN(Number($val))){
		$(".cityname").html("");
		return;
	}
	$.get("ajax/getcity.php",{"postalcode":$val},function(data){
		$(".cityname").html(data);
	});
}

function add_single(id,type){
	$("#list").append("<li>"+type+"<img src='css/remove.png' /><span>2013/02/25</span></li>");
}
function add_regular(type){}
