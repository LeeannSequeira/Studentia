/**
 * Author:    Leeann Sequeira
 *
 * Last update Date: 8th August 2021
 *
 **/

<?php
//specify database server information
$server ="localhost";
$user="root";
$pass="";
$db = "studentia";
//open connection
$connection = mysqli_connect("$server", "$user", "$pass","$db") or die ('Could not connect');
// select database
mysqli_select_db($connection,$db);
?>
