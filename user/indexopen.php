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

<body>
<div class="signin">
	<div class="signin-head"><img src="images/test/touxiang.jpeg" alt="" class="img-circle"></div>
	<form class="form-signin" role="form" name="form" action="index.handle.php" method="post">
		<input type="text" class="form-control" name="username" id="username" required autofocus />
		<input type="password" class="form-control" name="password" id="password" required />
		<button class="btn btn-lg btn-warning btn-block" type="submit">login</button>
		<label class="checkbox">
			<input type="checkbox" value="remember-me"> Remeber me
		</label>
	</form>
	<form class="form-signin" role="form" name="form" action="register.php" method="post">
		<button class="btn btn-lg btn-warning btn-block" type="botton">register</button>
	</form>

</div>

</body>
</html>
