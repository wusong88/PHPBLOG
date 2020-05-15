<?php
require('./lib/init.php');

$art_id = $_GET['art_id'];

//判断地址栏传来的art_id是否合法
if(!is_numeric($art_id)){
	error('文章id不合法');
}

//是否有这篇文章
$sql = "select * from art where art_id=$art_id";
if(!mGetRow($sql)){
	error('文章不存在');
}

//查询出所有的栏目
$sql = "select * from cat";
$cats = mGetAll($sql);

if(empty($_POST)){
	$sql = "select title,content,cat_id,arttag from art where art_id=$art_id";
	$art = mGetRow($sql);
	include(ROOT . '/view/admin/artedit.html');
}else{
	//检测标题是否为空
	$art['title'] = trim($_POST['title']);
	if($art['title'] == ''){
		error('标题不能为空');
	}
	
	//检测栏目是否合法
	$art['cat_id'] = $_POST['cat_id'];
	if(!is_numeric($art['cat_id'])){
		error('栏目不合法');
	}	
	
	//检测内容是否为空
	$art['content'] = trim($_POST['content']);
	if($art['content'] == ''){
		error('内容不能为空');
	}
	
	//修改时间
	$art['lastup'] = time();
	
	// 收集tag
	$art['arttag'] = trim($_POST['tag']);
	
	//插入内容到art表
	if(mExec('art', $art ,'update',"art_id=$art_id")){
		error('文章修改失败');
	}else{
		//删除tag表所有的tag 在insert插入新的tag
		$tag = explode(',', $art['arttag']); //索引数组
		
		$sql = "delete from tag where art_id=$art_id";
		if(!mQuery($sql)){
			succ('文章修改失败');
		}
		
		
		$sql = "insert into tag (art_id,tag) values ";
		foreach($tag as $v){
			$sql .= "(" . $art_id . ",'" . $v . "') ,";
		}
		$sql = rtrim($sql , ",");
		if(mQuery($sql)){
			succ('文章修改成功');
		} else {
			$sql = "delete from art where art_id=$art_id";
			if(mQuery($sql)){
				error('文章修改失败');
			}
		}
		
		header('Location: artlist.php');
	}
	
	
	
	
}




?>	
