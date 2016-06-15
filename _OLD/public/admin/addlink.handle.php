<?php
  require_once('../../headfiles/connect.php');
  if(!(isset($_POST['url']) && (!empty($_POST['ltype']))
      && (!empty($_POST['bid']))
      && (!empty($_POST['lcode']))
      )) {
    echo '<script type="text/javascript">';
    echo 'alert("url, language type, book, and language cannot be null");';
    echo 'window.location.href = "addlink.php";';
    echo '</script>';
  };

  $url = $_POST['url'];
  $ltype = $_POST['ltype'];
  $bid = $_POST['bid'];
  $lcode = $_POST['lcode'];
  $checksum = crc32($url);
  $insertsql = "insert into Links values ('$url','$ltype','$bid','$lcode','$checksum')";
  //echo $insertsql;

  if(mysqli_query($connect,$insertsql)){
    echo '<script type="text/javascript">';
    echo 'alert("add a link successfully");';
    echo 'window.location.href = "addlink.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("add a link unsuccessfully");';
    echo 'window.location.href = "addlink.php";';
    echo '</script>';
  }
?>
