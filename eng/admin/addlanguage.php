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
    <form method="post" action="addlanguage.handle.php" style="margin:5px 500px;">
            <h3>Add a new language</h3>
        <div class="control-group">
              <label class="control-label">Language Code</label>
              <div class="controls">
                <input type="text" name="lcode" id="lcode"/>
                <p class="help-block"></p>
              </div>
        </div>
        <div class="control-group">
              <label class="control-label">Language</label>
              <div class="controls">
                <input type="text" name="lname" id="lname"/>
                <p class="help-block"></p>
              </div>
        </div>
        <div class="control-group">
              <label class="control-label">Home Page</label>
              <div class="controls">
                <textarea cols=40 rows=2 name="hpage"></textarea>
                <p class="help-block"></p>
              </div>
        </div>
         <input type="submit" value="submit"/>
    </form>
</body>
</html>
