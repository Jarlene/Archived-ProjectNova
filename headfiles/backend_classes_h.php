<?php
/*
    This is the class declaration head file for back end query operations.

    Author: Phoenix
    Version: 0613.2016

    Classes Index:
    - Query Class: all the query methods that construct an object from the query.
    	- qrStringToArray($str): A helper function that converts $str into array of strings.
        - search($qr_string, $lCode): Searches with keywords in $qr_string and returns an array of SearchResult objects in $lCode language.
        - getBook($BID, $lCode): Gets book information and returns a BookDetail object in $lCode language.
        - getAuthor($AID, $lCode): Gets author information and returns an AuthorDetail object in $lCode language.
        - getBookLinks($BID, $lCode): Gets the links for the book and returns an array of BookLink objects in $lCode language.
        - getBookComments($BID): Gets comments for the book and returns an array of Comment objects.
        - getAuhtorComments($BID): Gets comments for the author and returns an array of Comment objects.
*/
require_once 'pdo_h.php';
require_once 'frontend_classes_h.php';

class Query {

	// A helper function that removes all  $ and ; symbols and splits the input string into an array of 3 strings.
	// Argument:$str, an string
	// Return:	An array of strings with at most 3 elements.
    private function qrStringToArray ($str) {
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
	//			(If no matching result returned) Return a dummmy array with one SearchResult object.
	public function search($qr_string, $lCode){
		$kwds = $this->qrStringToArray($qr_string);
		// *Connect to the database
		try{$dbh = _db_connect();
		
		$stmt = null;
		if (!$kwds){
			$stmt = $dbh->prepare(
				"SELECT BID, BName, AID, AName, LCode, GCode, GName, BRelease, BUpdate, GLink
				FROM Books NATURAL JOIN BookDetails NATURAL JOIN Authors NATURAL JOIN Genres
				Where LCode = :lang
				Order by BName;");
			$stmt->bindParam(':lang', $lCode);
			$stmt->execute();
		} else {
			$stmt = $dbh->prepare(
				"SELECT BID, BName, AID, AName, LCode, GCode, GName, BRelease, BUpdate, GLink
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
		// *Disconnect from the database
		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		$stmt->setFetchMode(PDO::FETCH_INTO, new SearchResult);
		// $results = $stmt->fetchAll();
		// // Create dummy entry if nothing returned from the query
		// if (!$results)
		// 	$results = array(new DummySR);

		// return $results;
		return $stmt;
	}

	// Query detailed information for a book
	// Argument:$BID, the BID of the Book
	// 			$lCode is the language code to display the results in.
	// Return:	An BookDetail objects.
	//			(If no matching result returned) Return a BookDetail object.
	// Exception:	It returns bool(false) if the book is not in the database
	public function getBook($BID, $lCode){
		// *Connect to the database
		try{$dbh = _db_connect();

		$stmt = $dbh->prepare(
			"SELECT BID, BName, AID, AName, LCode, GCode, GName, ORelease, BRelease, WCount, BUpdate, BDesc, GLink
			FROM Books NATURAL JOIN Authors NATURAL JOIN Genres NATURAL JOIN BookDetails
			WHERE BID = :bid AND LCode = :lang");
		$stmt->bindParam(':bid', $BID);
		$stmt->bindParam(':lang', $lCode);
		$stmt->execute();

		// *Disconnect from the database
		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		$obj = $stmt->fetchObject('BookDetail');
		// Create dummy entry if nothing returned from the query
		if (!$obj)
			$obj = new DummyBD;

		return $obj;
	}


	// Query detailed information for an author
	// Argument:$AID, the AID of the author
	// 			$lCode is the language code to display the results in.
	// Return:	An AuthorDetail objects.
	//			(If no matching result returned) Return a BookDetail object.
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

		$obj = $stmt->fetchObject('AuthorDetail');
		// Create dummy entry if nothing returned from the query
		if (!$obj)
			$obj = new DummyAD;

		return $obj;
	}

	// Query to get links for a book
	// Argument:$BID, the BID of the Book
	// 			$lCode is the language code to display the results in.
	// Return:	An array of BookLink objects.
	//			(If no matching result returned) Return a dummmy array with one BookLink object..
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
		
		$stmt->setFetchMode(PDO::FETCH_INTO, new BookLink);
		// $results = $stmt->fetchAll();
		// // Create dummy entry if nothing returned from the query
		// if (!$results)
		// 	$results = array(new DummyBL);
		
		// return $results;
		return $stmt;
	}

	// Query to get comments for a book
	// Argument:$BID, the BID of the Book
	// Return:	An array of Comment objects.
	//			(If no matching result returned) Return a dummmy array with one Comment object..
	public function getBookComments($BID){
		// *Connect to the database
		try{$dbh = _db_connect();

		$stmt = $dbh->prepare(
			"SELECT TStamp, Content
			FROM CMTBooks	
            WHERE BID = :bid
            ORDER BY TStamp DESC");
		$stmt->bindParam(':bid', $BID);
		$stmt->execute();

		// *Disconnect from the database
		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		$stmt->setFetchMode(PDO::FETCH_INTO, new Comment);
		// $results = $stmt->fetchAll();
		// if (!$results)
		// 	$results = array(new DummyCMT);

		// return $results;
		return $stmt;
	}

	// Query to get comments for an author
	// Argument:$AID, the AID of the author
	// Return:	An array of Comment objects.
	//			(If no matching result returned) Return a dummmy array with one Comment object..
	public function getAuthorComments($AID){
		// *Connect to the database
		try{$dbh = _db_connect();

		$stmt = $dbh->prepare(
			"SELECT TStamp, Content
			FROM CMTAuthors	
            WHERE AID = :aid
            ORDER BY TStamp DESC");
		$stmt->bindParam(':aid', $AID);
		$stmt->execute();

		// *Disconnect from the database
		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		$stmt->setFetchMode(PDO::FETCH_INTO, new Comment);
		// $results = $stmt->fetchAll();
		// if (!$results)
		// 	$results = array(new DummyCMT);

		// return $results;
		return $stmt;
	}

	// Query to add an comment
	public function addBookComment($BID, $str){
		try{$dbh = _db_connect();

		$stmt = $dbh->prepare(
			"INSERT INTO CMTBooks(TStamp, BID, Content)
			VALUES (NOW(), :bid, :cmt)");
		$stmt->bindParam(':bid', $BID);
		$stmt->bindParam(':cmt', $str);
		$stmt->execute();

		// *Disconnect from the database
		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		return true;
	}

	// Query to add an comment
	public function addAuthorComment($AID, $str){
		try{$dbh = _db_connect();

		$stmt = $dbh->prepare(
			"INSERT INTO CMTAuthors(TStamp, AID, Content)
			VALUES (NOW(), :aid, :cmt)");
		$stmt->bindParam(':aid', $AID);
		$stmt->bindParam(':cmt', $str);
		$stmt->execute();

		// *Disconnect from the database
		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		return true;
	}

	// Query for add an book favorate
	public function isFavBook($username,$BID){
		try{$dbh = _db_connect();
		$stmt = $dbh->prepare(
			"SELECT AddedAt
			FROM FAVBooks
			Where UserName = :uid AND BID = :bid");
		$stmt->bindParam(':uid', $username);
		$stmt->bindParam(':bid', $BID);
		$stmt->execute();

		// *Disconnect from the database
		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		return $stmt->fetchColumn();;
	}

	// Query for add an book favorate
	public function isFavAuthor($username,$AID){
		try{$dbh = _db_connect();
		$stmt = $dbh->prepare(
			"SELECT AddedAt
			FROM FAVAuthors
			Where UserName = :uid AND AID = :aid");
		$stmt->bindParam(':uid', $username);
		$stmt->bindParam(':aid', $AID);
		$stmt->execute();

		// *Disconnect from the database
		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		return $stmt->fetchColumn();;
	}
	
	public function changeFavBook($username,$BID){
		$isFaved = $this->isFavBook($username,$BID);
		try{$dbh = _db_connect();

		if ($isFaved){
			$stmt = $dbh->prepare(
				"DELETE FROM FAVBooks
				Where UserName = :uid AND BID = :bid");
		} else {
			$stmt = $dbh->prepare(
				"INSERT INTO FAVBooks
				 VALUES(:uid, :bid, NOW())");
		}
		$stmt->bindParam(':uid', $username);
		$stmt->bindParam(':bid', $BID);
		$stmt->execute();

		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}	
		
		return true;
	}
	
	public function changeFavAuthor($username,$AID){
		$isFaved = $this->isFavAuthor($username,$AID);
		try{$dbh = _db_connect();

		if ($isFaved){
			$stmt = $dbh->prepare(
				"DELETE FROM FAVAuthors
				Where UserName = :uid AND AID = :aid");
		} else {
			$stmt = $dbh->prepare(
				"INSERT INTO FAVAuthors
				 VALUES(:uid, :aid, NOW())");
		}
		$stmt->bindParam(':uid', $username);
		$stmt->bindParam(':aid', $AID);
		$stmt->execute();

		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}	
		
		return true;
	}

	public function getFavBooks($username, $lcode){
		try{$dbh = _db_connect();
		$stmt = $dbh->prepare(
			"SELECT BID, BName, AID, AName, AddedAt, LCode
			FROM FAVBooks NATURAL JOIN Books NATURAL JOIN BookDetails NATURAL JOIN Authors
			Where UserName = :uid AND LCode = :lang");
		$stmt->bindParam(':uid', $username);
		$stmt->bindParam(':lang', $lcode);
		$stmt->execute();

		// *Disconnect from the database
		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		$stmt->setFetchMode(PDO::FETCH_INTO, new FavBook);
		
		return $stmt;
	}

	public function getFavAuthors($username, $lcode){
		try{$dbh = _db_connect();
		$stmt = $dbh->prepare(
			"SELECT AID, AName, AddedAt, LCode
			FROM FAVAuthors NATURAL JOIN Authors
			Where UserName = :uid AND LCode = :lang");
		$stmt->bindParam(':uid', $username);
		$stmt->bindParam(':lang', $lcode);
		$stmt->execute();

		// *Disconnect from the database
		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		$stmt->setFetchMode(PDO::FETCH_INTO, new FAVAuthor);
		
		return $stmt;
	}

	public function getAuthorShowcase($lcode){
		try{$dbh = _db_connect();

		$stmt = $dbh->prepare(
			"SELECT DISTINCT AID, AName, LCode, count(*) as Favs
			FROM FAVAuthors NATURAL JOIN Authors
			WHERE LCode = :lang
			GROUP BY AID
			ORDER BY Favs DESC");
		$stmt->bindParam(':lang', $lcode);
		$stmt->execute();

		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		$stmt->setFetchMode(PDO::FETCH_INTO, new AuthorDetail);
		return $stmt;
	}

	public function getBookShowcase($lcode){
		try{$dbh = _db_connect();

		$stmt = $dbh->prepare(
			"SELECT DISTINCT BID, BName, AID, AName, LCode, GCode, GName, BRelease, BUpdate, GLink, Clicks, count(*) as Favs
			FROM FAVBooks NATURAL JOIN Books NATURAL JOIN BookDetails NATURAL JOIN Authors NATURAL JOIN Genres
			WHERE LCode = :lang
			GROUP BY BID
			ORDER BY Favs DESC");
		$stmt->bindParam(':lang', $lcode);
		$stmt->execute();

		_db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

		$stmt->setFetchMode(PDO::FETCH_INTO, new BookShowcase);
		return $stmt;
	}
}
?>