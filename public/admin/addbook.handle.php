<?php
  require_once('../connect.php');

  if(!(isset($_POST['bid']) && (!empty($_POST['bid']))
      && (!empty($_POST['aid'])) && (!empty($_POST['gcode']))
      )) {
    echo '<script type="text/javascript">';
    echo 'alert("book id, author id, and genre code cannot be null");';
    echo 'window.location.href = "addbook.php";';
    echo '</script>';
  };

  $bid = $_POST['bid'];
  $aid = $_POST['aid'];
  $gcode = $_POST['gcode'];
  $orelease = $_POST['orelease'];
  $clicks = $_POST['clicks'];
  $rating = $_POST['rating'];

  $insertsql = "insert into Books values ('$bid','$aid','$gcode','$oralease','$clicks','$rating')";
  //echo $insertsql;

  if(mysqli_query($connect,$insertsql)){
    echo '<script type="text/javascript">';
    echo 'alert("add book successfully");';
    echo 'window.location.href = "addbook.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("add book unsuccessfully");';
    echo 'window.location.href = "addbook.php";';
    echo '</script>';
  }
?>
