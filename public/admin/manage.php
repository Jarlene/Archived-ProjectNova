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

<<<<<<< Updated upstream
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="../index.php">Project Nova</a>
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
=======
>>>>>>> Stashed changes

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
  <table width="100%" height="520">
    <tr>
        <tr>
          <td colspan="3" align="center">Books list</td>
        </tr>
        <tr align="center">
          <td width="572">Title</td>
          <td width="82" >Action</td>
        </tr>
    <?php
      if(!empty($bookdata)){
        foreach($bookdata as $value){
    ?>
        <tr align="center">
          <td>&nbsp;<?php echo $value['BID']?></td>
          <td>
              <a href="deletebook.handler.php?bid=<?php echo $value['BID']?>">Delete</a>
              <a href="updatebook.php?bid=<?php echo $value['BID']?>">Modify</a>
            </td>
        </tr>
          <?php
              }
            }
          ?>
    </table>
    <table width="100%" height="520" border="0">
      <tr>
          <tr>
            <td colspan="3" align="center">Authors list</td>
          </tr>
          <tr align="center">
            <td width="400" >Author Name</td>
            <td width="400">Language Code</td>
            <td width="82">Action</td>
          </tr>
      <?php
        if(!empty($authordata)){
          foreach($authordata as $value2){
      ?>
          <tr align="center">
            <td>&nbsp;<?php echo $value2['AID']?></td>
            <td>&nbsp;<?php echo $value2['LCode']?></td>
            <td>
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
