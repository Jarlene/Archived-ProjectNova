
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
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    text-align: center;
    color: orange;
}
th, td {
    padding: 5px;
}
table{
    width: 70%;
}
h1{
    font color="orange";
}
</style>
</head>

<body>
<br>

<center>





<?php
//include_once "../headfiles/pdo_h.php";
include_once "../headfiles/backend_classes_h.php";
//include_once "../headfiles/frontend_classes_h.php";

$language =$_GET["lcode"];
$language =substr($language, 1,-1);
//$language ='eng';
if(isset($_POST['submit'])){
$language = $_POST['lang'];
}

$q = new Query;
$BID=$_GET["bid"];
$BID=substr($BID, 1,-1);
//$BID='Re_Zero_Novels';
$obj = $q->getBook($BID,$language);
$links =  $q->getBookLinks($BID, $language);
$comments = $q->getBookComments($BID);
?>

<div id="BookDetail">
<?php
    echo $obj->toHTMLDivision();
?>
</div>


<div id="rightb">
<font color="orange">
Choose your reading language:
</font>
<form action="#" method="post">
<select name="lang">
<option value="eng">English</option>
<option value="zho">Chinese</option>
<option value="jpn">Japanese</option>
</select>
<input type="submit" name="submit" value="submit" />
</form>
</div>

<br>

<!-- Bookmark Links Here  -->
<div id="AddBookMark">
<a href="www.baidu.com"><img src="images/addfavoriate.png" alt="" class="img-circle"></a>
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
  <caption color="orange">Comments:</caption>
    <?php
        foreach ($comments as $r) {
            echo $r->toHTMLTableRow();
        }
    ?>
</table>
</div>


<!-- Add new comments here  -->
<div id="AddComments">
   <font color="orange"><p>add your comment:</p></font>
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









