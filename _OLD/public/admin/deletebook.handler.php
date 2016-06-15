<?php
  require_once('../../headfiles/connect.php');
  $bid = $_GET['bid'];
  // echo $bid;

  $query = "delete from books where bid = '$bid'";
  //echo $query;

  if(mysqli_query($connect,$query)){
    echo '<script type="text/javascript">';
    echo 'alert("delete a book successfully");';
    echo 'window.location.href = "manage.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("delete a book unsuccessfully");';
    echo 'window.location.href = "manage.php";';
    echo '</script>';
  }
?>
