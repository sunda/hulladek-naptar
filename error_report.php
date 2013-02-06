<html>
<head>
<meta charset="UTF-8">
</head>
<body>

<?php 
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
																																		
																																		$to      = 'sunda@ewaste.hu';
																																		$subject = 'the subject';
																																		$message = $_POST['message'];
																																		$headers = 'From:'.$_POST['email']. "\r\n";

																																		$success=mail($to, $subject, $message, $headers);
																																		if ($success) {
																																			echo "OK";
																																			} else {
																																			echo "NO";
																																			};								
																																												
																																		}
																								}


					

?>
<p><h1>Hiba bejelentése</h1>

<font size="4" color="#FF0000">Figyelem! Itt csak a hibákat jelentsd. Ha naptárat akarsz beküldeni, azt <a href="Naptarbekuldes.html">ide kattintva tedd meg.</a></font>
</p><br>
<form method="post" action="error_report.php">
*Neved: <?php makeinput('text','name')?><br>
*e-mail: <?php makeinput('email','email')?><br>
Weboldalad: <?php makeinput('text','url')?><br>
*Hiba leírás <?php makeinput('text','message')?><br>

<br>
<button type="submit">Hiba jelentése</button><br>
A *-gal jelölt mezők kitöltése kötelező.
</form>

<p>
<b>Miért adjam meg a weboldalam?</b><br>
Nem kötelező megadnod, de amennyiben az általad beküldött hibajelentést hasznosnak találjuk, a jelzésért cserébe megjelentetjük a weboldalad kattintható linkként.  
</p>

</body>
</html>