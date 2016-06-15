<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Welcome to nova!</title>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>

<?php
require_once('test.php');
?>

<body>
<div class="container" id = 'main'>
  <div class="search">
    <div class="signin-head"><img src="images/test/touxiang.jpeg" alt="" class="img-circle"></div>
    <form  role="form" name="form" action="search.handler.php" method="post">
      <input type="text" class="form-control" name="search" id="search" required autofocus />
      <button class="btn btn-lg btn-warning btn-block" type="submit">Search</button>
    </form>
  </div>

  <div class="well well-lg"  id = 'SearchResults'>
     <div class="page-header" id = 'SearchResultsTitle'>
      <h2> Result:</h2>
    </div>
    <div class="row"  id = 'resultsTables'>
      <table class ="table table-striped" id="ResultTable">
        <thead>
          <tr>
            <th>Book Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Release</th>
            <th>Update</th>
          </tr>
        </thead>
        <tbody>
         <!-- Generate table data here -->
          <?php
          require_once('../headfiles/backend_classes_h.php');
          $language = $_COOKIE['lang'];
          $search = $_POST['search'];
          $q = new Query;
          $results = $q->search($search, $language);

          foreach($results as $row)
                echo $row->toHTMLTableRow();
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
