
<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">

<body bgcolor="#ccc">

    <form id="form1" name="form1" method="post" action="updateauthor.handler.php" style="margin:5px 500px;">
            <h1>Update an author</h1>
        Author ID:             <input type="text" name="aid"
                                  value=<?php
                                          require_once('../../headfiles/connect.php');
                                          $aid = $_GET['aid'];
                                          // echo $bid;

                                          $queryid = "select aid from authors where aid = '$aid'";
                                          //echo $queryid;
                                          $resultid = mysqli_query($connect,$queryid);
                                          $arr = mysqli_fetch_array($resultid);
                                          echo $arr[0];
                                        ?>
                                 id="aid"/><br/>
        Language:              <input type="text" name="language"
                                  value=<?php
                                          $language = $_GET['lcode'];
                                          echo $language;
                                        ?>
                                 id="aid"/><br/>
        Author Name:           <input type="text" name="aname" id="aname" required/><br/>
        Author Descroption   : <textarea cols=40 rows=3 name="adesc"></textarea><br/><br/>
                               <input type="submit" value="submit"/>
    </form>
</body>
</html>
