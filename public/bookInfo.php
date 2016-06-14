
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to nova!</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/signin.css" rel="stylesheet">

<style>
h1{
  color: #FFF; 
  background: #FFF
  }
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    text-align: center;
    color: black;
}
th, td {
    padding: 5px;
}
table{
    width: 60%;
}
p{
  font-size: 16px;
}
</style>
</head>

<body>

<center>


<?php
require_once "test.php";
require_once "../headfiles/backend_classes_h.php";

$language =$_GET["lcode"];
//$language ='eng';
if(isset($_POST['submit'])){
$language = $_POST['lang'];
}

$q = new Query;
$BID=$_GET["bid"];
//$BID='Re_Zero_Novels';
$obj = $q->getBook($BID,$language);
$links =  $q->getBookLinks($BID, $language);
$comments = $q->getBookComments($BID);
?>

<div id="BookDetail">
<h1>BOOK INFO</h1>
<?php
    echo $obj->toHTMLDivision();
?>
</div>





<div id="rightb">
<font color="orange" size="5">
Choose your reading language:
</font>
<form action="#" method="post">
<select name="lang">
 <?php
  require_once('../headfiles/pdo_h.php');
  try{$dbh = _db_connect();
  $stmt = $dbh->prepare("SELECT DISTINCT * from Languages");
  $stmt->execute();
  _db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

  $result = $stmt->fetchAll();
  var_dump($result);
  foreach ($result as $v) {
    echo '<option value="'.$v['LCode'].'">'.$v["LName"].'</option>';
  }
?>
</select>
<input type="submit" name="submit" value="submit" />
</form>
</div>

<br>

<!-- Bookmark Links Here  -->
<div id="AddBookMark">
<?php
if(isset($_POST['favor'])){
$favorstate1=$q->isFavBook($_COOKIE['user'],$BID);
$q->changeFavBook($_COOKIE['user'],$BID);
$favorstate2=$q->isFavBook($_COOKIE['user'],$BID);
if($favorstate1==$favorstate2){
  echo "add or delete failed";
}else{if ($favorstate1==false) {
  echo "add successsful!";
}else {echo "delete successsful!";}}
}
?>
<form action="#" method="post">
<input type="submit" name="favor" value="add or delete favoriate" />
</form>
</div>





<br>

<div id="BookLinks">
<table id="BookLinksTable">
  <caption color="orange">Available Links:</caption>
  <tr>
    <th>Type</th>
    <th>URL</th>
  </tr>
<?php
    foreach ($links as $r) {
        echo $r->toHTMLTableRow();
    }
?>
</div>

<div id="BookComments">

<table id="BookCommentTable">
  <p>Comments:</p>
    <?php
        foreach ($comments as $r) {
            echo $r->toHTMLTableRow();
        }
    ?>
</table>
</div>


<!-- Add new comments here  -->
<div id="AddComments">
   <font color="orange" size="5">add your comment:</font>
   <form action="" method="post">
   <textarea name="comment" style="width:400px;height:60px;">Enter your comment</textarea>
   <input type="submit" value="Submit" />
   </form>

<font color="orange">
<?php
if(isset($_POST['comment'])){
$status=$q->addBookComment($BID,$_POST["comment"]);
if(!$status){
  echo "upload comments error";
}else{
  echo "upload comments sccuessfull!";
}
}

?>
</font>

</div>

</center>

</body>









