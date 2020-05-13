<?php
// $servername = "127.0.0.1"; // 地址
// $username = "ws"; // 用户名
// $password = "123456"; // 密码

// $conn = new mysqli($servername,$username,$password);

// // 检测连接是否成功
// if($conn->connect_error){     //如果没有错误,会返回一个NULL
//     die("连接失败，错误:" . $conn->connect_error);   //打印错误信息
// }





$con = mysql_connect('127.0.0.1','ws','123456');
mysql_select_db('wsboke',$con);
mysql_query('set names utf8'); 
error_reporting(0);




?>	
