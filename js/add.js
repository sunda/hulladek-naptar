$(document).ready(function(){
	$formitem=Number($("#listform input").last().attr("name").split("-")[1]);
});

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

function add_single($tid,$type){
	$date="2013/02/25";
	$("#list").append("<li rel='"+$formitem+"'>"+$type+"<img src='css/remove.png' /><span>"+$date+"</span></li>");
	$("#listform").append("<input type='hidden' name='item-"+$formitem+"' value='"+$tid+","+$date+"' />");
	$prev=$.cookie("ewcal-items")!=undefined?$.cookie("ewcal-items"):"";
	$.cookie("ewcal-items",$prev+":"+$formitem+","+$tid+","+$type+","+$date);
	$formitem++;
}
function add_regular(type){}
