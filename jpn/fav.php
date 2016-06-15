<!DOCTYPE html>
<html lang="ja-jp">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to nova!</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<?php
require_once "test.php";
yeildIfInvalidUser();
?>

<body>
<div class="container" id = 'main'>
  <div class="well well-lg"  id = 'Favs'>
    <div class="page-header" id = 'FavTitle'>
      <?php
      echo "<h1>ようこそ, ". $_COOKIE['user'] ."! ここでは、あなたの好きな著者と小説です! </h1> <br>";
      ?>
    </div>

    <div class="row"  id = 'FavTables'>
      <div class="col-sm-8"  id = 'FavoriteBooksDiv'>
        <h3>小説:</h3>
        <table class ="table table-striped" id="FAVBooksTable">
          <!-- <cpation> Your favorate books:</cpation> -->
          <thead>
            <tr>
              <th>タイトル</th>
              <th>著者</th>
              <th>お気に入りの時間</th>
            </tr>
          </thead>
          <tbody>
            <!-- Generate table data here -->
            <?php
              require_once('../headfiles/backend_classes_h.php');
              $q = new Query;
              $results = $q->getFavBooks($_COOKIE['user'], $_COOKIE['lang']);
              foreach ($results as $r) {
                echo $r->toHTMLTableRow();
              }
            ?>
          </tbody>
        </table>
      </div>

      <div class="col-sm-4"  id = 'FavoriteAuthorsDiv'>
        <h3>作者:</h3>
        <table class ="table table-striped" id="FAVAuthorsTable">
          <!-- <cpation> Your favorate Authors:</cpation> -->
          <thead>
            <tr>
              <th>著者</th>
              <th>お気に入りの時間</th>
            </tr>
          </thead>
          <tbody>
            <!-- Generate table data here -->
            <?php
              require_once('../headfiles/backend_classes_h.php');
              $q = new Query;
              $results = $q->getFavAuthors($_COOKIE['user'], $_COOKIE['lang']);
              foreach ($results as $r) {
                echo $r->toHTMLTableRow();
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="well well-lg"  id = 'History'>
    <div class="page-header" id = 'HistoryTitle'>
      <h1> 閲覧履歴: </h1> <br>
    </div>
    <div class="row"  id = 'HisTables'>
      <div class="col-sm-8"  id = 'HSBooksDiv'>
        <h3>小説:</h3>
        <table class ="table table-striped" id="HSBooksTable">
          <!-- <cpation> Books you have checked:</cpation> -->
          <thead>
            <tr>
              <th>タイトル</th>
              <th>著者</th>
              <th>最後の訪問</th>
            </tr>
          </thead>
          <tbody>
            <!-- Generate table data here -->
            <?php
              require_once('../headfiles/backend_classes_h.php');
              $q = new Query;
              $results = $q->getBookVisitHistory($_COOKIE['user'], $_COOKIE['lang']);
              foreach ($results as $r) {
                echo $r->toHTMLTableRow();
              }
            ?>
          </tbody>
        </table>
      </div>

      <div class="col-sm-4"  id = 'HSAuthorsDiv'>
        <h3>著者:</h3>
        <table class ="table table-striped" id="HSAuthorsTable">
          <!-- <cpation> Authors you have checked:</cpation> -->
          <thead>
            <tr>
              <th>著者</th>
              <th>最後の訪問</th>
            </tr>
          </thead>
          <tbody>
            <!-- Generate table data here -->
            <?php
              require_once('../headfiles/backend_classes_h.php');
              $q = new Query;
              $results = $q->getAuthorVisitHistory($_COOKIE['user'], $_COOKIE['lang']);
              foreach ($results as $r) {
                echo $r->toHTMLTableRow();
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</body>
</html>
