<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< Updated upstream
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
=======
>>>>>>> Stashed changes
<title>Welcome to nova!</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<<<<<<< HEAD
<link href="css/signin.css" rel="stylesheet">

<<<<<<< Updated upstream
</head>

<?php
require_once('test.php');
?>

<body>

=======
<?php
require_once('../headfiles/connect.php');

 $username = $_COOKIE['user'];
 $insertsql = "SELECT * FROM Members WHERE username='$username'";
 $res = mysqli_query($connect,$insertsql);
if(!$res){
    echo '<script type="text/javascript">';
    echo 'alert("the user does not exist or has expired.");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
  }else{

      echo '
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="test.php">Project Nova</a>
    </div>

    <ul class="nav navbar-nav">

      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Home <span class="caret"></span></a>
        <ul class="dropdown-menu">
         <li><a>'. $_COOKIE['user'] .'</a></li>
         <li><a href="index.php">signout</a></li>
        </ul>
      </li>

     <li><a href="search.php">search</a></li>


      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">MY FAVOURITE <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="favAuth.php">AUTHORS</a></li>
          <li><a href="favBok.php">BOOKS</a></li>
        </ul>
      </li>

=======
<link href="css/search.css" rel="stylesheet">
</head>
>>>>>>> parent of 9232518... Update for basic funcitons

<body>


<?php
include_once 'test.php';
?>

>>>>>>> Stashed changes
<div class="search">
	<div class="signin-head"><img src="images/test/touxiang.jpeg" alt="" class="img-circle"></div>
	<form  role="form" name="form" action="search.handler.php" method="post">
		<input type="text" class="form-control" name="search" id="search" required autofocus />
    Preferred language:
                  <select name="lcode">
<<<<<<< HEAD
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
=======
                      <?php
                        require_once('../connect.php');
                        $query = "select distinct LCode from Languages";
                        $result = mysqli_query($connect, $query);
                        //var_dump($result);
                        while ($arr = mysqli_fetch_array($result)){
                          echo '<option value="'.$arr['LCode'].'">'.$arr["LCode"].'</option>';
                        }
                      ?>
>>>>>>> parent of 9232518... Update for basic funcitons
                  </select><br/>
		<button class="btn btn-lg btn-warning btn-block" type="submit">Search</button>
	</form>
</div>

<<<<<<< Updated upstream
<!-- Show Case Here -->

<div id='TB'>
<div id="SearchResult">
<h3> Trending Books:</h3>
<table id="TrendingBooks">
  <tr>
    <th>Book Title</th>
    <th>Author</th>
    <th>Genre</th>
    <th>Release</th>
    <th>Update</th>
    <th>Views</th>
    <th>Fans</th>
  </tr>

<?php
  require_once('../headfiles/backend_classes_h.php');
  $q = new Query;
  $results = $q->getBookShowcase('eng');
  $i = 0;
  foreach ($results as $r) {
    if ($i > 9) break;
    echo $r->toHTMLTableRow();
    $i++;
  }
?>
 </table>
</div>
</div>

<div id='TA'>
<div id="AuthorShowcase">
<h3> Trending Authors:</h3>
<table id="TrendingAuthors">
  <tr>
    <th>Author</th>
    <th>Fans</th>
  </tr>

<?php
  require_once('../headfiles/backend_classes_h.php');
  $q = new Query;
  $results = $q->getAuthorShowcase('eng');
  $i = 0;
  foreach ($results as $r) {
    if ($i > 9) break;
    echo $r->toHTMLTableRow();
    $i++;
  }
?>

  </table>
  </div>
</div>

=======
>>>>>>> Stashed changes
</body>
</html>
