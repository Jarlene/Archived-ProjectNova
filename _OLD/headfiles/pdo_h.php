<?php
/*
	PDO connection function
	- Call _db_connect() to initiate a connection to the database, and return a PDO object.
	- Invoke _db_commit(PDO &$dbh) to commit any change to the database and close connection.
	- Call _db_error(PDO &$dbh, $ex) in Catch block to deal with PDO connection exceptions.

    Author: Phoenix
    Version: 0612.2016
*/
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
function _db_error(&$dbh, $ex){ 
 	if (get_class($dbh) == 'PDO')
 		$dbh->rollBack();
  	echo "ERROR!: " , $ex->getMessage(), "\n";
  	$dbh = null;
  	die();
}

?>