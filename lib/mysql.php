<?php
header('Content-type: text/html;charset=UTF-8');

// @return resource 连接成功，返回连接数据库的资源
function mConn(){
	static $conn = null;
	if($conn === null){
		$cfg = require(ROOT . '/lib/config.php');
		// echo $cfg;
		$conn = mysql_connect($cfg['host'],$cfg['user'],$cfg['pwd']);
		mysql_query('use '.$cfg['db'],$conn);
		mysql_query('set names '.$cfg['charset'],$conn);
		
		// $conn = mysql_connect('localhost','ws','123456');
		// mysql_query('use wsboke',$conn);
		// mysql_query('set names utf8',$conn);
		
	}
	
	return $conn;
}

/*
查询的函数
@return mixed resoure/boll
*/
function mQuery($sql){
	return mysql_query($sql,mConn());
}

/*
select 查询多行数据
@return mixed select 查询成功返回二维数组，失败返回false

*/
function mGetAll($sql){
	$rs = mQuery($sql);
	if(!$rs){
		return false;
	}
	
	$data = Array();
	while($row = mysql_fetch_assoc($rs)){
		$data[] = $row;
	}
	return $data;
}


// $sql = "select * from cat";
// print_r(mGetAll($sql));

/*
select 取出一行数据
@param str $sql 待查询的sql语句
@return arr/false 查询成功 返回一个一维数组
*/

function mGetRow($sql){
	$rs = mQuery($sql);
	if(!$rs){
		return false;
	}
	return mysql_fetch_assoc($rs);
}

// $sql = "select * from cat where cat_id=1";
// print_r(mGetRow($sql));


/*
select 查询返回一个结果

@param str $sql 待查询的select语句
@return mixed 成功，返回结果，失败返回false
*/

function mGetOne($sql){
	$rs = mQuery($sql);
	if(!$rs){
		return false;
	}
	return mysql_fetch_row($rs)[0];
}

// $sql = "select count(*) from art where cat_id = 1";
// echo mGetOne($sql);


/*
 自动拼接insert 和update sql语句，并且调用mQuery() 去执行sql
 
 @param str $table 表面
 @param str $data 接收到的数据，一维数组
 @param str $act 动作 默认为 insert
 @param str $where 防止update更改时少加where条件
 @return bool insert 或者 update 插入成功或者失败
*/

function mExec($table,$data,$act='insert',$where=0){
	if($act == 'insert'){
		$sql = "insert into $table (";
		$sql .= implode(',' , array_keys($data)) . ") values (" . "'";
		$sql .= implode("','", array_values($data)) . "')";
		// echo  $sql;
		return mQuery($sql);
	}else if($act == 'update'){
		$sql = "update $table set ";
		foreach($data as $k=>$v){
			$sql .= $k . "='" . $v ."',";
		}
		$sql = rtrim($sql , ',') . " where ".$where;
		echo mQuery($sql);
	}
	
}

// $data =array('title'=>'今天的空气','content'=>'空气质量优','pubtime'=>'1213556','author'=>'wu');
//insert into art (title,content,pubtime,author) values (今天的空气','空气质量优','1213556','wu')；
// echo mExec('art' , $data);


/*
取得上一步insert操作产生的主键id
*/
function getLastId(){
	return mysql_insert_id(mConn());
}


?>