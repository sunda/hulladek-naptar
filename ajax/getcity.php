<?php
include "../config.php";
include "../moduls/Table.1.5.php";

$t=new Table("s_Settlements");
$city=$t->get("*","`PostalCode`='".$_GET["postalcode"]."'");


if(!isset($city[0]["Name"])) print "<img alt='place' src='css/place-error.png'/>Nincs ilyen település";
else print "<img alt='place' src='css/place.png'/>".$city[0]["County"]." megye, ".$city[0]["Name"];
?>
