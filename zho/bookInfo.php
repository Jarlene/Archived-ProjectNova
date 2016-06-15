<!DOCTYPE html>
<html lang="zh-cn">
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
  <div class="container" id = 'main'>
    <div class="jumbotron" id = 'BookInfos'>
      <div id="BookDetail">
        <h4>小说信息:</h4>
        <?php
            echo $obj->toHTMLDivisionZHO();
        ?>
      </div>
      <hr>
      <p>
        <!-- Language Dropdown Here     -->
        <div id='langDropDowns'>
          <h3> 察看其他语言版本: </h3>
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

    <div class="well" id="AddBookMark">
      <?php
        if(isValidUser()){
          if(isset($_POST['favor'])){
            $favorstate1=$q->isFavBook($_COOKIE['user'],$BID);
            $q->changeFavBook($_COOKIE['user'],$BID);
            $favorstate2=$q->isFavBook($_COOKIE['user'],$BID);
            if($favorstate1==$favorstate2){
              echo '<div class="alert alert-warning">
                      <strong>Warning!</strong> 未知错误，收藏操作失败...
                    </div>';
            }else{
              if ($favorstate1==false) {
                echo '<div class="alert alert-success">
                        <strong>Success!</strong> 成功收藏此书.
                      </div>';
              }else {echo '<div class="alert alert-success">
                              <strong>Success!</strong> 成功移除收藏.
                            </div>';}}
          }
        } else {
          echo '<div class="alert alert-warning">
                  <strong>Warning!</strong> 登陆后才能使用收藏功能.
                </div>';
        }
        
      ?>
      <form name="bookmarkForm" action="#" method="post">
        <input type="submit" name="favor" value="添加/移除收藏" />
      </form>
    </div>

    <hr>

    <div class="well well-lg" id="BookLinks">
      <table class="table table-striped" id="BookLinksTable">
        <caption>相关链接:</caption>
        <thead>
          <tr>
            <th>种类</th>
            <th>地址</th>
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
          <caption> 评论: </caption>
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
        <h5>添加一条新评论:</h5>
        <form action="" method="post">
          <textarea name="comment" style="width:100%;height:60px;">在此输入您的评论</textarea>
          <input type="submit" value="Submit" />
        </form>
        <?php
          if(isset($_POST['comment'])){
            $status=$q->addBookComment($BID,$_POST["comment"]);
            if(!$status){
              echo "添加评论出错！";
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