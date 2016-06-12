<?php
include 'mysql_login_info.ini';

// Initialize PDO object and conncet to the server.
// Open transation. Must call commit() after.
function _db_connect(){
	$dbh = new PDO('mysql:host=localhost;dbname=nova;charset=utf8', MYSQL_DB_USER, MYSQL_DB_PASS);
	$dbh->beginTransaction();
	return $dbh;
}

// Commit and Close databae connection
function _db_commit(PDO &$dbh){ 
	$dbh->commit();
	$dbh = null; 
}

// Exception handling function
function _db_error(PDO &$dbh, $ex){ 
 	$dbh->rollBack();
  	echo "ERROR!: " , $ex->getMessage(), "\n";
  	$dbh = null;
  	die();
}

?>