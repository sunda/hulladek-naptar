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
	<link rel='stylesheet' href="font/stylesheet.css" />
</head>
<body>
	<header>
		<h1>Keresési eredmények</h1>
		<ul>
			<li><a href="index.php">Új keresés</a></li>
			<li><a href="addcalendar.php">Naptár hozzáadása</a></li>
			<li><a href="error_report.php">Hibabejelentés</a></li>
		</ul>
	</header>
	<section>
		<ul>
			<?php
			$t=new Table("f_Calendar");
			$results=$t->get("*","PostalCode=".$_GET["keres"]);
			foreach($results as $i):
			?>
			<li><i><?= $i["WasteTypeID"];?></i>&nbsp;&nbsp;<?= $i["Date"]?></li>
			<? endforeach; ?>
		</ul>
	</section>
</body>
</html>
