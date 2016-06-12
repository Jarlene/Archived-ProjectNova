
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

<br> </br>

<center><font color="orange"><h1>Book Name</h1></font></center>

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
$language ='eng';
if(isset($_POST['submit'])){
$language = $_POST['lang'];

}
?>



<?php
include_once "../headfiles/pdo_h.php";
include_once "../headfiles/backend_classes_h.php";
include_once "../headfiles/frontend_classes_h.php";
$q = new Query;
$BookName='Re_Zero_Novels';
$obj = $q->getBook($BookName, $language);
$links =  $q->getBookLinks($BookName, $language);
?>


<div id="footer">
        <div id="center">
<p><font size="4" color="orange">Available Links:</font><p>
<font size="3" color="orange">
<?php
  foreach ($links as $r) {
    echo $r->toHTMLTableRow();
  }
?>
</font>
</div>
</div>



<font size="5">
<?php
echo $obj->BName;
?>
</font>


<p><font size="5" color="orange">Author name </font></p>

<font size="5">
<?php
echo $obj->AName;
?>
</font>


<p><font size="5" color="orange">Book Description </font></p>

<div style=width:900px;height:500px">
<font size="3">
<?php
echo $obj->BDesc;
?>
</font>
</div>

<style>

#footer {
    position: absolute;
    bottom: 0%;
    width: 100%;
}
#center {
    width: 500px;
    margin: 0 auto;
}

#rightu1 {
    position: absolute;
    right:3%;
    top:10%;
    margin: 0 auto;
}

#rightu2 {
    position: absolute;
    right:2%;
    top:20%;
    margin: 0 auto;
}

#rightb {
    position: absolute;
    right:42.5%;
    bottom:20%;
    margin: 0 auto;
}

#gr {
    position: absolute;
    left:15%;
    top:12%;
    margin: 0 auto;
}

#wc {
    position: absolute;
    left:15%;
    top:17%;
    margin: 0 auto;
}

#rl {
    position: absolute;
    left:15%;
    top:22%;
    margin: 0 auto;
}

#ts {
    position: absolute;
    left:15%;
    top:27%;
    margin: 0 auto;
}

#ud {
    position: absolute;
    left:15%;
    top:32%;
    margin: 0 auto;
}

</style>





<div id="rightu1">
<img src="images/addfavoriate.png" alt="" class="img-circle">
</div>

<div id="rightu2">
<img src="images/searchauth.png" alt="" class="img-circle">
</div>

<div id="gr">
<font size="3" color="orange">word count: </font>
<?php
if($obj->GName!=NULL){
echo $obj->GName;
}else{
echo 'No information';
}
?>
</div>


<div id="wc">
<font size="3" color="orange">word count: </font>
<?php
if($obj->WCount!=NULL){
echo $obj->WCount;
}else{
echo 'No information';
}
?>
</div>

<div id="rl">
<font size="3" color="orange">original release:</font>
<?php
if($obj->ORelease!=0000-00-00){
echo $obj->ORelease;
}
else{
echo 'No information';
}
?>
</div>

<div id="ts">
<font size="3" color="orange">Translated Version:</font>
<?php
if($obj->BRelease!=0000-00-00){
echo $obj->BRelease;
}
else{
echo 'No information';
}
?>
</div>


<div id="ud">
<font size="3" color="orange">Update date:</font>
<?php
if($obj->BUpdate!=0000-00-00){
echo $obj->BUpdate;
}
else{
echo 'No information';
}
?>
</div>


</center>

</body>









