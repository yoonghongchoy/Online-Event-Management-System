<?php
$DB_SERVER ='localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_NAME = 'event management system';
 
/* Attempt to connect to MySQL database */
$db = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
 
// Check connection
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>