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
    <form method="post" action="updatebook.handler.php" style="margin:5px 500px;">

      <h3>Update a new book</h3>
      <div class="control-group">
            <label class="control-label">Book ID</label>
            <div class="controls">
              <input type="text" name="bid"
                                value=<?php
                                        require_once('../../headfiles/connect.php');
                                        $bid = $_GET['bid'];
                                        $queryid = "select BID from Books where BID = '$bid'";
                                        $resultid = mysqli_query($connect,$queryid);
                                        $arr = mysqli_fetch_array($resultid);
                                        echo $arr[0];
                                      ?>
                               id="bid"/>
              <p class="help-block"></p>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label">Author ID</label>
            <div class="controls">
              <select name="aid">
                  <?php
                    require_once('../../headfiles/connect.php');
                    $query = "select distinct AID from Authors";
                    $result = mysqli_query($connect, $query);
                    while ($arr = mysqli_fetch_array($result)){
                    echo '<option value="'.$arr['AID'].'">'.$arr["AID"].'</option>';}
                  ?>
              </select>
            <p class="help-block"></p>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label">Genre</label>
            <div class="controls">
              <select name="gcode">
                  <?php
                    require_once('../../headfiles/connect.php');
                    $query = "select distinct GCode from Genres";
                    $result = mysqli_query($connect, $query);
                    while ($arr = mysqli_fetch_array($result)){
                    echo '<option value="'.$arr['GCode'].'">'.$arr["GCode"].'</option>';}
                  ?>
              </select>
            <p class="help-block"></p>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label">ORelease DATE</label>
            <div class="controls">
              <input type="date" name="orelease" id="orelease"/>
              <p class="help-block"></p>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label">Clicks DATE</label>
            <div class="controls">
              <input type="int" name="clicks" id="clicks"/>
              <p class="help-block"></p>
            </div>
      </div>
      <div class="control-group">
            <label class="control-label">Rating</label>
            <div class="controls">
              <input type="int" name="rating" id="rating"/>
              <p class="help-block"></p>
            </div>
      </div>
      <div class="submit">
           <input type="submit" value="submit"/>
      </div>
    </form>

</body>
</html>
