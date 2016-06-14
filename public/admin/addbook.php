<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<body bgcolor="#ccc">
    <form id="form1" name="form1" method="post" action="addbook.handle.php" style="margin:5px 500px;">
            <h1>Add a new book</h1>
        Book ID:       <input type="text" name="bid" id="bid"/><br/>
        Author ID:     <select name="aid">
                          <?php
                            require_once('../../headfiles/connect.php');
                            $query = "select distinct AID from Authors";
                            $result = mysqli_query($connect, $query);
                            //var_dump($result);
                            while ($arr = mysqli_fetch_array($result)){
                              echo '<option value="'.$arr['AID'].'">'.$arr["AID"].'</option>';
                            }
                          ?>
        　　            </select><br/>
        Genre:         <select name="gcode">
                          <?php
                            require_once('../../headfiles/connect.php');
                            $query = "select distinct GCode from Genres";
                            $result = mysqli_query($connect, $query);
                            //var_dump($result);
                            while ($arr = mysqli_fetch_array($result)){
                              echo '<option value="'.$arr['GCode'].'">'.$arr["GCode"].'</option>';
                            }
                          ?>
        　　              </select><br/>
        ORelease DATE: <input type="date" name="orelease" id="orelease"/><br/>
        Clicks DATE:   <input type="int" name="clicks" id="clicks"/><br/>
        Rating:        <input type="int" name="rating" id="rating"/><br/>
             <input type="submit" value="submit"/>
    </form>

</body>
</html>
