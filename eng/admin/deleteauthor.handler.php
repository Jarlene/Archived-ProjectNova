<?php
  require_once('../../headfiles/connect.php');
  $aid = $_GET['aid'];
  $lcode = $_GET['lcode'];
  // echo $bid;

  $query = "delete from Authors where AID = '$aid' and LCode = '$lcode'";
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
