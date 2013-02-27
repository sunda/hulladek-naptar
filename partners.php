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
include('moduls/connector.php');
include('moduls/error_vars.php');

$link = mysql_connect($hostname,$user,$password);
if (!$link) {
				$mail_message=date(DATE_RFC822)."\r\n".mysql_error();
			mail($mailto, $mail_error_subject,$mail_message);
    die($error_message);
 }
  
mysql_select_db($databasename);
?>	


<header>
<h1>Hulladékszállítási naptárak</h1>
<h2>Partnereink</h2>
<ul>
		<li><a href="index.php">Vissza a kereséshez</a></li>
		<li><a href="addcalendar.php">Nem találod a településed?</a></li>
		<li><a href="error_report.php">Hibát észleltem</a></li>		
</ul>
</header>

<section>
<br>
A hulladék naptár nem jöhetett volna létre a ti segítségetek nélkül. Köszönjük a visszajelzéseket, észrevételeket. Akik a legtöbbet segítettek:
<br><br>
</section>
<section>
<?php
$query = "SELECT Name, Website, Note FROM s_Helpers";

$result = mysql_query($query);

if (!$result) {
    $mailMessage= date(DATE_RFC822)."\r\n".mysql_error()."\r\nquery: ".$query;
    mail($mailto, $mail_error_subject, $mailMessage);
    die($error_message);
			}//if (!$result)


while ($row = mysql_fetch_assoc($result)) {
    echo '<p>'.$row['Name'].'</p>';
    echo '<p><a href="'.$row['Website'].'">'.$row['Website'].'</a></p>';
    echo '<p>'.$row['Note'].'</p><br>';
			}//while

mysql_free_result($result);


mysql_close($link);	
?>
</section>
</body>
</html>