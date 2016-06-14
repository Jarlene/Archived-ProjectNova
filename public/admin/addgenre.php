<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">

<body bgcolor="#ccc">

    <form id="form1" name="form1" method="post" action="addgenre.handle.php" style="margin:5px 500px;">
            <h1>Add a new genre</h1>
        GCode:          <input type="text" name="gcode" id="gcode"/><br/>
        Language:       <select name="lcode">
                          <?php
                            require_once('../../headfiles/connect.php');
                            $query = "select distinct LCode from Languages";
                            $result = mysqli_query($connect, $query);
                            //var_dump($result);
                            while ($arr = mysqli_fetch_array($result)){
                              echo '<option value="'.$arr['LCode'].'">'.$arr["LCode"].'</option>';
                            }
                          ?>
        　　              </select><br/>
        Genre Name:     <input type="text" name="gname" id="gname"/><br/>
        Genre Link:     <textarea cols=40 rows=2 name="glink"></textarea><br/><br/>
             <input type="submit" value="submit"/>
    </form>

</body>
</html>
