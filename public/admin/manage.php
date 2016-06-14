<html lang="en">
<head>
  <title>Bootstrap Case</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Project Nova</a>
    </div>

    <ul class="nav navbar-nav">

      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Add <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="addauthor.php">Add authors</a></li>
          <li><a href="addbookdetail.php">Add bookdetails</a></li>
          <li><a href="addbook.php">Add books</a></li>
          <li><a href="addgenre.php">Add genres</a></li>
          <li><a href="addlink.php">Add links</a></li>
        </ul>
      </li>

    </ul>
  </div>
</nav>

<?php
  require_once('../../headfiles/connect.php');
  $books = "select * from Books order by BID desc";
  $querybooks = mysqli_query($connect, $books);
  //var_dump($query);

  if($querybooks){
    while ($booksrow = mysqli_fetch_assoc($querybooks)) {
      $bookdata[] = $booksrow;
    }
  } else {
    $bookdata = array();
  }

  $authors = "select * from Authors order by AID desc";
  $queryauthors = mysqli_query($connect, $authors);
  //var_dump($queryauthors);

  if($queryauthors){
    while ($authorsrow = mysqli_fetch_assoc($queryauthors)) {
      $authordata[] = $authorsrow;
    }
  } else {
    $authordata = array();
  }
  ?>
  <table width="100%" height="520" border="0" cellpadding="8" cellspacing="1" bgcolor="#000000">
    <tr>
        <tr>
          <td colspan="3" align="center" bgcolor="#FFFFFF">Books list</td>
        </tr>
        <tr align="center">
          <td width="572" bgcolor="#FFFFFF">Title</td>
          <td width="82" bgcolor="#FFFFFF">Action</td>
        </tr>
    <?php
      if(!empty($bookdata)){
        foreach($bookdata as $value){
    ?>
        <tr align="center">
          <td bgcolor="#FFFFFF">&nbsp;<?php echo $value['BID']?></td>
          <td bgcolor="#FFFFFF">
              <a href="deletebook.handler.php?bid=<?php echo $value['BID']?>">Delete</a>
              <a href="updatebook.php?bid=<?php echo $value['BID']?>">Modify</a>
            </td>
        </tr>
          <?php
              }
            }
          ?>
    </table>
    <table width="100%" height="520" border="0" cellpadding="8" cellspacing="1" bgcolor="#000000">
      <tr>
          <tr>
            <td colspan="3" align="center" bgcolor="#FFFFFF">Authors list</td>
          </tr>
          <tr align="center">
            <td width="572" bgcolor="#FFFFFF">Author Name</td>
            <td width="572" bgcolor="#FFFFFF">Language Code</td>
            <td width="82" bgcolor="#FFFFFF">Action</td>
          </tr>
      <?php
        if(!empty($authordata)){
          foreach($authordata as $value2){
      ?>
          <tr align="center">
            <td bgcolor="#FFFFFF">&nbsp;<?php echo $value2['AID']?></td>
            <td bgcolor="#FFFFFF">&nbsp;<?php echo $value2['LCode']?></td>
            <td bgcolor="#FFFFFF">
                <a href="deleteauthor.handler.php?aid=<?php echo $value2['AID']?>&lcode=<?php echo $value2['LCode']?>"&>Delete</a>
                <a href="updateauthor.php?aid=<?php echo $value2['AID']?>&lcode=<?php echo $value2['LCode']?>">Modify</a>
              </td>
          </tr>
            <?php
                }
              }
            ?>
      </table>
</body>
</html>
