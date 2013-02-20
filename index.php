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

<header>
	<h1>Hulladékszállítási naptárak</h1>
	<h2>Kukaürítési napok jegyzéke, az ország egész területén!</h2>
	<ul>
		<li><a href="addcalendar.php">Naptár hozzáadása</a></li>
		<li><a href="error_report.php">Hibabejelentés</a></li>
	</ul>
</header>

<section>
	<h1>Az oldal használata:</h1>
	<ol>
		<li><h1>1.</h1>Írd be az irányítószámod.<br><img alt="edit" src="css/edit.png" /></li>
		<li><h1>2.</h1>Kattints a Keresésre.<br><img alt="search" src="css/search.png" /></li>
		<li><h1>3.</h1>Mentsd el a könyvjelzőid közé.<br><img alt="bookmark" src="css/bookmark.png" /></li>
	</ol>
	<p class="tip">Tipp: Állítsd be a mobilodon a településed könyvjelzőként, hogy bármikor meg tudd nézni mikor viszik el tőletek a szemetet.</p>
</section>

<section>
	<form method="get" target="_top" action="results.php">
		<input type="text" id="postal" value="" name="keres" placeholder="Irányítószám" />
		<input type="submit" value="Keresés" />
	</form>

	<aside>
		<p><?php include('moduls/adsense.html') ?></p>
	</aside>
</section>

<footer>ewaste.hu&copy; 2012
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
