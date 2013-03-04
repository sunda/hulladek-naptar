<html>
<head>
	<title>Kapcsolat::Hulladékszállítási naptárak</title>
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

function makeinput($type, $name, $text)//form maker function
			{
				$value = '<input type="'.$type.'" name="'.$name.'" placeholder="'.$text.'"';
				if (isset($_POST[$name])){
																											$value=$value.'value="'.$_POST[$name].'"';																											
																											}
			 $value= $value.'/>';
				echo $value;
				}
								

if (isset($_POST['name'])){ 
										if (($_POST['name']=='') || ($_POST['email']=='') || ($_POST['message']=='')){
																																	echo "<section><h2>A következő mezők kitöltése kötelező:</h2>
																																						<ul>
																																						<li>Név</li>
																																						<li>e-mail</li>
																																						<li>Hiba leírása</li>																																						
																																						</ul></section>";
																																	}else
																																	{																																																												
																																		$message = 'Reporter website: '.$_POST['url']."\r\n\r\n".'Error report:'. $_POST['message'];
																																																																													
																																		
																																		$headers = 'From:'.$_POST['email']. "\r\n";

																																		$success=mail($mailto, $mail_error_subject, $message, $headers);
																																		if ($success) {
																																			echo "<section><h2>A hibajelentést sikeresen elküldted! Köszönjük!</h2></section>";
																																			} else {
																																			echo '<section><h2>'.$error_report_does_not_work.'</h2></section>';
																																			};								
																																												
																																		}
																								}


					

?>

<header>
<h1>Hulladékszállítási naptárak</h1>
<h2>Hiba bejelentése</h2>

<ul>
		<li><a href="index.php">Vissza a kereséshez</a></li>
		<li><a href="partners.php">Partnereink</a></li>		
	</ul>
</header>
<section>
<br>
<font size="4" color="#FF0000">Figyelem! Itt csak a hibákat jelentsd. Ha naptárat akarsz beküldeni, azt <a href="addcalendar.php">ide kattintva tedd meg.</a></font>

<form method="post" action="error_report.php">
<?php makeinput('text','name','Neved')?><br>
<?php makeinput('email','email','e-mail')?><br>
<?php makeinput('text','url','Honlap')?><br><br>
*Hiba leírása:<br> <textarea name='message' rows="4" cols="30">
<?php
	if (isset($_POST['message'])){
																											echo $_POST['message'];																											
																											}
?>
</textarea><br>

<br>
<button type="submit">Hiba jelentése</button><br>
A *-gal jelölt mezők kitöltése kötelező.
</form>
</section>
<section>
<b>Mi történik ha megadom a weboldalam címét?</b><br>
<ol>
	<li>Értékeljük hogy valóban hasznos információt szolgáltattál-e az oldal számára!</li>
	<li>A megadott e-mail címeden keresztül értesítünk az eredményről, és az hibajavításról.</li>
	<li>Ha minden rendben ment, a <a href="partners.php">partner oldalunkon</a> megjelentetjük a neved és a megadott weboldal címét kattintható linkként.</li>
</ol>
</section>

<footer>ewaste.hu&copy; 2013</footer>

</body>
</html>
