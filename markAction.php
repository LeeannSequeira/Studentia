<?php
include "Db_Connection.php"; // db connection
$tid=intval($_POST['tid']);
$rollno=$_POST['r'];

$querygetmk = "select Obtained_marks from test_conducted where Test_id=$tid and Roll_no='$rollno';";
$resultgetmk = mysqli_query($connection,$querygetmk) or die ("Error in query: ".$querygetmk." ".mysqli_connect_error());
if($resultgetmk)
{
	while ($row= mysqli_fetch_row($resultgetmk))  //mettez dans sem_cours tableau
	{
		$value=intval($row[0]);
		echo "$value";
	}
}
?>
