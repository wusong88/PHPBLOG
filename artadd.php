<?php
require('./lib/init.php');
$sql = "select * from cat";
$cats = mGetAll($sql);

// var_dump(empty($_POST));
if(empty($_POST)){
	include(ROOT . '/view/admin/artadd.html');
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
	
	//插入发布时间
	$art['pubtime'] = time();
	
	// 收集tag
	$art['arttag'] = trim($_POST['tag']);
	
	
	//插入内容到art表
	if(!mExec('art' , $art)){
		error('文章发布失败');
	}else{
		//判断是否有tag
		$art['tag'] = trim($_POST['tag']);
		if($art['tag'] == ''){
			//将cat 的num 字段 当前栏目下的文章数 +1
			$sql = "update cat set num=num+1 where cat_id=$art[cat_id]";
			mQuery($sql);
			
			succ('文章添加成功');
		}else{
			//获取上次 insert 操作产生的主键id
			$art_id = getLastId();
			
			$tag = explode(',', $art['tag']); //索引数组
			$sql = "insert into tag (art_id,tag) values ";
			foreach($tag as $v){
				$sql .= "(" . $art_id . ",'" . $v . "') ,";
			}
			$sql = rtrim($sql , ",");
			if(mQuery($sql)){
				$sql = "update cat set num=num+1 where cat_id=$art[cat_id]";
				mQuery($sql);
				succ('文章添加成功');
			} else {
				$sql = "delete from art where art_id=$art_id";
				if(mQuery($sql)){
					$sql = "update cat set num=num-1 where cat_id=$art[cat_id]";
					mQuery($sql);
					error('文章添加失败');
				}
			}
			
			
		}
		
	}
	
	
}



?>	
