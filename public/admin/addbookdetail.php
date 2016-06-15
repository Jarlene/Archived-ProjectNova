<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<body bgcolor="#ccc">
    <form id="form1" name="form1" method="post" action="addbookdetail.handle.php" style="margin:5px 500px;">
            <h1>Add a new bookdetail</h1>
        Book ID:       <select name="bid">
                          <?php
                            require_once('../../headfiles/connect.php');
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
                            require_once('../../headfiles/connect.php');
                            $query = "select distinct LCode from Languages";
                            $result = mysqli_query($connect, $query);
                            //var_dump($result);
                            while ($arr = mysqli_fetch_array($result)){
                              echo '<option value="'.$arr['LCode'].'">'.$arr["LCode"].'</option>';
                            }
                          ?>
        　　            </select><br/>
        Book Name:     <input type="text" name="bname" id="bname"/><br/>
        BRelease:      <input type="date" name="brelease" id="brelease"/><br/>
        WCount:        <input type="int" name="wcount" id="wcount"/><br/>
        BUpdate:       <input type="date" name="bupdate" id="bupdate"/><br/>
        Book description:
                       <textarea cols=40 rows=2 name="bdesc"></textarea><br/><br/>
             <input type="submit" value="submit"/>
    </form>

</body>
</html>
