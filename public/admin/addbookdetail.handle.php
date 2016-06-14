<?php
  require_once('../../headfiles/connect.php');

  if( empty($_POST['bid'])
      ||
      empty($_POST['lcode'])
      ||
      empty($_POST['bname'])
    )
      {
    echo '<script type="text/javascript">';
    echo 'alert("book id, language, and book name cannot be null");';
    echo 'window.location.href = "addbookdetail.php";';
    echo '</script>';
  };

  $bid = $_POST['bid'];
  $lcode = $_POST['lcode'];
  $bname = $_POST['bname'];
  $brelease = $_POST['brelease'];
  $wcount = $_POST['wcount'];
  $bupdate = $_POST['bupdate'];
  $bdesc = $_POST['bdesc'];
  //var_dump($bid);

  $insertsql = "insert into BookDetails values ('$bid','$lcode','$bname','$brelease',
                                                '$wcount','$bupdate','$bdesc')";
  //echo $insertsql;

  if(mysqli_query($connect,$insertsql)){
    echo '<script type="text/javascript">';
    echo 'alert("add book details successfully");';
    echo 'window.location.href = "addbookdetail.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("add book details unsuccessfully");';
    echo 'window.location.href = "addbookdetail.php";';
    echo '</script>';
  }
?>
