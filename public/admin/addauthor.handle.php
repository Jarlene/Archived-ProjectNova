<?php
  require_once('/../../headfiles/connect.php');
  if(!(isset($_POST['aid']) && (!empty($_POST['aid']))
      && (!empty($_POST['language']))
      && (!empty($_POST['aname']))
      )) {
    echo '<script type="text/javascript">';
    echo 'alert("author ID, language, and author name cannot be null");';
    echo 'window.location.href = "addauthor.php";';
    echo '</script>';
  };

  $aid = $_POST['aid'];
  $language = $_POST['language'];
  $aname = $_POST['aname'];
  $adesc = $_POST['adesc'];

  $insertsql = "insert into Authors values ('$aid','$language','$aname','$adesc')";
  //echo $insertsql;

  if(mysqli_query($connect,$insertsql)){
    echo '<script type="text/javascript">';
    echo 'alert("add author successfully");';
    echo 'window.location.href = "addauthor.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("add author unsuccessfully");';
    echo 'window.location.href = "addauthor.php";';
    echo '</script>';
  }
?>
