<!DOCTYPE html>
<html lang="ja-jp">
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
function isValidUser(){
  $username = null;
  $lang = 'jpn';
  if(isset($_COOKIE['user'])){
    $username = $_COOKIE['user'];}

  if(isset($_COOKIE['lang'])){
    $lang = $_COOKIE['lang'];}


  require_once('../headfiles/pdo_h.php');
  try{$dbh = _db_connect();
    $stmt = $dbh->prepare("SELECT * FROM Members WHERE UserName=:uid");
    $stmt->bindParam(':uid', $username);
    $stmt->execute();
    _db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

    $r = $stmt->fetch();

    return $r;
}

function yeildIfInvalidUser(){
  if (!isValidUser()){
    $msg = "ユーザーが存在しないか、ログインの期限が切れている、もう一度ログインしてください！";
    echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('$msg');
        window.location.replace('index.php');
        </SCRIPT>";
  }
}

function validateAdmin(){
  $u = isValidUser();
  if ($u){
    if ($u['UserName'] == 'admin')
      {return true;}
  }
  return false;
}
?>

</head>


<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Project Nova</a>
    </div>
    <ul class="nav navbar-nav">
  
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <?php

        if(isset($_COOKIE['user'])){
          echo 'お帰りなさい,'. $_COOKIE['user'];
        }else{
          echo 'ここでログイン';
        }
        ?>
              <span class="caret"></span></a>
                <ul class="dropdown-menu">
        <?php
        if(isset($_COOKIE['user'])){
          echo   '<li><a href=fav.php> お気に入り＆歴史 </a></li>';
        }else{
          echo '<li><a href=index.php>ログイン</a></li>';
        }
        ?>
                 <li><a href="signout.php">ログアウト</a></li> 
                </ul>
              </li>
             <li><a href="search.php">検索</a></li>
        <?php
        if(validateAdmin()){
          echo '<li><a href="admin/manage.php">Admin管理パネル</a></li>';
        }
        ?>

      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> 言語の変更
        <span class="caret"></span></a>
        <ul class="dropdown-menu">

          <?php
            require_once('../headfiles/pdo_h.php');
            try{$dbh = _db_connect();
            $stmt = $dbh->prepare("SELECT DISTINCT * from Languages");
            $stmt->execute();
            _db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}
            $result = $stmt->fetchAll();
            foreach ($result as $v) {
              echo '<li><a href='.$v['HomePage'].'>'.$v["LName"].'</a></li>';
            }
          ?>
        </ul>
      </li>
    </ul>


  </div>
</nav>

</body>
</html>

