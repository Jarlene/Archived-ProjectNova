<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
table, th, td {
    border: 2px solid black;
    border-collapse: collapse;
    text-align: center;
}
th, td {
    padding: 20px;
}
</style>

<style>
  #SearchResult {
    width:100%;
    height:100%;
  }
  table {
    margin: 0 auto; /* or margin: 0 auto 0 auto */
  }
</style>


<title>Welcome to nova!</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/signin.css" rel="stylesheet">

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


    </ul>
  </div>
</nav>

';

   }
  mysqli_free_result($res);
  mysqli_close($connect);
?>

</head>

<body>

<div class="search">
	<div class="signin-head"><img src="images/test/touxiang.jpeg" alt="" class="img-circle"></div>
	<form  role="form" name="form" action="search.handler.php" method="post">
		<input type="text" class="form-control" name="search" id="search" required autofocus />

    Preferred language:
                  <select name="lcode">
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
                  </select><br/>
		<button class="btn btn-lg btn-warning btn-block" type="submit">Search</button>
	</form>
</div>
</form>
<?php
/*
		Sample Query class usage demo

		Author: Leo
		Version: 0612.2016
*/

require_once('../headfiles/backend_classes_h.php');

$language = $_POST['lcode'];
$search = $_POST['search'];

// echo $language;
// echo $search;
//Execution codes:
$q = new Query;
echo "<h1>Search</h1>";
$results = $q->search($search, $language);

echo '
<div id="SearchResult">
<table id="SearchTable">
  <tr>
    <th>Book Title</th>
    <th>Author</th>
    <th>Genre</th>
    <th>Release</th>
    <th>Update</th>
  </tr>';

foreach($results as $row)
	{
			echo $row->toHTMLTableRow();
	}

echo "
</table>
</div>";
?>
</body>
</html>
