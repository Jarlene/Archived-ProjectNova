
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


<?php
include_once "../headfiles/pdo_h.php";
include_once "../headfiles/backend_classes_h.php";
include_once "../headfiles/frontend_classes_h.php";

$language ='eng';
if(isset($_POST['submit'])){
$language = $_POST['lang'];
}

$q = new Query;
$BID='Re_Zero_Novels';
$obj = $q->getBook($BID, $language);
$links =  $q->getBookLinks($BID, $language);
$comments = $q->getBookComments($BID);
?>

<div id="BookDetail">
<?php
    echo $obj->toHTMLDivision();
?>
</div>

<!-- Bookmark Links Here  -->
<a href="Bookmark">BookMark</a>

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
<div>
    <input type="" name=""></input>
</div>

</center>

</body>









