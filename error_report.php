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
										if (($_POST['name']='') or ($_POST['email']=='') or ($_POST['message']=='')){
																																	echo "A kövekező mezők kitöltése kötelező:
																																						<ul>
																																						<li>Név</li>
																																						<li>e-mail</li>
																																						<li>Hiba leírása</li>																																						
																																						</ul>";
																																	}else
																																	{
																																		send_mail();																																		
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
A *-gal jelölt mezők kitökltése kötelező.
</form>

<p>
<b>Miért adjam meg a weboldalam?</b><br>
Nem kötelező megadnod, de amennyiben az általad beküldött hibajelentést hasznosnak találjuk, a jelzésért cserébe megjelentetjük a weboldalad kattintható linkként.  
</p>

</body>
</html>