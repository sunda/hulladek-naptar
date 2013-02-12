<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="css/index.css" />
	</head>
<body>

<header>
	<h1>Hulladékszállítási naptárak</h1>
	<h2>Magyarországi hulladékszállítási naptárai.</h2>
	<p>Az oldal használata:</p>
	<ol>
	<li>Írd be az irányítószámod.</li>
	<li>Kattints a Keresésre</li>
	<li>Mentsd el a könyvjelzőid közé az oldalt.</li>
</ol>
<p>Tipp: Állítsd be a mobilodon a településed könyvjelzőként, hogy bármikor meg tudd nézni mikor viszik el tőletek a szemetet.</p>
</header>

<section>
	<form method="get" target="_top">
		<label for="postal"> Irányítószám:</label>
		<input type="text" id="postal" value="" name="Irányítószám" placeholder="pl.:6077" />
		<input type="submit" value="Keresés" />
	</form>

	<aside>
		<p><?php include('moduls/adsense.html') ?></p>
	</aside>
</section>

<footer>
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

$query = "SELECT Name, Description FROM s_WasteType";

$result = mysql_query($query);

if (!$result) {
    $mailMessage= date(DATE_RFC822)."\r\n".mysql_error()."\r\nquery: ".$query;
    mail($mailto, $mail_error_subject, $mailMessage);
    die($error_message);
			}//if (!$result)


while ($row = mysql_fetch_assoc($result)) {
    echo '<p><b>'.$row['Name'].'</b></p>';
    echo '<p>'.$row['Description'].'</p><br>';
			}//while

mysql_free_result($result);

mysql_close($link);	
?>

</footer>

</body>
</html>
