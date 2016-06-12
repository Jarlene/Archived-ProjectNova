<?php
	include_once 'frontend_classes_h.php';

	$results = array(new SearchResult, new SearchResult, new SearchResult);
	// Filling Dummy Datas for sample purpose
	foreach ($results as $r) {
		$r->BID = 'BID';
		$r->BName = 'BName';
		$r->AID = 'AID';
		$r->AName = 'AName';
		$r->LCode = 'LCode';
		$r->GCode = 'SF';
		$r->GName = 'GName';
		$r->BRelease = 'BRelease';
		$r->BUpdate = 'BUpdate';
	}

	// Genarate table rows
	foreach ($results as $r) {
		echo $r->toHTMLTableRow();
	}
?>