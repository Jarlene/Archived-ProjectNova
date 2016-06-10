<?php
/* Sample PDO usage demo2:
	Serch Query,
	Besure to do all 3 steps when use, $dbh is the PDO object prepared.*/

/* 1. Import Connection head File */
include 'pdo_h.php';

class SearchResult {
    public $BID;
    public $BName;
    public $AID;
    public $AName;
    public $LCode;
    public $GCode;
    public $GName;
    public $BRelease;
    public $BUpdate;

    public function toHTMLTableRow() {
    	return '  <tr>
				    <td>'.$this->BName.'</td>
				    <td>'.$this->AName.'</td>
				    <td>'.$this->GName.'</td>
				    <td>'.$this->BRelease.'</td>
				    <td>'.$this->BUpdate.'</td>
				 </tr>';
    }
}

class Search {
    function qrStringToArray ($str) {
	    if (empty($str)) return false;
	    mb_internal_encoding("UTF-8");
	    $str = mb_ereg_replace('[;\$]',' ', $str);
	    $str = mb_strtolower($str);
	    $array = array_map('trim',mb_split(' ', $str, 3));
	    return $array;
	}

	public function queryASearch($qr_string, $lCode){
		$kwds = $this->qrStringToArray($qr_string);
		// 2. Connect to the database
		$dbh = _db_connect();

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
				"SELECT b.BID,bd.BName,b.AID,a.AName,bd.LCode,b.GCode,g.GName,bd.BRelease,bd.BUpdate
				From (  Select bd.BID
						From BookDetails bd
						Where bd.BName like :q1 AND bd.BName like :q2 AND bd.BName like :q3
						Union
						Select b.BID
						From Authors a, Books b 
						Where a.AID = b.AID AND AName like :q1 AND AName like :q2 AND AName like :q3) as x, BookDetails bd, Books b,Authors a, Genres g
				Where x.BID = b.BID AND x.BID = bd.BID AND b.AID = a.AID AND b.GCode = g.GCode AND bd.LCode = :lang AND a.LCode = :lang AND g.LCode = :lang
				Order by bd.BName");
			while (count($kwds) < 3)
				$kwds[] = '';
			$stmt->bindParam(':lang', $lCode);
			$stmt->execute(array(':q1' => "%$kwds[0]%", ':q2' => "%$kwds[1]%", ':q3' => "%$kwds[2]%", ':lang' => $lCode));
		}
		$stmt->setFetchMode(PDO::FETCH_INTO, new SearchResult);
		// 3. Disconnect from the database
		_db_commit($dbh);

		return $stmt;
	}

}


// Execution codes:
$sf = new Search;
// $results is a SearchResult object, so you can directly request the related field from it.
$results = $sf->queryASearch( '劉慈欣', 'eng');

foreach($results as $row)
	{
		var_dump($row);
		echo '<br /> <br />';
	}
?>
