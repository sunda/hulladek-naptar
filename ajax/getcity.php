<?php
include "../config.php";
include "../moduls/Table.1.5.php";
/*
$t=new Table("s_Settlements");
$city=$t->get("*","`PostalCode`='".$_GET["postalcode"]."'");

print $city[0]["Name"];
*/

print "<img alt='place' src='css/place-error.png'/>Nincs ilyen település";
#print "<img alt='place' src='css/place.png'/>".$_GET["postalcode"].", Orgovány";
?>
