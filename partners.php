<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/index.css" />	
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



<h1>Köszönet</h1>
<p>A hulladék naptár nem jöhetett volna létre a ti segítségetek nélkül. Köszönjük a visszajelzéseket, észrevételeket. Akik a legtöbbet segítettek:</p>
<br>
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

?>
<p>Helper name: <a href=#>Helper Website:</a><br>
Helper Note;</p><br>

<p>Helper name: <a href=#>Helper Website:</a><br>
Helper Note;</p>
<?php
mysql_close($link);	
?>
</body>
</html>