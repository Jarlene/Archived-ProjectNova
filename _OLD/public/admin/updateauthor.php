<?php
  require_once("navbar.php");
 ?>
<html lang="en">
<head>
		<meta charset="utf-8">
		<link href="../css/style.css" rel='stylesheet' type='text/css' />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/signin.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <form method="post" action="updateauthor.handler.php" style="margin:5px 500px;">

            <h3>Update a new author</h3>
        <div class="control-group">
              <label class="control-label">Author ID</label>
              <div class="controls">
                <input type="text" name="aid"
                  value=<?php
                  require_once('../../headfiles/connect.php');
                  $aid = $_GET['aid'];
                  $queryid = "select aid from authors where aid = '$aid'";
                  $resultid = mysqli_query($connect,$queryid);
                  $arr = mysqli_fetch_array($resultid);
                  echo $arr[0];
                  ?>
                  id="aid"/>
                <p class="help-block"></p>
              </div>
        </div>
        <div class="control-group">
              <label class="control-label">Language</label>
              <div class="controls">
                <input type="text" name="language"
                  value=<?php
                    $language = $_GET['lcode'];
                    echo $language;
                  ?>
                   id="aid"/>
                <p class="help-block"></p>
              </div>
        </div>
        <div class="control-group">
              <label class="control-label">Author Name</label>
              <div class="controls">
                <input type="text" name="aname" id="aname" required/>
                <p class="help-block"></p>
              </div>
        </div>
        <div class="control-group">
              <label class="control-label">Author Descroption</label>
              <div class="controls">
                <textarea cols=40 rows=3 name="adesc"></textarea>
                <p class="help-block"></p>
              </div>
        </div>
        <input type="submit" value="submit"/>
    </form>
</body>
</html>
