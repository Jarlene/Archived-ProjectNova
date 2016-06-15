<?php
require_once 'mysql_login_info.ini';
$connect=mysqli_connect(MYSQL_HOST ,MYSQL_DB_USER ,MYSQL_DB_PASS ,MYSQL_DB_DATABASE );
  // if(!$connect) echo "数据库连接失败!<br>".mysql_error();
  // else echo "数据库连接成功!<br>";
  //选库
  // if(!(mysqli_select_db($connect,'info'))){
  //     echo mysqli_error;
  // };
  //字符集
  if(!(mysqli_query($connect,'set names utf8'))){
      echo mysqli_error;
  }
 ?>
