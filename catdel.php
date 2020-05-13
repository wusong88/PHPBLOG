<?php
header('Content-type: text/html;charset=UTF-8');
include('./config.php');

$cat_id = $_GET['cat_id'];

//检测 栏目是否合法
if(!is_numeric($cat_id)){
	echo '栏目不合法';
	exit();
}

//检测 栏目是否存在
$sql = "select count(*) from cat where cat_id=$cat_id";
$rs = mysql_query($sql);
if(mysql_fetch_row($rs)[0] == 0){
	echo '栏目不存在';
	exit();
}

//检测 栏目下面是否存在文章
$sql = "select count(*) from art where cat_id=$cat_id";
$rs = mysql_query($sql);
if(mysql_fetch_row($rs)[0] != 0){
	echo '栏目存在文章，不能删除';
	exit();
}

// 
$sql = "delete from cat where cat_id=$cat_id";

if(!mysql_query($sql)){
	echo '栏目删除失败';
} else {
	echo '栏目删除成功';
}



?>	
