<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <title>Bootstrap Case</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to nova!</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/signin.css" rel="stylesheet">

<?php
$username = $_COOKIE['user'];
$lang = $_COOKIE['lang'];

require_once('../headfiles/pdo_h.php');
try{$dbh = _db_connect();
  $stmt = $dbh->prepare("SELECT * FROM Members WHERE UserName=:uid");
  $stmt->bindParam(':uid', $username);
  $stmt->execute();
  _db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

  $r = $stmt->fetch();

if(!$r){
    echo '<script type="text/javascript">';
    echo 'alert("the user does not exist or has expired.");';
    echo 'window.location.href = "index.php";';
    echo '</script>'; 
}
?>

</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="search.php">Project Nova</a>
    </div>
    <ul class="nav navbar-nav">
  
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Home <span class="caret"></span></a>
        <ul class="dropdown-menu">
<?php
  echo   '<li><a>'. $_COOKIE['user'] .'</a></li>';
?>
         <li><a href="index.php">signout</a></li> 
        </ul>
      </li>
     <li><a href="search.php">search</a></li>
   
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">MY FAVOURITE <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="favAuth.php">AUTHORS</a></li> 
          <li><a href="favBok.php">BOOKS</a></li> 
        </ul>
      </li>
    </ul>
  </div>
</nav>

</body>
</html>

