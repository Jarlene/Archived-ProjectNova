<!DOCTYPE html>
<html lang="en_us">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
#TB{
    width:65%;
    height:100px;
    float:left;
    margin: 0 auto;
}
#TA{
    width:30%;
    height:100px;
    float:left;
    margin: 0 auto;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    text-align: center;
    margin: 0 auto;
}
th, td {
    padding: 5px;
}
</style>
<title>Welcome to nova!</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/signin.css" rel="stylesheet">
</head>

<?php
require_once "test.php";
yeildIfInvalidUser();
?>

<body>

<?php
echo "<h1>Hey, ". $_COOKIE['user'] ."! Here are your favourite Books and Authors! </h1> <br>";
?>

<div id='TB'>
<div id="favb">
<h3> Books:</h3>
<table id="FavoriteBooks">
  <tr>
    <th>Book Title</th>
    <th>Author</th>
    <th>Added at</th>
  </tr>

<?php
  require_once('../headfiles/backend_classes_h.php');
  $q = new Query;
  $results = $q->getFavBooks($_COOKIE['user'], $_COOKIE['lang']);
  foreach ($results as $r) {
    echo $r->toHTMLTableRow();
  }
?>
</table>
</div>
</div>

<div id='TA'>
<div id="fava">
<h3> Authors:</h3>
<table id="FavoriteAuthors">
  <tr>
    <th>Author</th>
    <th>Added at</th>
  </tr>

<?php
  require_once('../headfiles/backend_classes_h.php');
  $q = new Query;
  $results = $q->getFavAuthors($_COOKIE['user'], $_COOKIE['lang']);
  foreach ($results as $r) {
    echo $r->toHTMLTableRow();
  }
?>
</table>
</div>
</div>

</body>
</html>
