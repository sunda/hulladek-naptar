<?php
include "../config.php";
include "../moduls/Table.1.5.php";

$t=new Table("s_Settlements");
$cities=$t->get("*","`County`='".$_GET["countyID"]."'");

$o="<option value='0'>Válassz települést</option>";
print_r($cities);
foreach($cities as $city){
	$o.="<option value='".$city["PostalCode"]."'>".$city["Name"]."</option>";
}
print $o;
?>
