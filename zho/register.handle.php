<?php
  require_once "../headfiles/connect.php";

  $username = $_POST['username'];
  $password = $_POST['password'];
  $shapass = sha1($password);
  $conpass = $_POST['conpass'];
  $language = $_POST['language'];
  // echo $username;
  // echo $password;
  // echo $shapass;
  // echo $conpass;
  // echo $language;

  if($password <> $conpass) {
    echo '<script type="text/javascript">';
    echo 'alert("用户名或密码错误，请重试！");';
    echo 'window.location.href = "register.php";';
    echo '</script>';
  };

  $insertsql = "insert into Members values ('$username','$shapass','$language','')";
  //echo $insertsql;
  if(mysqli_query($connect,$insertsql)){
    echo '<script type="text/javascript">';
    echo 'alert("注册成功！将跳转到登陆界面");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("注册失败！请检查注册信息后重试");';
    echo 'window.location.href = "register.php";';
    echo '</script>';
  }

?>
