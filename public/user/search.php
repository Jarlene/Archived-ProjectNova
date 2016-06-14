<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to nova!</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/search.css" rel="stylesheet">
</head>

<body>


<?php
include_once 'test.php';
?>

<div class="search">
	<div class="signin-head"><img src="images/test/touxiang.jpeg" alt="" class="img-circle"></div>
	<form  role="form" name="form" action="search.handler.php" method="post">
		<input type="text" class="form-control" name="search" id="search" required autofocus />
    Preferred language:
                  <select name="lcode">
                      <?php
                        require_once('../connect.php');
                        $query = "select distinct LCode from Languages";
                        $result = mysqli_query($connect, $query);
                        //var_dump($result);
                        while ($arr = mysqli_fetch_array($result)){
                          echo '<option value="'.$arr['LCode'].'">'.$arr["LCode"].'</option>';
                        }
                      ?>
                  </select><br/>
		<button class="btn btn-lg btn-warning btn-block" type="submit">Search</button>
	</form>
</div>

</body>
</html>
