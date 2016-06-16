<?php
  require_once('../../headfiles/connect.php');
  $aid = $_POST['aid'];
  $language = $_POST['language'];
  $aname = $_POST['aname'];
  $adesc = $_POST['adesc'];

  $updatesql = "update Authors
                Set ADesc = '$adesc', AID = '$aid', AName = '$aname',LCode = '$language'
                where AID = '$aid' and LCode = '$language'";
  //  echo $updatesql;

  //  $result = mysqli_query($connect,$updatesql);
  //  var_dump($result);
  if(mysqli_query($connect,$updatesql)){
    echo '<script type="text/javascript">';
    echo 'alert("update author successfully");';
    echo 'window.location.href = "manage.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("update author unsuccessfully, please try again.");';
    echo 'window.location.href = "manage.php";';
    echo '</script>';
  }
?>
