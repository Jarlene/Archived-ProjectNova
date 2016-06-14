<?php
  require_once "../headfiles/connect.php";

  $username = $_POST['username'];
  $password = $_POST['password'];
  $hashpw=sha1($password);
  $insertsql = "SELECT * FROM Members WHERE username='$username' and userpass='$hashpw'";
  //echo $insertsql;
  $res = mysqli_query($connect,$insertsql);
  $rows= mysqli_num_rows($res);
  //var_dump($rows);

  if($rows){
    SetCookie("user", "$username", time()+3600);
    header("location:test.php");
    exit;
  } else {
    echo "Login fail, please try again.";
  }
  mysqli_free_result($res);
  mysqli_close($connect);
?>
