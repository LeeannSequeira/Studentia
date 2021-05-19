<?php
    include('Db_connection.php');
    $un = $_POST['tusername'];
    $pass = $_POST['tpassword'];

        $query = "select *from teacher where T_id = $un and Password = '$pass';";
        $result = mysqli_query($connection, $query) or die ("Error in query: ".$query." ".mysqli_connect_error());
        $count=mysqli_num_rows($result);
        if($count == 1){
          $query="Select Teacher_role from department_teachers where T_id = $un;";
          $result = mysqli_query($connection, $query) or die ("Error in query: ".$query." ".mysqli_connect_error());
          $row= mysqli_fetch_assoc($result);
          if($row['role']=="incharge")
          {
            header("Location: dashboard-incharge.html");
            exit();
          }
          else
          {
            header("Location: dashboard-teacher.html");
            exit();
          }
        }
        else{
            header("Location: landingpage-login.html");
            echo "<script>alert('Login Failed');</script>";
        }

?>
