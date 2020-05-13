<?php
header('Content-type: text/html;charset=UTF-8');
include('./config.php');



$sql = "select * from cat";
$rs = mysql_query($sql);
$cat = array();
while($row = mysql_fetch_assoc($rs)) {
	$cat[] = $row;
}

//print_r($cat);

require('./view/admin/catlist.html');


?>	