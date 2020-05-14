<?php
require('./lib/init.php');

//查询所有的栏目
$sql = "select cat_id,catname from cat";
$cats = mGetAll($sql);

//判断地址栏是否有cat_id
if(isset($_GET['cat_id'])){
	$where = " and art.cat_id=$_GET[cat_id]";
}else {
	$where = '';
}


//查询所有的文章
$sql = "select art_id,title,content,pubtime,comm,catname from art inner join cat on art.cat_id=cat.cat_id where 1" . $where;
// echo $sql;exit();
$arts = mGetAll($sql);

require(ROOT . '/view/front/index.html');


?>	
