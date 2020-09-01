<?php
require('./lib/init.php');

if (!acc()){
	header('Location: login.php');
}


$sql = "select art_id,title,pubtime,comm,catname from art left join cat on art.cat_id=cat.cat_id order by art_id desc";
$arts = mGetAll($sql);


include(ROOT . '/view/admin/artlist.html');

?>	
