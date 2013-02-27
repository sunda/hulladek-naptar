<?php
include "config.php";
include "moduls/Table.1.5.php";
?>
<html>
<head>
	<meta charset="utf8" />
	<link rel='stylesheet' href="css/index.css" />
	<link rel='stylesheet' href="font/stylesheet.css" />
</head>
<body>
	<header>
		<h1>Adatok mentése</h1>
		<ul>
			<li><a href="index.php">Keresés</a></li>
			<li><a href="error_report.php">Hibabejelentés</a></li>
		</ul>
	</header>
	<article>
<?php
if(isset($_POST["ewcal"])){
	$cookie=explode(",",$_COOKIE["ewcal-data"]);
	
	$t=new Table("f_Calendar");
	$sql="INSERT INTO `&table`(
						`PostalCode`,
						`Date`,
						`WasteTypeID`) VALUES";
	
	foreach($_POST as $item){
		if($item!="save-enable"){
			$data=explode(",",$item);
			$sql.=" ($cookie[3],'$data[1]',$data[0]),";
		}
	}
	$sql=substr($sql,0,-1);
	if($t->fetch($sql)){
		?>
		<h1>Adatok mentése sikeres</h1>
		<p>	Minden adat sikeresen elmentve!<br>
			Köszönjük a közreműködést
			<a href="addcalendar.php">Új naptár hozzáadása</a>
		</p>
		<?
		setcookie("ewcal-items","",-1);
	}
}else{
	print "Hozzáférés megtagadva!";
}
?>
	</article>
</body>
</html>
