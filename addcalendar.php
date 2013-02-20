<?php
include "config.php";
include "moduls/Table.1.5.php";
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
		<article id="step1" class="active">
			<h1>Hogyan adhatok naptárat az oldalhoz?</h1>
			<p>Csak pár egyszerű lépésre van szükség.
		<br>A naptár ellenőrzése után, amennyiben mindent rendben találtunk elhelyezzük a neved és a weboldalad linkjét(persze ha van ilyen), az általad beküldött naptár oldalán. 
		Az e-mail címed csak a kommunikáció miatt szükséges megadnod, azt sem az oldalon nem tesszük láthatóvá, sem harmadik félnek nem adjuk ki.
		</p><br>
		
		<input type="text" name="name" placeholder="Neved"/><br>
		<input type="email" name="email" placeholder="E-mail címed" /><br>
		<input type="text" name="site" placeholder="Weboldalad" /><br>
		
		<button onclick="tab(2)" class="next">Tovább</button>
		</article>
		
		<article id="step2">
			<h1>Válaszd ki a megyét és a helységet amihez naptárat szeretnél hozzáadni</h1>
			<select id="county" name="county" onchange="setcity()">
				<option value="0" selected="selected">Válassz megyét</option>
				<?php
				$t=new Table("s_County");
				$places=$t->get("*");
				foreach($places as $p){
						?>
				<option value="<?=$p['id'];?>"><?=$p['Name'];?></option>
						<?
				}
				?>
			</select><br>
			<select name="city" id="city" disabled="true"></select><br>
			<button onclick="tab(2)" class="prev">Vissza</button>
			<button onclick="tab(2)" class="next">Tovább</button>
		</article>	
		
		<font size="4" color="#FF0000">Ha hibát akarsz bejelenteni, <a href="error_report.php">ide kattintva tedd meg.</a></font>
	</section>
</body>
</html>
