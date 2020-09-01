<?php 
$con = mysql_connect("47.108.141.190:8088","root","");
if(!$con){
  die("Could not connect: " . mysql_error());
}else{
  echo "mysql is ok";
}
mysql_select_db("NuoHeTest_db", $con);
mysql_query("set names 'gb2312'"); 

$sql = "select * form judge_branch";
$rs = mysql_query($sql);

$rows = Array();
while($a=mysql_fetch_assoc($rs)){
	$rows[]=$a;
}
print_r($rows);


#表名：judge_branch
#字段：id（主键） AUTO_INCREMENT
#字段：branchname（部门名称）varchar200
#字段：can_exam（开启问卷测评）tinyint（1开启 0关闭）
#字段：can_result（开启查看测评报告）tinyint（1开启 0关闭）
#字段：can_showself（开启查看档案信息）tinyint（1开启 0关闭）
#字段：can_onlineself （开启在线咨询）tinyint（1开启 0关闭）
#字段：can_writeself （开启档案信息修改）tinyint（1开启 0关闭）
#字段：can_changeskin （开启皮肤设置）tinyint（1开启 0关闭）
#字段：can_sound （开启语音读题）tinyint（1开启 0关闭）
              
mysql_close($con);
?>




