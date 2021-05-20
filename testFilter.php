<?php
include('Db_connection.php');
if(!empty($_POST["pid"]))
{
  $pid=intval($_POST['pid']);
  $query="select Course_id from semester_courses where Prog_id=$pid; ";
  $result = mysqli_query($connection,$query) or die ("Error in query: ".$query." ".mysqli_connect_error());
  echo "<option value='-1'>---choose---</option>";
  while($row=mysqli_fetch_row($result))
  {
    $cname=mysqli_fetch_array($res=mysqli_query($connection,"select C_name from course where C_id=".$row[0].";"));
    echo "<option value='".$row[0]."'>".$cname[0]."</option>";
  }
}
?>
