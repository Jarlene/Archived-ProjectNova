<!DOCTYPE html>
<!--     This is a sample file to demostrate the useage of the front end classes.
    All datas here are hardcoded, and not from querying the database.
    Another back end class head file will cover the functionalities in data querying.

    Author: Phoenix
    Version: 0611.2016

    Classes Index:
        - SearchResult: Represent a single row in the search results
        - BookDetail: Represent a book with all information needed for a Book Detail Page, EXCEPT LINKS AND COMMENTS.
        - BookLink: Represent a single row of the links for the book.
        - AuthorDetail: Represent an author with all information needed for an Author Detail Page, EXCEPT COMMENTS.
        - Commnet: Represent a single comment for a book or an author. -->
<html>
<head>
<meta charset="UTF-8"> 
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    text-align: center;
}
th, td {
    padding: 5px;
}
</style>
</head>
<body>
<!-- * Demo Starting Here * -->

<!-- SearchResult Demo -->
<div id="SearchResult">
<h1> Search Result Demo:</h1>
<table id="SearchTable">
  <tr>
    <th>Book Title</th>
    <th>Author</th>
    <th>Genre</th>
    <th>Release</th>
    <th>Update</th>
  </tr>

<?php
  include_once 'frontend_classes_h.php';

  $results = array(new SearchResult, new SearchResult, new SearchResult);
  // Filling Dummy Datas for sample purpose
  foreach ($results as $i => $r) {
    $r->BID = 'BID'.$i;
    $r->BName = 'BName'.$i;
    $r->AID = 'AID'.$i;
    $r->AName = 'AName'.$i;
    $r->LCode = 'LCode'.$i;
    $r->GCode = 'GCode'.$i;
    $r->GName = 'GName'.$i;
    $r->BRelease = 'BRelease'.$i;
    $r->BUpdate = 'BUpdate'.$i;
  }
  // Genarate table rows
  foreach ($results as $r) {
    echo $r->toHTMLTableRow();
  }
?>
</table>
</div>
<!-- End of SearchResult Demo -->
<br><br>

<br><br>
<!-- BookDetail Demo -->
<h1> BookDetail Demo:</h1>
<div id="BookDetail">
<?php
  include_once 'frontend_classes_h.php';

  $r = new BookDetail;
  // Filling Dummy Datas for sample purpose
    $r->BID = 'thisBID';
    $r->BName = 'thisBName';
    $r->AID = 'thisAID';
    $r->AName = 'thisAName';
    $r->LCode = 'thisLCode';
    $r->GCode = 'thisGCode';
    $r->GName = 'thisGName';
    $r->ORelease = 'thisORelease';
    $r->BRelease = 'thisBRelease';
    $r->WCount = 'thisWCount';
    $r->BUpdate = 'thisBUpdate';
    $r->BDesc = 'thisBDesc';

  // Genarate division views
    echo $r->toHTMLDivision();

  // Request URL for Other language
    echo '<br><h4>Samele URL Request for version in other language:</h4>';
    echo $r->getDetailsInOtherLanguageVersion('jpn');
?>
</div>
<!-- End of BookDetail Demo -->
<br><br>

<br><br>
<!-- BookLink Demo -->
<div id="BookLink">
<h1> BookLink Demo:</h1>
<table id="BookLinksTable">
  <caption>Related Links</caption>
  <tr>
    <th>Type</th>
    <th>URL</th>
  </tr>

<?php
  include_once 'frontend_classes_h.php';

  $results = array(new BookLink, new BookLink, new BookLink);
  // Filling Dummy Datas for sample purpose
  foreach ($results as $i => $r) {
    $r->URL = 'https://www.google.com';
    $r->LType = 'LType'.$i;
  }
  // Genarate table rows
  foreach ($results as $r) {
    echo $r->toHTMLTableRow();
  }
?>
</table>
</div>
<!-- End of BookLink Demo -->
<br><br>

<br><br>
<!-- AuthorDetail Demo -->
<h1> AuthorDetail Demo:</h1>
<div id="AuthorDetail">
<?php
  include_once 'frontend_classes_h.php';

  $r = new AuthorDetail;
  // Filling Dummy Datas for sample purpose
    $r->AID = 'AID';
    $r->AName = 'AName';
    $r->LCode = 'LCode';
    $r->ADesc = 'ADesc';

  // Genarate division views
    echo $r->toHTMLDivision();
  
  // Request URL for Other language
    echo '<br><h4>Samele URL Request for version in other language:</h4>';
    echo $r->getDetailsInOtherLanguageVersion('jpn');
?>
</div>
<!-- End of AuthorDetail Demo -->
<br><br>

<br><br>
<!-- COMMENTS Demo -->
<div id="Comments">
<h1> Comments Demo:</h1>
<table id="Comments Table">
  <caption>Comments</caption>
<?php
  include_once 'frontend_classes_h.php';

  $results = array(new Comment, new Comment, new Comment);
  // Filling Dummy Datas for sample purpose
  foreach ($results as $i => $r) {
    $r->timeStamp = '2016-06-06 06:06';
    $r->Content = '这TM就是一句废话。。。。'.$i;
  }
  // Genarate table rows
  foreach ($results as $r) {
    echo $r->toHTMLTableRow();
  }
?>
</table>
</div>
<!-- End of COMMENTS Demo -->
<br><br>
</body>
</html>