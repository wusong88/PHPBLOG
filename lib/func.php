<?php
header('Content-type: text/html;charset=UTF-8');

//成功提示信息
function succ($res){
	$result = 'succ';
	require(ROOT . '/view/admin/info.html');
}
// 失败返回的报错信息
function error($res){
	$result = 'fail';
	require(ROOT . '/view/admin/info.html');
	exit();
}

?>	
