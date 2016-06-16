<!DOCTYPE html>
<html lang="ja-jp">
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
        <h4>小説情報:</h4>
        <?php
            echo $obj->toHTMLDivisionJPN();
        ?>
      </div>
      <hr>
      <p>
        <!-- Language Dropdown Here     -->
        <div id='langDropDowns'>
          <h3> 他の言語バージョンを見ます: </h3>
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
          <input type="submit" name="submit" value="操作" />
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
                      <strong>Warning!</strong> 不明なエラーコ, 操作は失敗します...
                    </div>';
            }else{
              if ($favorstate1==false) {
                echo '<div class="alert alert-success">
                        <strong>Success!</strong> お気に入り追加成功.
                      </div>';
              }else {echo '<div class="alert alert-success">
                              <strong>Success!</strong> お気に入りは正常に削除します.
                            </div>';}}
          }
        } else {
          echo '<div class="alert alert-warning">
                  <strong>Warning!</strong> お気に入り機能を使用するにはログインしてください。
                </div>';
        }
        
      ?>
      <form name="bookmarkForm" action="#" method="post">
        <input type="submit" name="favor" value="お気に入りの追加/削除" />
      </form>
    </div>

    <hr>

    <div class="well well-lg" id="BookLinks">
      <table class="table table-striped" id="BookLinksTable">
        <caption>関連リンク:</caption>
        <thead>
          <tr>
            <th>タイプ</th>
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
          <caption> コメント: </caption>
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
        <h5>コメントを追加:</h5>
        <form action="" method="post">
          <textarea name="comment" style="width:100%;height:60px;">コメントを入力してください</textarea>
          <input type="submit" value="追加" />
        </form>
        <?php
          if(isset($_POST['comment'])){
            $status=$q->addBookComment($BID,$_POST["comment"]);
            if(!$status){
              echo "コメント追加 エラー！";
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