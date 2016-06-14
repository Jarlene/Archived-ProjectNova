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
    echo 'alert("passwords you input are different, please try again.");';
    echo 'window.location.href = "register.php";';
    echo '</script>';
  };

  $insertsql = "insert into Members values ('$username','$shapass','$language','')";
  //echo $insertsql;
  if(mysqli_query($connect,$insertsql)){
    echo '<script type="text/javascript">';
    echo 'alert("register successfully, please login in your account");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("register unsuccessfully, please try again");';
    echo 'window.location.href = "register.php";';
    echo '</script>';
  }

  ?>
