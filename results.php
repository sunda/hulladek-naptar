<?php
include "config.php";
include "moduls/Table.1.5.php";
?><html>
<head>
	<meta charset="UTF-8">
	<title>Keresési eredmények</title>
	<meta name="description" content="Hulladékszállítási naptár">
	<meta name="keywords" content="hulladékszállítási naptár, kommunális hulladék, szelektív hulladék">
	<meta charset="UTF-8">
	<link rel='stylesheet' href="css/index.css" />
	<link rel="stylesheet" href="css/small.css" media="(max-width:480px)" />
	<link rel="stylesheet" href="css/medium.css" media="(min-width:481px) and (max-width:900px)" />
	<link rel="stylesheet" href="css/large.css" media="(min-width:901px)" />
	<link rel='stylesheet' href="font/stylesheet.css" />
</head>
<body>
	<header>
		<h1>Hulladékszállítási naptár</h1>
		<h2><span class="small-hide">Település:</span>
		<?php
		$t=new Table("s_Settlements");
		$match=$t->get("*","PostalCode='".mysql_real_escape_string($_GET["keres"])."'");
		if(isset($match[0])) print $match[0]["PostalCode"]." ".$match[0]["Name"].", ".$match[0]["County"]." megye<br>".$match[0]["Note"];
		else print "Nincs ilyen település az adatbázisban!";
		?>
		</h2>
		<ul>
			<li><a href="index.php">Új keresés</a></li>
			<li><a href="contact.php">Írj nekünk!</a></li>
		</ul>
	</header>
	<section>
		<h1>Következő szállítás:</h1>
		<h2>
		<?
		$t2=new Table("s_WasteType");
		$types=$t2->get("*");
		$t=new Table("f_Calendar");
		$results=$t->get("*","PostalCode=".mysql_real_escape_string($_GET["keres"]));
		if(isset($results[0])){
			print $results[0]["Date"]."<br>";
			foreach($types as $i){
				if($results[0]["WasteTypeID"]==$i["WasteTypeID"]) print $i["Name"];
			}
		}else{
			print "Nincs rögzített adat";
			$next=0;
		}
		?>
		</h2>
		<p class="adsense"><?php include('moduls/adsense.html'); ?></p>
		<p class="tip">Tipp: Ne maradjon a nyakadon a szemét máskor sem! Kövesd ezt a naptárat a mobilodon is, a következő URL címen: <strong>http://naptar.ewaste.hu/6077</strong></p>
		
		<? if(!isset($next)): ?>
		<h2>További szállítási dátumok</h2>
		<table cellspacing="0">
			<?php
			foreach($results as $i):
			?>
			<tr>
				<td style="
					<?php
					foreach($types as $type){
						if($type["WasteTypeID"]==$i["WasteTypeID"]){
							$style=$type["Style"];
							print $style.'">';
							print $type["Name"];
						}
					}
					?>
				</td>
				<td class="right" style="<?= $style.'">'.$i["Date"]?></td>
			 </tr>
			<? endforeach; ?>
		</table>
		<? endif;?>
	</section>
</body>
</html>
