<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">

<body bgcolor="#ccc">

    <form id="form1" name="form1" method="post" action="addlink.handle.php" style="margin:5px 500px;">
            <h1>Add a new genre</h1>
        URL:            <textarea cols=40 rows=2 name="url"></textarea><br/><br/>
        LType:          <textarea cols=40 rows=5 name="ltype"></textarea><br/><br/>
        Book ID:       <select name="bid">
                          <?php
                            require_once('../connect.php');
                            $query = "select distinct BID from Books";
                            $result = mysqli_query($connect, $query);
                            //var_dump($result);
                            while ($arr = mysqli_fetch_array($result)){
                              echo '<option value="'.$arr['BID'].'">'.$arr["BID"].'</option>';
                            }
                          ?>
        　　            </select><br/>
        Language:      <select name="lcode">
                          <?php
                            require_once('../connect.php');
                            $query = "select distinct LCode from Languages";
                            $result = mysqli_query($connect, $query);
                            //var_dump($result);
                            while ($arr = mysqli_fetch_array($result)){
                              echo '<option value="'.$arr['LCode'].'">'.$arr["LCode"].'</option>';
                            }
                          ?>
        　　            </select><br/>
             <input type="submit" value="submit"/>
    </form>

</body>
</html>
