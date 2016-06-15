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
    echo 'alert("ユーザー名またはパスワードが間違っている、再度お試しください！");';
    echo 'window.location.href = "register.php";';
    echo '</script>';
  };

  $insertsql = "insert into Members values ('$username','$shapass','$language','')";
  //echo $insertsql;
  if(mysqli_query($connect,$insertsql)){
    echo '<script type="text/javascript">';
    echo 'alert("登録に成功！ログイン画面へジャンプします");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("登録に失敗しました！登録情報を確認して再試行してください");';
    echo 'window.location.href = "register.php";';
    echo '</script>';
  }

?>
