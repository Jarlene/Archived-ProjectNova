<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to nova!</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/signin.css" rel="stylesheet">

<?php
require_once('../connect.php');
$username = $_COOKIE['user'];
 $insertsql = "SELECT * FROM Members WHERE username='$username'";
 $res = mysqli_query($connect,$insertsql);
if(!$res){
    echo '<script type="text/javascript">';
    echo 'alert("the user does not exist or has expired.");';
    echo 'window.location.href = "index.php";';
    echo '</script>'; 
  }else{
  	  echo "Welcome to nova " . $_COOKIE['user'] . "!!!!";
  	  echo "<a href='index.php'> signout </a>";

  }
  mysqli_free_result($res);
  mysqli_close($connect);
?>

</head>

</html>
