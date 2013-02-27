function getlastid(){
		return Number($("#listform input").last().attr("name").split("-")[1])+1;
}

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
	$formitem=getlastid();
	$date="2013/02/25";
	$("#list").append("<li rel='"+$formitem+"'>"+$type+"<img src='css/remove.png'  onclick='remove("+$formitem+")' /><span>"+$date+"</span></li>");
	$("#listform").append("<input type='hidden' name='item-"+$formitem+"' value='"+$tid+","+$date+"' />");
	$prev=$.cookie("ewcal-items")!=undefined?$.cookie("ewcal-items"):"";
	$.cookie("ewcal-items",$prev+":"+$formitem+","+$tid+","+$type+","+$date);
}
function add_regular(type){}

function remove($id){
	$cout="";
	$cookies=$.cookie("ewcal-items").split(":");
	for($i=0;$i<$cookies.length;$i++){
		if($cookies[$i]!=""){
			$data=$cookies[$i].split(",");
			if($data[0]!=$id){
				$cout+=":"+$cookies[$i];
			}
		}
	}
	$.cookie("ewcal-items",$cout);
	$("#list li[rel="+$id+"]").remove();
	$("#listform input[name=item-"+$id+"]").remove();
}
