<?php
  require_once('../connect.php');

  if(!(isset($_POST['gcode']) && (!empty($_POST['gcode']))
      && (!empty($_POST['lcode'])) && (!empty($_POST['gname']))
      )) {
    echo '<script type="text/javascript">';
    echo 'alert("genre code, language, and genre name cannot be null");';
    echo 'window.location.href = "addgenre.php";';
    echo '</script>';
  };

  $gcode = $_POST['gcode'];
  $lcode = $_POST['lcode'];
  $gname = $_POST['gname'];
  $glink = $_POST['glink'];

  $insertsql = "insert into Genres values ('$gcode','$lcode','$gname','$glink')";
  //echo $insertsql;

  if(mysqli_query($connect,$insertsql)){
    echo '<script type="text/javascript">';
    echo 'alert("add genre successfully");';
    echo 'window.location.href = "addgenre.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("add genre unsuccessfully");';
    echo 'window.location.href = "addgenre.php";';
    echo '</script>';
  }
?>
