<html>
<head>
<meta charset="UTF-8">
</head>
<body>

<?php 
include('moduls/error_vars.php');

function makeinput($type, $name)//form maker function
			{
				$value = '<input type="'.$type.'" name="'.$name.'" ';
				if (isset($_POST[$name])){
																											$value=$value.'value="'.$_POST[$name].'"';																											
																											}
			 $value= $value.'/>';
				echo $value;
				}
								

if (isset($_POST['name'])){ 
										if (($_POST['name']=='') || ($_POST['email']=='') || ($_POST['message']=='')){
																																	echo "A következő mezők kitöltése kötelező:
																																						<ul>
																																						<li>Név</li>
																																						<li>e-mail</li>
																																						<li>Hiba leírása</li>																																						
																																						</ul>";
																																	}else
																																	{																																																												
																																		$message = 'Reporter website: '.$_POST['url']."\r\n\r\n".'Error report:'. $_POST['message'];
																																																																													
																																		
																																		$headers = 'From:'.$_POST['email']. "\r\n";

																																		$success=mail($mailto, $mail_error_subject, $message, $headers);
																																		if ($success) {
																																			echo "<p>A hibajelentést sikeresen elküldted</p>";
																																			} else {
																																			echo $error_report_does_not_work;
																																			};								
																																												
																																		}
																								}


					

?>
<p><h1>Hiba bejelentése</h1>

<font size="4" color="#FF0000">Figyelem! Itt csak a hibákat jelentsd. Ha naptárat akarsz beküldeni, azt <a href="addcalendar.php">ide kattintva tedd meg.</a></font>
</p><br>
<form method="post" action="error_report.php">
*Neved: <?php makeinput('text','name')?><br>
*e-mail: <?php makeinput('email','email')?><br>
Weboldalad: <?php makeinput('text','url')?><br>
*Hiba leírása:<br> <textarea name='message'>
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

<p>
<b>Mi történik ha megadom a weboldalam címét?</b><br>
<ol>
	<li>Értékeljük hogy valóban hasznos információt szolgáltattál-e az oldal számára!</li>
	<li>A megadott e-mail címeden keresztül értesítünk az eredményről, és az hibajavításról.</li>
	<li>Ha minden rendben ment, a <a href="partners.php">partner oldalunkon</a> megjelentetjük a neved és a megadott weboldal címét kattintható linkként.</li>
</ol>
</p>

</body>
</html>