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
</head>

<?php
require_once('test.php');
?>

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

require_once('../headfiles/backend_classes_h.php');

$language = $_POST['lcode'];
$search = $_POST['search'];

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
