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
include_once "../headfiles/backend_classes_h.php";
include_once 'test.php';
$q = new Query;
echo "<h1>Hey, ". $_COOKIE['user'] ."! here is your favourite books! </h1>";
$results = $q->getFavBooks( $_COOKIE['user'], 'eng');
foreach($results as $row)
	{
		echo '<br>';
		var_dump($row);
		echo '<br>';
		echo $row->toHTMLTableRow();
	}
?>


</html>