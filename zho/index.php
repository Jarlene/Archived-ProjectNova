<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to nova!</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/signin.css" rel="stylesheet">

</head>
<?php
require_once('test.php');
if(isset($_COOKIE['user'])){
	SetCookie('lang', 'zho', -1, '/');
	header("location:search.php");
    exit;}
?>

<body>
<div class="signin">
	<div class="signin-head"><img src="images/test/touxiang.jpeg" alt="" class="img-circle"></div>
	<form class="form-signin" role="form" name="form" action="index.handle.php" method="post">
		<input type="text" class="form-control" name="username" id="username" required autofocus />
		<input type="password" class="form-control" name="password" id="password" required />
		<button class="btn btn-lg btn-warning btn-block" type="submit">登陆</button>
	</form>
	<form class="form-signin" role="form" name="form" action="register.php" method="post">
		<button class="btn btn-lg btn-warning btn-block" type="botton">注册</button>
	</form>

</div>

</body>
</html>
