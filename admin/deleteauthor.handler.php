<?php
  require_once('../connect.php');
  $aid = $_GET['aid'];
  $lcode = $_GET['lcode'];
  // echo $bid;

  $query = "delete from authors where aid = '$aid' and lcode = '$lcode'";
  //echo $query;

  if(mysqli_query($connect,$query)){
    echo '<script type="text/javascript">';
    echo 'alert("delete an author successfully");';
    echo 'window.location.href = "manage.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("delete an author unsuccessfully");';
    echo 'window.location.href = "manage.php";';
    echo '</script>';
  }
?>
