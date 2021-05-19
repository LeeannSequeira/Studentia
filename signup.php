<?php
include "Db_Connection.php"; // Using database connection file here
//variables retrieved from form are copied into simpler variable names
$fname=$_POST["tfname"];
$lname = $_POST["tlname"];
$mail = $_POST["tmail"];
$pass = $_POST["tpassword"];
$gen = $_POST["tgen"];
//-------------------------------store check box data code
$dept = $_POST["tdept"];
$role = $_POST["trole"];

//insert into teacher table
$query = "INSERT INTO teacher(Fname,Lname, Gender, Password, Email) VALUES ('$fname','$lname','$gen','$pass','$mail')";
$result = mysqli_query($connection,$query) or die ("Error in query: ".$query." ".mysqli_connect_error());

//get TID of record
$query="Select T_id from teacher where Email='$mail';";
$result = mysqli_query($connection,$query) or die ("Error in query: ".$query." ".mysqli_connect_error());

while ($row= mysqli_fetch_assoc($result)) {
  $un=$row["T_id"];
}

//insert into department table
$query = "INSERT INTO department_teachers(Dept_id, T_id, Teacher_role) VALUES ($dept,$un,'$role');";
$result = mysqli_query($connection,$query) or die ("Error in query: ".$query." ".mysqli_connect_error());

echo "<script>alert('Your Username is $un');</script>";
mysqli_close($connection);
?>
