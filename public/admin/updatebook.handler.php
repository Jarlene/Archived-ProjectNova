<?php
  require_once('../../headfiles/connect.php');

  $bid = $_POST['bid'];
  $aid = $_POST['aid'];
  $gcode = $_POST['gcode'];
  $orelease = $_POST['orelease'];
  $clicks = $_POST['clicks'];
  $rating = $_POST['rating'];

  $updatesql = "update Books
                Set bid = '$bid',aid = '$aid',gcode = '$gcode',orelease = '$orelease',
                clicks = '$clicks',rating = '$rating'
                where bid = '$bid'";
  // echo $updatesql;
  // $result = mysqli_query($connect,$updatesql);
  // var_dump($result);
  if(mysqli_query($connect,$updatesql)){
    echo '<script type="text/javascript">';
    echo 'alert("update book successfully");';
    echo 'window.location.href = "manage.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("update book unsuccessfully, please try again");';
    echo 'window.location.href = "manage.php";';
    echo '</script>';
  }
?>
