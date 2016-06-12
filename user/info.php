
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
<?php
  include 'pdo_h.php';
   
  class Bookinfo{
  public $BName;
  public $BDesc;
  public $AName;
  public $ADesc;
  public $WCount;
  
  public function printBName() {
  return $this->BName;
  }

  public function printBDesc() {

  return 'A'.$this->BDesc;
  }
  }


  db_connect();
?>

<p><font size="5" color="black">
<?php
$stmt = $dbh->query("SELECT BName FROM BookDetails WHERE BID='Re_Zero_Novels' AND LCode='zho' ");
$stmt->setFetchMode(PDO::FETCH_INTO, new Bookinfo);
foreach($stmt as $bookinfo)
{
    echo nl2br($bookinfo->printBName().'<br />');
}

?>
</font></p>


<p><font size="5" color="orange">Author name </font></p>

<br>

<p><font size="5" color="orange">Book Description </font></p>

<div style=width:800px;height:500px">
<?php

$stmt1 = $dbh->query("SELECT BDesc FROM BookDetails WHERE BID='Re_Zero_Novels' AND LCode='zho' ");
$stmt1->setFetchMode(PDO::FETCH_INTO, new Bookinfo);


foreach($stmt1 as $bookinfo)
{
    echo $bookinfo->printBDesc().'<br />';
}


db_commit();
?>
</div>

<style>

#footer {
    position: absolute;
    bottom: 5%;
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
    right:38%;
    bottom:15%;
    margin: 0 auto;
}

</style>


<div id="footer">
        <div id="center">
<img src="images/readlink.png" alt="" class="img-circle">
</div>
</div>


<div id="rightu1">
<img src="images/addfavoriate.png" alt="" class="img-circle">
</div>

<div id="rightu2">
<img src="images/searchauth.png" alt="" class="img-circle">
</div>


<div id="rightb">
<font color="orange">
Choose your reading language:
</font>
<select>
<option value="Eng">English</option>
<option value="Chi">Chinese</option>
<option value="Jap">Japanese</option>
</select>
</div>

</center>

</body>









