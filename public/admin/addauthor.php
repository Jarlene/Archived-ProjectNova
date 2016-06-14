
<html lang="en">
 <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>Insert title here</title>
</head>
<body bgcolor="#ccc">

    <form id="form1" name="form1" method="post" action="addauthor.handle.php" style="margin:5px 500px;">
            <h1>Add a new author</h1>
        Author ID:             <input type="text" name="aid" id="aid"/><br/>
        Language:              <select name="language">
                                  <?php
                                    require_once('/../../headfiles/connect.php');
                                    $query = "select distinct LCode from Languages";
                                    $result = mysqli_query($connect, $query);
                                    //var_dump($result);
                                    while ($arr = mysqli_fetch_array($result)){
                                      echo '<option value="'.$arr['LCode'].'">'.$arr["LCode"].'</option>';
                                    }
                                  ?>
        　　                     </select><br/>
        Author Name:           <input type="text" name="aname" id="aname"/><br/>
        Author Descroption   : <textarea cols=40 rows=3 name="adesc"></textarea><br/><br/>
             <input type="submit" value="submit"/>
    </form>
</body>
</html>
