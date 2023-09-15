<?php
/*PHP document to demonstrate the complete process of connecting and executing queries inside a database management system in PHP
using the mysqli module.*/

require_once 'mysql_login.php';

//mysqli is a php module which exposes an interface to use 
//a mysql database. It can be accessed functionally or using
//object-style class.

//mysqli_connect creates connection object which can be used to access the database

$db_conn = mysqli_connect($sql_host, $sql_user, $sql_pwd, $sql_database);

//query method performs a given query on the selected database
//returns false if failure, else returns resultset object
$result = $db_conn->query("SELECT * from authors") or "no results";

echo "<pre>";
//fetch_row fetches a row (represented as an array) from the result set
//returns false if there are no more rows
$r = $result->fetch_row();
while($r){
    foreach($r as $field){
        print("$field | ");
    }
    echo "\n";
    $r = $result->fetch_row();
}


//Once processed we close the result set to free up the resources used by it.
$result->close();

echo "\n\n\n-------------\n\n\n";

//Same result, but this time using the fetch_all function, which transforms the complete result set into an array of arrays
//There is an array for every row, and in this case they're associative since we provided the MYSQLI_NUM constant as an argument to the function,
//but by default is numeric.
$result = $db_conn->query("SELECT * from authors") or "no results";

$all_data = $result->fetch_all(MYSQLI_NUM);

foreach($all_data as $row){
    foreach($row as $fld){
        print("$fld | ");
    }
    echo "\n";
}

echo "</pre>";
