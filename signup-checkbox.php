<?php
include "Db_connection.php"; // Using database connection file here
$query = "SELECT * FROM `course`;";
$result = mysqli_query($connection,$query)
or die ("Error in query: ".$query." ".mysqli_connect_error());

if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_array($result))
{
echo '<input type="checkbox" name="'.$row["C_id"].'" value="'.$row["C_id"].'">'.$row["C_name"].'</input>';
}
}
else {
echo "No Courses found!";
}
?>


              <!---    <?php
                  include "Db_connection.php"; // Using database connection file here
                  $query = "SELECT * FROM `course`;";
                  $result = mysqli_query($connection,$query)
                  or die ("Error in query: ".$query." ".mysqli_connect_error());

                  if (mysqli_num_rows($result) > 0) {
                  while($row= mysqli_fetch_array($result))
                  {
                  ?>
                  <input type="checkbox" name=" <?php echo $row['C_id']; ?>" value="<?php echo $row['C_id']; ?>"> <?php echo $row["C_name"]; ?> </input>
                  <?php
                  }
                  }
                  else {
                  echo "No Courses found!";
                  }
                  ?>  ---->
