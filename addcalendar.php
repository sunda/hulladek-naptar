<?php
include "config.php";
include "moduls/Table.1.5.php";

if(@$_POST["name"]!=""){ 
	setcookie("ewcal-data",$_POST["name"].",".$_POST["email"].",".$_POST["site"]);
	$set=1;
}
if(@$_POST["postalcode"]!=""){
	setcookie("ewcal-data",$_COOKIE["ewcal-data"].",".$_POST["postalcode"]);
	$set=1;
}
if(@$set==1) header("Location: addcalendar.php");
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Hulladékszállítási naptárak bővítése</title>
	<meta name="description" content="Bővítsd te is a hulladék naptárat!">
	<meta name="keywords" content="hulladékszállítási naptár, kommunális hulladék, szelektív hulladék">
	<meta charset="UTF-8">
	<link rel='stylesheet' href="css/index.css" />
	<link rel='stylesheet' href="css/add.css" />
	<link rel="stylesheet" href="css/small.css" media="(max-width:480px)" />
	<link rel="stylesheet" href="css/medium.css" media="(min-width:481px) and (max-width:900px)" />
	<link rel="stylesheet" href="css/large.css" media="(min-width:901px)" />
	<link rel='stylesheet' href="font/stylesheet.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/add.js"></script>
</head>
<body>
	<header>
		<h1>Hulladékszállítási naptár hozzáadása.</h1>
		<ul>
			<li><a href="index.php">Keresés</a></li>
			<li><a href="error_report.php">Hibabejelentés</a></li>
		</ul>
	</header>
	<section>
		<article>
		<?php 
		if(isset($_COOKIE["ewcal-data"])) $cookie=explode(",",$_COOKIE["ewcal-data"]);
		//$cookie=name,email,site,postalcode
		if(@$cookie[0]==''){?>
		
			<h1>Hogyan adhatok naptárat az oldalhoz?</h1>
			<p>Csak pár egyszerű lépésre van szükség.
			<br>A naptár ellenőrzése után, amennyiben mindent rendben találtunk elhelyezzük a neved és a weboldalad linkjét(persze ha van ilyen), az általad beküldött naptár oldalán. 
			Az e-mail címed csak a kommunikáció miatt szükséges megadnod, azt sem az oldalon nem tesszük láthatóvá, sem harmadik félnek nem adjuk ki.
			</p><br>
			<form action="" method="post">
				<input type="text" name="name" placeholder="Neved"/><br>
				<input type="email" name="email" placeholder="E-mail címed" /><br>
				<input type="text" name="site" placeholder="Weboldalad" /><br>
				<button class="next">Tovább</button>
			</form>
		<?php
		}else if(@$cookie[3]==""){?>
			<h1>Írd be a település irányítószámát, amihez naptárat szeretnél hozzáadni</h1>
			<form action="" method="post">
				<input type="text" name="postalcode" placeholder="Irányítószám" onchange="setcity()" onkeyup="setcity()" value="" /><br>
				<p class="cityname postalcode"></p><br>
				<button class="next">Tovább</button>
			</form>
		<?php
		}else{?>
			<h1>Naptár hozzáadása ehhez a településhez:
			<?php
			$t=new Table("s_Settlements");
			$city=$t->get("*","PostalCode='".$cookie[3]."'");
			print $city[0]["Name"].", ".$city[0]["County"]." megye";
			
			$t=new Table("s_WasteType");
			$wastetypes=$t->get("*");
			?></h1>
			<nav>
				<ul>
					<li><img alt="add-single" src="css/add.png" />Egyszeri esemény hozzáadása</li>
					<?php foreach($wastetypes as $wt):?>
					<li class="item" onclick="add_single(<?php print $wt["WasteTypeID"].",'".$wt["Name"]."'";?>)"><?php print $wt["Name"];?></li>
					<?php endforeach;?>
				</ul>
				<ul>
					<li><img alt="add-regular" src="css/add.png" />Rendszeres esemény hozzáadása</li>
					<?php foreach($wastetypes as $wt):?>
					<li class="item" onclick="add_regular(<?php print $wt["WasteTypeID"].",'".$wt["Name"]."'";?>)"><?php print $wt["Name"];?></li>
					<?php endforeach;?>
				</ul>
			</nav>
			<ul id="list">
				<?php
				if(isset($_COOKIE["ewcal-items"])){
						$items=explode(":",$_COOKIE["ewcal-items"]);
						foreach($items as $i){
							if($i!=""){
								$data=explode(",",$i);
				?>
				<li rel="<?= $data[0];?>"><?= $data[2];?><img src='css/remove.png' /><span><?= $data[3];?></span></li>
				<?php
							}
						}
				}
				?>
			</ul>
			
			<form method="post" id="listform">
				<?php
				if(isset($_COOKIE["ewcal-items"])){
						$items=explode(":",$_COOKIE["ewcal-items"]);
						foreach($items as $i){
							if($i!=""){
								$data=explode(",",$i);
				?>
				<input type="hidden" name="item-<?= $data[0];?>" value="<?= $data[1].",".$data[3];?>" />
				<?php
							}
						}
				}
				?>
				<button class="next">Mentés</button>
			</form>
		<?php
		} ?>
		</article>
		
		<font size="4" color="#FF0000">Ha hibát akarsz bejelenteni, <a href="error_report.php">ide kattintva tedd meg.</a></font>
	</section>
</body>
</html>
