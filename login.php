<?php
require('./lib/init.php');


if (empty($_POST)) {
	require(ROOT . '/view/front/login.html');
} else {
	$user['name'] = trim($_POST['name']);
	if (empty($user['name'])) {
		error('用户名不能为空');
	}
	
	$user['password'] = trim($_POST['password']);
	if (empty($user['password'])) {
		error('密码不能为空');
	}
	
	exit;
	$a = md5($user['password'].'L&#7sd":Adsfqef]');
	echo $a;
	
	// $sql = "select * from user where name='$user[name]' and password='$user[password]'";
	
	$sql = "select * from user where name='$user[name]'";
	$row = mGetRow($sql);
	if (!$row) {
		error('用户名错误');
	} else {
		
		// if (md5($user['password'].row['salt']) == row['password']){
		// 	setcookie('name',$user['name']);
		// 	setcookie('ccode',cCode($user['name']));
		// 	header('Location: artlist.php');
		// } else {
		// 	error('密码错误');
		// }
	}
	
	
	// if (!mGetRow($sql)) {
	// 	error('用户名或密码');
	// } else {
	// 	setcookie('name',$user['name']);
	// 	header('Location: artlist.php');
	// }
	
}





?>	
