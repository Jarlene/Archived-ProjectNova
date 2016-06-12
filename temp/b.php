<?php
/* 
    Sample PDO usage demo2:
	Serch Query,
	Besure to do all 3 steps when use, $dbh is the PDO object prepared.
	
	Author: Phoenix
    Version: 0611.2016
*/

/* 1. Import Connection head File */
include_once 'pdo_h.php';
include_once 'frontend_classes_h.php'; // The SearchResult Class had been moved to this head file.

class Query {

	// A helper function that removes all  $ and ; symbols and splits the input string into an array of 3 strings.
	// Argument:$str, an string
	// Return:	An array of strings with at most 3 elements.
    function qrStringToArray ($str) {
	    if (empty($str)) return false;
	    mb_internal_encoding("UTF-8");
	    $str = mb_ereg_replace('[;\$]','', $str);
	    $str = mb_strtolower($str);
	    $array = array_map('trim',mb_split(' ', $str, 3));
	    return $array;
	}
	
	// Query a standard search
	// Argument:$qr_string as the input string, can take upto 3 key words, splited by spaces
	// 			$lCode is the language code to display the results in.
	// Return:	An array of SearchResult objects.
	// Notes:	- The input string can be in any language, and the result shows only in the declared language.
	// 			- All $ and ; symbols in the string will be removed prior to the query for security reason, 
	public function search($qr_string, $lCode){
		$kwds = $this->qrStringToArray($qr_string);
		// *Connect to the database
		try{$dbh = _db_connect();

		$stmt = null;
		if (!$kwds){
			$stmt = $dbh->prepare(
				"SELECT b.BID,bd.BName,b.AID,a.AName,bd.LCode,b.GCode,g.GName,bd.BRelease,bd.BUpdate
				FROM Books b,BookDetails bd, Authors a, Genres g 
				Where b.BID = bd.BID AND b.AID = a.AID AND b.GCode = g.GCode AND bd.LCode = :lang AND a.LCode = :lang AND g.LCode = :lang 
				Order by bd.BName");
			$stmt->bindParam(':lang', $lCode);
			$stmt->execute();
		} else {
			$stmt = $dbh->prepare(
				"SELECT BID, BName, AID, AName, LCode, GCode, GName, BRelease, BUpdate
				From (  Select BID
						From BookDetails
						Where BName like :q1 AND BName like :q2 AND BName like :q3
						Union
						Select BID
						From Authors NATURAL JOIN Books
						Where AName like :q1 AND AName like :q2 AND AName like :q3) as x NATURAL JOIN BookDetails NATURAL JOIN Books NATURAL JOIN Authors NATURAL JOIN Genres
				Where LCode = :lang
				Order by BName");
			while (count($kwds) < 3)
				$kwds[] = '';
			$stmt->bindParam(':lang', $lCode);
			$stmt->execute(array(':q1' => "%$kwds[0]%", ':q2' => "%$kwds[1]%", ':q3' => "%$kwds[2]%", ':lang' => $lCode));
		}
		$stmt->setFetchMode(PDO::FETCH_INTO, new SearchResult);

		// *Disconnect from the database
		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		return $stmt;
	}

	// Query detailed information for a book
	// Argument:$BID, the BID of the Book
	// 			$lCode is the language code to display the results in.
	// Return:	An BookDetail objects.
	// Exception:	It returns bool(false) if the book is not in the database
	public function getBook($BID, $lCode){
		// *Connect to the database
		try{$dbh = _db_connect();

		$stmt = $dbh->prepare(
			"SELECT BID, BName, AID, AName, LCode, GCode, GName, ORelease, BRelease, WCount, BUpdate, BDesc
			FROM Books NATURAL JOIN Authors NATURAL JOIN Genres NATURAL JOIN BookDetails
			WHERE BID = :bid AND LCode = :lang");
		$stmt->bindParam(':bid', $BID);
		$stmt->bindParam(':lang', $lCode);
		$stmt->execute();

		// *Disconnect from the database
		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		return $stmt->fetchObject('BookDetail');
	}


	// Query detailed information for an author
	// Argument:$AID, the AID of the author
	// 			$lCode is the language code to display the results in.
	// Return:	An AuthorDetail objects.
	// Exception:	It returns bool(false) if the author is not in the database
	public function getAuthor($AID, $lCode){
		// *Connect to the database
		try{$dbh = _db_connect();

		$stmt = $dbh->prepare(
			"SELECT AID, AName, LCode, ADesc
			FROM Authors			
            WHERE AID = :aid AND LCode = :lang");
		$stmt->bindParam(':aid', $AID);
		$stmt->bindParam(':lang', $lCode);
		$stmt->execute();

		// *Disconnect from the database
		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		return $stmt->fetchObject('AuthorDetail');
	}

	// Query to get links for a book
	// Argument:$BID, the BID of the Book
	// 			$lCode is the language code to display the results in.
	// Return:	An array of BookLink objects.
	public function getBookLinks($BID, $lCode){
		// *Connect to the database
		try{$dbh = _db_connect();

		$stmt = $dbh->prepare(
			"SELECT URL, LType
			FROM Links	
            WHERE BID = :bid AND LCode = :lang");
		$stmt->bindParam(':bid', $BID);
		$stmt->bindParam(':lang', $lCode);
		$stmt->execute();

		// *Disconnect from the database
		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		$stmt->setFetchMode(PDO::FETCH_INTO, new SearchResult);
		return $stmt;
	}
}


// Execution codes:
$q = new Query;
echo "<h1>Search</h1>";
$results = $q->search( '劉慈欣', 'eng');
foreach($results as $row)
	{
		var_dump($row);
		echo '<br /> <br />';

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

?>
