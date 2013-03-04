<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="css/index.css" />
		<link rel="stylesheet" href="css/small.css" media="(max-width:480px)" />
		<link rel="stylesheet" href="css/medium.css" media="(min-width:481px) and (max-width:900px)" />
		<link rel="stylesheet" href="css/large.css" media="(min-width:901px)" />
		<link rel="stylesheet" href="font/stylesheet.css" />
	</head>
	<body>
<?php
include('config.php');
include('moduls/Table.1.5.php');

function errorhandler($error,$query=""){
	global $mailto,$mail_message,$error_message,$mail_error_subject;
	
	$mail_message=date(DATE_RFC822)."\r\n".$error."\r\n".$query;
	mail($mailto, $mail_error_subject,$mail_message) or die("Hibaüzenet küldése sikertelen");
    die($error_message);
}

?>	


<header>
<h1>Hulladékszállítási naptárak</h1>
<h2>Partnereink</h2>
<ul>
		<li><a href="index.php">Vissza a kereséshez</a></li>
		<li><a href="contact.php">Írj nekünk</a></li>		
</ul>
</header>

<section>
<br>
A hulladék naptár nem jöhetett volna létre a ti segítségetek nélkül. Köszönjük a visszajelzéseket, észrevételeket. Akik a legtöbbet segítettek:
<br><br>
</section>
<section>
<?php
$t=new Table("s_Helpers","","errorhandler");
$result = $t->get("Name,Website,Note");

foreach($result as $row) {
    echo '<p>'.$row['Name'].'</p>';
    echo '<p><a href="'.$row['Website'].'">'.$row['Website'].'</a></p>';
    echo '<p>'.$row['Note'].'</p><br>';
}

?>
</section>
</body>
</html>
