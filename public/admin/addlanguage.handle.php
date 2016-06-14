<?php
  require_once('../../headfiles/connect.php');

  if(!(isset($_POST['lcode']) && (!empty($_POST['lcode']))
      && (!empty($_POST['lname']))
      )) {
    echo '<script type="text/javascript">';
    echo 'alert("language and language code cannot be null");';
    echo 'window.location.href = "addlanguage.php";';
    echo '</script>';
  };

  $lcode = $_POST['lcode'];
  $gname = $_POST['lname'];
  $glink = $_POST['hpage'];

  $insertsql = "insert into Languages values ('$lcode','$lname','$hpage')";
  //echo $insertsql;

  if(mysqli_query($connect,$insertsql)){
    echo '<script type="text/javascript">';
    echo 'alert("add language successfully");';
    echo 'window.location.href = "addgenre.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("add language unsuccessfully");';
    echo 'window.location.href = "addgenre.php";';
    echo '</script>';
  }
?>
