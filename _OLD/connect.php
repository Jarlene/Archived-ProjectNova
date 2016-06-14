<?php
define('HOST','localhost:8889');
define('USER_NAME','root');
define('PASSWORD','root');
define('DATABASE','nova');
$connect=mysqli_connect(HOST,USER_NAME,PASSWORD,DATABASE);
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
