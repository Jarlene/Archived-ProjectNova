<?php
/* 
    Sample Query class usage demo

	Author: Phoenix
    Version: 0613.2016
*/

include_once "pdo_h.php";
include_once "backend_classes_h.php";
include_once "frontend_classes_h.php";

// Execution codes:
$q = new Query;
echo "<h1>Search</h1>";
$results = $q->search( '劉慈欣', 'eng');
foreach($results as $row)
	{
		echo '<br>';
		var_dump($row);
		echo '<br>';

		echo $row->toHTMLTableRow();
	}


echo "<h1>getBook</h1>";
$obj = $q->getBook('The_Three_Body_Novels', 'zho');
var_dump($obj);
echo $obj->toHTMLDivision();

echo "<h1>getAuthor</h1>";
$obj = $q->getAuthor('Liu_Cixin', 'jpn');
var_dump($obj);
echo $obj->toHTMLDivision();


echo "<h1>getBookLinks</h1>";
$results =  $q->getBookLinks('The_Three_Body_Novels', 'eng');
foreach($results as $row)
	{
		var_dump($row);
		echo '<br /> <br />';

		echo $row->toHTMLTableRow();
	}


echo "<h1>getBookComments</h1>";
$results =  $q->getBookComments('The_Three_Body_Novels');
foreach($results as $row)
	{
		echo '<br>';
		var_dump($row);
		echo '<br>';
		echo $row->toHTMLTableRow();
	}

echo "<h1>getAuthorComments</h1>";
$results =  $q->getAuthorComments('Liu_Cixin');
foreach($results as $row)
	{
		echo '<br>';
		var_dump($row);
		echo '<br>';
		echo $row->toHTMLTableRow();
	}


echo "<h1>Check FavBook</h1>";
$r =  $q->isFavBook('adam','The_Three_Body_Novels');
var_dump($r);


echo "<h1>Check FavAuthor</h1>";
$r =  $q->isFavAuthor('adam','Nagatsuki_Tappei');
var_dump($r);

echo "<h1>Change FavBook</h1>";
$r =  $q->changeFavBook('adam','The_Three_Body_Novels');
var_dump($r);

echo "<h1>Change FavAuthor</h1>";
$r =  $q->changeFavAuthor('adam','Nagatsuki_Tappei');
var_dump($r);
?>
