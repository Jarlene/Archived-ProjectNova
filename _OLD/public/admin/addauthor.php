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
    <form method="post" action="addauthor.handle.php" style="margin:5px 500px;">

            <h3>Add a new author</h3>
        <div class="control-group">
              <label class="control-label">Author ID</label>
              <div class="controls">
                <input type="text" name="aid" id="aid"/>
                <p class="help-block"></p>
              </div>
        </div>
        <div class="control-group">
              <label class="control-label">Languages</label>
              <div class="controls">
                <select name="language">
                                          <?php
                                            require_once('../../headfiles/connect.php');
                                            $query = "select distinct LCode from Languages";
                                            $result = mysqli_query($connect, $query);
                                            //var_dump($result);
                                            while ($arr = mysqli_fetch_array($result)){
                                              echo '<option value="'.$arr['LCode'].'">'.$arr["LCode"].'</option>';
                                            }
                                          ?>
                　　                     </select>
                <p class="help-block"></p>
              </div>
        </div>
        <div class="control-group">
              <label class="control-label">Author Name</label>
              <div class="controls">
                <input type="text" name="aname" id="aname"/>
                <p class="help-block"></p>
              </div>
        </div>
        <div class="control-group">
              <label class="control-label">Author Description</label>
              <div class="controls">
                <textarea cols=40 rows=3 name="adesc"></textarea>
                <p class="help-block"></p>
              </div>
        </div>
        <div class="submit">
             <input type="submit" value="submit"/>
        </div>
    </form>
</body>
</html>
