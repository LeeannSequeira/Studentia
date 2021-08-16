/**
 * Author:    Leeann Sequeira
 *
 * Last update Date: 8th August 2021
 *
 **/

<?php
include "Db_Connection.php"; // db connection
?>

<html>
<head>
  <title>Studentia Student Page</title>
  <link rel="icon"
    type="image/png"
    href="images/logo-fav.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="Studentia.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
  <script type="text/javascript">
   function val()
   {
     r=document.sfilter.stroll.value;
    if((r!=null)&&(r!=""))
    {
       if(r.length<10)
      {
       alert("Please enter valid Rollno");    //roll num
       return false;
      }
    }
    return true;
   }
  </script>
</head>
  <body>
    <!-- LANDING PAGE BASIC PARTITION-------------------------------------------------->
    <nav class="navbar navbar-expand-lg navbar-dark customnav">
    <div class="container-fluid navtext">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard-teacher.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="student-teacher.php">Student</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="test-teacher.php">Test</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="marks-teacher.php">Marks</a>
          </li>
        </ul>
      </div>
      <span class="navbar-text">
          <a class="nav-link" href="landingpage-login.php">Log Out</a>
        </span>
    </div>
    </nav>
    <!-- END OF NAV---------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="container landing">
      <div class="row landingrow">
        <div class="col-md-3" id="function-left-section"><!-- LEFT PARTITION----------------------------------------------------------------------------------------------------------->
          <div class="row">
            <div class="adminfunction"><img id="functionicon-admin" src="images/studenticon.png">&nbsp<span id="functiontitle-admin"> Student</span></div>
          </div>
          <form id="studentfilter" name="sfilter" action="" method="POST" onsubmit="return val()">
         <div class="row">
              <div class="col-6 st-colalign">Program</div><div class="col-6 st-colalign"><select class="roundedinputselect st-input" name="stprog"><option value="-1" selected>Program</option><option value="1">BCA</option><option value="2">BBA</option><option value="3">BAMC</option></select></div>
         </div>
         <div class="row">
             <div class="col-6 st-colalign"> Class</div><div class="col-6 st-colalign"><select class="roundedinputselect st-input" name="stclass"><option value="-1" selected>Class</option><option value="1">FY</option><option value="2">SY</option><option value="3">TY</option></select></div>
         </div>
         <div class="row">
             <div class="col-6 st-colalign"> Rollno</div><div class="col-6 st-colalign"><input class="roundedinput st-input" type="text" name="stroll"></div>
         </div>
         <div class="row">
             <div class="col-12 st-colalign"><center><input type="submit" name="button" value="Search" id="st-searchbtn"></center></div>
         </div>
        </form>
        </div>
        <div class="col-md-9" id="function-right-section">  <!-- RIGHT PARTITION------------------------------------------------------------------------------------------------------->
          <div class="row course-editbtn">

            <div class="searchresults">
            <?php
            if(isset($_POST['button']))
            {
              if($_REQUEST['button']=="Search") //----------------------------------------------------------------------------------------------------------------FILTER BUTTON
              {
                $prog = $_POST["stprog"];
                $class = $_POST["stclass"];
                $roll = $_POST["stroll"];


                if(isset($prog)&& ($prog!='-1'))
                {
                  If(isset($class)&& ($class!='-1'))
                  {
                    if(isset($roll)&& ($roll!=null) && ($roll!=""))
                    {
                      $query1 = "Select student.Roll_no,student.Fname,student.Mname,student.Lname,student.Dateofjoin,student.Education_year, program.P_name from student
                                inner join program on student.Program=program.P_id
                                where Program=$prog and Education_year='$class' and Roll_no='$roll';";
                    }
                    else
                    {
                      $query1 = "Select student.Roll_no,student.Fname,student.Mname,student.Lname,student.Dateofjoin,student.Education_year, program.P_name from student
                                inner join program on student.Program=program.P_id
                                where Program=$prog and Education_year='$class';";
                    }
                  }
                  else
                  {
                    if(isset($roll)&& ($roll!=null) && ($roll!=""))
                    {
                      $query1 = "Select student.Roll_no,student.Fname,student.Mname,student.Lname,student.Dateofjoin,student.Education_year, program.P_name from student
                                inner join program on student.Program=program.P_id
                                where Program=$prog and Roll_no='$roll';";
                    }
                    else
                    {
                      $query1 = "Select student.Roll_no,student.Fname,student.Mname,student.Lname,student.Dateofjoin,student.Education_year, program.P_name from student
                                inner join program on student.Program=program.P_id
                                where Program=$prog;";
                    }
                  }
                  }
                  else
                  {
                  If(isset($class)&& ($class!='-1'))
                  {
                    if(isset($roll)&& ($roll!=null) && ($roll!=""))
                    {
                      $query1 = "Select student.Roll_no,student.Fname,student.Mname,student.Lname,student.Dateofjoin,student.Education_year, program.P_name from student
                                inner join program on student.Program=program.P_id
                                where Education_year='$class' and Roll_no='$roll';";
                    }
                    else
                    {
                      $query1 = "Select student.Roll_no,student.Fname,student.Mname,student.Lname,student.Dateofjoin,student.Education_year, program.P_name from student
                                inner join program on student.Program=program.P_id
                                where Education_year='$class';";
                    }
                  }
                  else
                  {
                    if(isset($roll)&& ($roll!=null) && ($roll!=""))
                    {
                      $query1 = "Select student.Roll_no,student.Fname,student.Mname,student.Lname,student.Dateofjoin,student.Education_year, program.P_name from student
                                inner join program on student.Program=program.P_id
                                where Roll_no='$roll';";
                    }
                    else
                    {
                      $query1 = "Select student.Roll_no,student.Fname,student.Mname,student.Lname,student.Dateofjoin,student.Education_year, program.P_name from student
                                inner join program on student.Program=program.P_id;";
                    }
                  }
                  }

                $result1 = mysqli_query($connection,$query1) or die ("Error in query: ".$query1." ".mysqli_connect_error()); //Works and obtains result

                if(mysqli_num_rows($result1)>0)
                {
                  echo "<table class='table table-striped' id='studdata'>";
                  echo "<tr><th>Roll no.</th><th>Name</th><th>Registration date</th><th>Academic Year</th><th>Program</th></tr>";
                while ($row= mysqli_fetch_row($result1))
                {
                  echo "<tr>";
                  echo "<td>".$row[0]."</td>";
                  echo "<td>".$row[1]." ".$row[2]." ".$row[3]."</td>";
                  echo "<td>".$row[4]."</td>";
                  echo "<td>".$row[5]."</td>";
                  echo "<td>".$row[6]."</td>";
                  echo "</tr>";
                }
                  echo "</table>";
                }
                mysqli_close($connection);
              }}
              ?>
            </div>
        </div>
      </div>
    </div>
  </body>
</html>
