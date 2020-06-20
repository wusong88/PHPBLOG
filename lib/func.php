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


//获取来访者的真实ip

function getRealIp(){
	static $realip = null;
	if ($realip !== null) {
		return $realip;
	}
	
		
	if (getenv('REMOTE_ADDR')) {
		$realip = getenv('REMOTE_ADDR');
	} else if (getenv('HTTP_CLIENT_IP')) {
		$realip = getenv('HTTP_CLIENT_IP');
	} else if (getenv('HTTP_X_FROWARD_FOR')) {
		$realip = getenv('HTTP_X_FROWARD_FOR');
	} 
	
	return $realip;
}

/*
 生成分页代码 
 @param int $num 文章总数
 @param int $curr 当前显示的页码数     $curr-2  $curr-1  $curr  $curr+1  $curr=2
 @param int $cnt 每页显示的条数
*/
function getPage($num,$curr,$cnt){
	//最大的页码数
	$max = ceil($num / $cnt);
	//最左侧页码
	$left = max(1,$curr-2);
	//最右侧页码
	$right = min($left+4,$max);
	
	$left = max(1,$right-4);
	
	$page= array();
	for ($i=$left;$i<=$right;$i++) {
		$_GET['page'] = $i;
		$page[$i] = http_build_query($_GET);
	}
	
	return $page;
	
}

// print_r(getPage(100,5,10));

/*
	生成随机字符串
	@param int $num 生成的随机字符串的个数
	@return str 生成的随机字符串
*/

function randStr($num=6) {
	$str = str_shuffle('abcdefghjkmnopqrstuvwxyzABCDEFGHJKMNOPQRSTUVWXYZ23456789');
	return substr($str,0,$num);
}

//echo randStr();


/*
 创建目录 ROOT.'/upload/2020/06/01/jj.jpg'
*/
function createDir() {
	$path = '/upload/'.date('Y/m/d');
	$fpath = ROOT . $path;
	if(is_dir($fpath) || mkdir($fpath,0777,true)){
		return $path;
	} else {
		return false;
	}	
}


/*
 获取文件后缀
 @param str $filename 文件名
 @return str 文件的后缀，且带点.
*/
function getExt($filename) {
	return strrchr($filename, '.');
}






/*
 生成缩略图
 @param str $oimg /upload/2020/03/11/asd.png
 @param int $sw 生成缩略图的宽
 @param int $sh 生成缩略图的高
 @param str 生成缩略图的路径 /upload/2020/03/11/asd.png

*/

function makeThumb ($oimg,$sw=200,$sh=200) {
	//缩略图存放的路径名称
	$simg = dirname($oimg) . '/' . randStr() . '.png';
	
	//获取大图和缩略图的绝对路径
	$opath = ROOT . $oimg;//原图的绝对路径
	$spath = ROOT . $simg;//最终生成的小图
	
	//创建小画布
	$spic = imagecreatetruecolor($sw,$sh);
	//获取大图信息
	list($bw,$bh,$btype) = getimagesize($opath);
	$map = array(
		1=>'imagecreatefromgif',
		3=>'imagecreatefromjpeg',
		3=>'imagecreatefrompng',
		15=>'imagecreatefromwbmp'
	);
	
	
}









?>	
