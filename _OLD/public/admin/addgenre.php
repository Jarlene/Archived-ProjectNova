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
    <form method="post" action="addgenre.handle.php" style="margin:5px 500px;">
            <h3>Add a new genre</h3>
        <div class="control-group">
              <label class="control-label">GCode</label>
              <div class="controls">
                <input type="text" name="gcode" id="gcode"/>
                <p class="help-block"></p>
              </div>
        </div>
        <div class="control-group">
              <label class="control-label">GCode</label>
              <div class="controls">
                <select name="lcode">
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
              <label class="control-label">Genre Name</label>
              <div class="controls">
                <input type="text" name="gname" id="gname"/>
                <p class="help-block"></p>
              </div>
        </div>
        <div class="control-group">
              <label class="control-label">Genre Link</label>
              <div class="controls">
                <textarea cols=40 rows=2 name="glink"></textarea>
                <p class="help-block"></p>
              </div>
        </div>
        <input type="submit" value="submit"/>
    </form>

</body>
</html>
