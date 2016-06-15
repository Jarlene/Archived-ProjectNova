<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book: <?php echo $_GET["bid"] ?></title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>


<?php
  require_once "test.php";
  require_once "../headfiles/backend_classes_h.php";

  $language =$_GET["lcode"];
  if(isset($_POST['submit'])){
    $language = $_POST['lang'];
  }

  $q = new Query;
  $BID=$_GET["bid"];
  $obj = $q->getBook($BID,$language);
  $links =  $q->getBookLinks($BID, $language);
  $comments = $q->getBookComments($BID);

  // Update user history
  if ($obj->BID != '-'){
    $user = null;
    if(isset($_COOKIE['user'])){
        $user = $_COOKIE['user'];}
    $q->viewBook($BID,$user);
  }
?>

<body>
  <div class="container text-center" id = 'main'>
    <div class="jumbotron" id = 'BookInfos'>
      <div id="BookDetail">
        <h4>Book Information:</h4>
        <?php
            echo $obj->toHTMLDivision();
        ?>
      </div>
      <hr>
      <p>
        <!-- Language Dropdown Here     -->
        <div id='langDropDowns'>
          <h3>View in other Language: </h3>
          <form action="#" method="post">
          <select name="lang">
           <?php
            require_once('../headfiles/pdo_h.php');
            try{$dbh = _db_connect();
            $stmt = $dbh->prepare("SELECT DISTINCT * from Languages");
            $stmt->execute();
            _db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

            $result = $stmt->fetchAll();
            foreach ($result as $v) {
              echo '<option value="'.$v['LCode'].'">'.$v["LName"].'</option>';
            }
          ?>
          </select>
          <input type="submit" name="submit" value="submit" />
          </form>
        </div>
      </p>
    </div>

    <hr>

    <div class="well text-center" id="AddBookMark">
      <?php
        if(isValidUser()){
          if(isset($_POST['favor'])){
            $favorstate1=$q->isFavBook($_COOKIE['user'],$BID);
            $q->changeFavBook($_COOKIE['user'],$BID);
            $favorstate2=$q->isFavBook($_COOKIE['user'],$BID);
            if($favorstate1==$favorstate2){
              echo '<div class="alert alert-warning">
                      <strong>Warning!</strong> Bookmark operation unsuccessful, somthing goes wrong...
                    </div>';
            }else{
              if ($favorstate1==false) {
                echo '<div class="alert alert-success">
                        <strong>Success!</strong> You have bookmarked this book.
                      </div>';
              }else {echo '<div class="alert alert-success">
                              <strong>Success!</strong> You have removed the bookmark for this book.
                            </div>';}}
          }
        } else {
          echo '<div class="alert alert-warning">
                  <strong>Warning!</strong> You have to log in first to use bookmarks.
                </div>';
        }
        
      ?>
      <form name="bookmarkForm" action="#" method="post">
        <input type="submit" name="favor" value="add or delete favoriate" />
      </form>
    </div>

    <hr>

    <div class="well well-lg" id="BookLinks">
      <table class="table table-striped" id="BookLinksTable">
        <caption>Available Links:</caption>
        <thead>
          <tr>
            <th>Type</th>
            <th>URL</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($links as $r)
              echo $r->toHTMLTableRow();
          ?>
        </tbody>
      </table>
    </div>

    <hr>

    <div class="container" id="commentsBlock">
      <div class="well well-lg" id="BookComments">
        <table class="table" id="BookLinksTable">
          <caption> Commments: </caption>
          <tbody>
          <?php
          foreach ($comments as $r){
              echo $r->toHTMLTableRow();
          }
          ?>
          </tbody>>
        </table>
      </div>
      <div class="well well-lg" id="AddComments">
        <h5>Write new comment:</h5>
        <form action="" method="post">
          <textarea name="comment" style="width:100%;height:60px;">Enter your comment</textarea>
          <input type="submit" value="Submit" />
        </form>
        <?php
          if(isset($_POST['comment'])){
            $status=$q->addBookComment($BID,$_POST["comment"]);
            if(!$status){
              echo "upload comments error";
            }else{
              echo '<meta http-equiv="refresh" content="0" />';
            }
          }
        ?>
      </div>
    </div>
  </div>
</body>
</html>