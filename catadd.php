<?php

header('Content-type: text/html;charset=UTF-8');
require('./lib/init.php');

if (empty($_POST)) {
	require(ROOT . '/view/admin/catadd.html');
} else {
	//检测栏目是否为空
	$cat['catname'] = trim($_POST['catname']);
	// echo $cat['catname'];
	
	if(empty($cat['catname'])){
		// echo '栏目不能为空';
		// error('栏目不能为空1');
		echo "<script>alert('栏目不能为空')</script>";
		exit();
	}
	//检测栏目名是否已存在
	$sql = "select * from cat where catname='$cat[catname]'";
	$rs = mQuery($sql);
	// var_dump($rs);
	$rs = mysql_fetch_row($rs);
	if($rs[0] != 0){
		echo '栏目已存在';
		exit();
	}
	
	//将栏目写入栏目表
	//$sql = "insert into cat (catname) values ('$cat[catname]')";
	if(!mExec('cat',$cat)){
		echo '插入栏目失败';
		echo mysql_error();
	} else{
		// echo '插入栏目成功';
		succ('插入栏目成功');
	}
}




?>	