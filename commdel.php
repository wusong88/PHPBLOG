<?php
require('./lib/init.php');

$comment_id = $_GET['comment_id'];

print_r($comment_id);


//判断地址栏传来的comment_id是否合法
if(!is_numeric($comment_id)){
	error('评论id不合法');
}


//获取当前评论的art_id
$sql = "select art_id from comment where comment_id=$comment_id";
$art_id = mGetOne($sql);


//删除评论
$sql = "delete from comment where comment_id=$comment_id";
$rs = mQuery($sql);
//如果获取art_id 成功 更改art表的评论数
if ($art_id) {
	$sql = "update art set comm=comm-1 where art_id=$art_id";
	$rs = mQuery($sql);
}

//跳转上一页 commlist
$ref = $_SERVER['HTTP_REFERER'];
header("Location: $ref");

?>	
