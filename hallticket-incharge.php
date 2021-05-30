<?php
include "Db_Connection.php"; // db connection
if(isset($_POST["button"]))
{
if($_REQUEST['button']=="Add") //---------------------------------------------------------------------------------------------------------------------------------ADD BUTTON
{

  $roll = $_POST["sroll"];
  $attendance=$_POST["sat"];
  $c=$_POST["tcours"];

  $queryCh = "Select * from student where Roll_no='$roll';";
  $resultCh = mysqli_query($connection,$queryCh) or die ("Error in query: ".$queryCh." ".mysqli_connect_error());

   if((mysqli_fetch_row($resultCh))>0)
   {
  //mettez dans Student tableau
  $query = "Update Enroll set attendance=$attendance where Roll_no='$roll' and C_id=$c;";
  $result = mysqli_query($connection,$query) or die ("Error in query: ".$query." ".mysqli_connect_error());

  echo "<script>alert('Attendance added successfully');</script>";
  }
  else {
    echo "<script>alert('Roll number does not exist');</script>";
  }
  mysqli_close($connection);
}
}
?>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="Studentia.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
  function togglePopupaddst() //refered from https://www.gitto.tech/posts/simple-popup-box-using-html-css-and-javascript/
  {
    document.getElementById("popup-addst").classList.toggle("active");
  }

  $(document).ready(function(){           //Add course for attendace- dynamic course list
      $('#tpro').on('change', function(){
          var pid = $(this).val();
          if(pid){
              $.ajax({
                  url:"testFilter.php",
                  method:"POST",
                  data: {pid:pid},
                  success:function(html){
                      $('#tco').html(html);
                  }
              });
          }else{
              $('#tco').html('<option value="">Select Program first</option>');
          }
      });
  });

  //VALIDATION FOR SEARCH BUTTON: compulsory to choose semester program and class
  function validateSearch()
  {
    var	x=document.sfilter.sprog.value;
    var	y=document.sfilter.sclass.value;
    var	z=document.sfilter.sem.value;

      if (x == "-1")
      {
        alert("please choose the program");        //Program
        return false;
      }
      if (y == "-1")
      {
        alert("please choose the class");        //Program
        return false;
      }
      if (z == "-1")
      {
        alert("please choose the semester");        //Program
        return false;
      }
    return true;
    }

    function validateat()
    {
      var	x=document.addst.sroll.value;
      var	y=document.addst.sat.value;
      var	z=document.addst.tprog.value;
      var	a=document.addst.tcours.value;

        if ((x =="")||(x==null))
        {
          alert("please enter Roll no.");        //Program
          return false;
        }
        if ((y =="")||(y==null))
        {
          alert("please enter the attendance");        //Program
          return false;
        }
        if ((y<0)||(y>100))
        {
          alert("Opps! invalid attendance");        //Program
          return false;
        }
        if(isNaN(y))
          {
        alert(	"Oops! Attendance is Numeric!"	);
        return	false;
          }
        if (z == "-1")
        {
          alert("please choose the Program");        //Program
          return false;
        }
        if (a == "-1")
        {
          alert("please choose the Course");        //Program
          return false;
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
            <a class="nav-link" href="dashboard-incharge.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="student-incharge.php">Student</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="test-incharge.php">Test</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="marks-incharge.php">Marks</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="result-incharge.php">Result</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="hallticket-incharge.php">Hall Ticket</a>
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
            <div class="adminfunction"><img id="functionicon-admin" src="images/hallticketicon.png">&nbsp<span id="functiontitle-admin"> hallticket</span></div>
          </div>
          <form id="studentfilter" name="sfilter" action="" method="POST" onsubmit="return validateSearch()">
            <div class="row">
                 <div class="col-6 st-colalign">Program</div><div class="col-6 st-colalign"><select class="roundedinputselect st-input" name="sprog"><option value="-1" selected>Program</option><option value="1">BCA</option><option value="2">BBA</option><option value="3">BAMC</option></select></div>
            </div>
            <div class="row">
                <div class="col-6 st-colalign"> Class</div><div class="col-6 st-colalign"><select class="roundedinputselect st-input" name="sclass"><option value="-1" selected>Class</option><option value="1">FY</option><option value="2">SY</option><option value="3">TY</option></select></div>
            </div>
            <div class="row">
                <div class="col-6 st-colalign"> Semester</div><div class="col-6 st-colalign"><select class="roundedinputselect st-input" name="sem"><option value="-1" selected>Semester</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option></select></div>
            </div>
            <div class="row">
                <div class="col-12 st-colalign"><center><input type="submit" name="button" value="Search" id="st-searchbtn"></center></div>
            </div>
        </form>
        </div>
        <div class="col-md-9" id="function-right-section">  <!-- RIGHT PARTITION------------------------------------------------------------------------------------------------------->
          <div class="row course-editbtn">
            <div class="col-4">
              <!--________________________________________________________________Empty For Layout_______-->
            </div>
            <div class="col-4">
              <!--________________________________________________________________Empty For Layout_______-->
            </div>
            <div class="col-4"><!--ADD------------------------------------------------------------------------------------------------------->
              <button class="functionbtn" id="AddAtten" name ="button" value="Add" onclick="togglePopupaddst()">Add Student Attendance</button>
              <div class="popup" id="popup-addst">
                <div class="overlay"></div>
                <div class="stcontent">
                  <div class="close-btn" onclick="togglePopupaddst()">×</div><!--popup content-->
                  <span id="addform-title">ADD STUDENT ATTENDANCE</span><br>
                  <div id="st-addform"><form id="addcourse-admin" name="addst" method="POST" onSubmit="return validateat()">
                    <div class="row mb-3"><div class="col-6">Roll No.</div><div class="col-6"><input class="roundedinput" type="text" name="sroll"></div></div>
                    <div class="row mb-3"><div class="col-6">Attendance(in %)</div><div class="col-6"><input class="roundedinput" type="text" name="sat"></div></div>
                    <div class="row mb-3">
                        <div class="col-6 "> Program</div><div class="col-6 "><select class="roundedinputselect st-input" name="tprog" id="tpro"><option value="-1" selected>Program</option><option value="1">BCA</option><option value="2">BBA</option><option value="3">BAMC</option></select></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 ">Course</div><div class="col-6 "><select class="roundedinputselect st-input" name="tcours" id="tco">
                          <option value="-1" selected>Course</option>
                        </select></div>
                    </div>
                    <div class="row mb-3"><center><input type="submit" name="button" value="Add" id="add-coursebtn"></center></div>
                  </form></div>
                </div>
              </div>
            </div>
          </div>
          <div class="searchresults">
            <?php
            if(isset($_POST['button']))
            {
              if($_REQUEST['button']=="Search") //----------------------------------------------------------------------------------------------------------------FILTER BUTTON
              {
                $prog = $_POST["sprog"];
                $ed = $_POST["sclass"];
                $sem = $_POST["sem"];

                $queryres="select Roll_no ,student.Fname ,student.Lname from student where student.Program=$prog and student.Education_year='$ed';";

                $resultres = mysqli_query($connection,$queryres) or die ("Error in query: ".$queryres." ".mysqli_connect_error());
                  $resultres2 = mysqli_query($connection,$queryres) or die ("Error in query: ".$queryres." ".mysqli_connect_error());

                    if(mysqli_num_rows($resultres)>0)
                    {
                      $res= mysqli_fetch_row($resultres);
                      $roll=$res[0];
                      echo "<table class='table table-striped' id='studEligibleData'>";
                      $queryFindcourses="Select enroll.C_id, course.C_name, enroll.attendance, semester_courses.Sem_id from enroll
                                     inner join semester_courses on enroll.C_id=semester_courses.Course_id
                                     inner join course on course.C_id = enroll.C_id
                                     inner join student using(Roll_no)
                                     where semester_courses.Sem_id=$sem and semester_courses.Prog_id=student.Program and Enroll.Roll_no='$roll';";

                     $resultFindcourses= mysqli_query($connection,$queryFindcourses) or die ("Error in query: ".$queryFindcourses." ".mysqli_connect_error());
                     echo "<tr><th>Roll_no</th><th>Name</th>";

                     while ($rowE=mysqli_fetch_row($resultFindcourses))
                     {
                       echo "<th>".$rowE[1]."</th>";
                     }
                     echo "<th>Action</th></tr>";

                      while ($rows= mysqli_fetch_row($resultres2))
                      {

                        $r=$rows[0]; //----FOR EACH ROLL NUMBER

                         $f=$rows[1];
                         $l=$rows[2];
                         $queryInsertSem="Select enroll.C_id, course.C_name, enroll.attendance, semester_courses.Sem_id from enroll
                                        inner join semester_courses on enroll.C_id=semester_courses.Course_id
                                        inner join course on course.C_id = enroll.C_id
                                        inner join student using(Roll_no)
                                        where semester_courses.Sem_id=$sem and semester_courses.Prog_id=student.Program and Enroll.Roll_no='$r';";

                        $resultInsertSem2 = mysqli_query($connection,$queryInsertSem) or die ("Error in query: ".$queryInsertSem." ".mysqli_connect_error());
                        echo "<tr><td>$r</td><td>$f $l</td>";
                        while ($rowCh=mysqli_fetch_row($resultInsertSem2))
                        {
                          $ch=intval($rowCh[2]);
                            if(($ch<75)||($ch==0))
                            {echo "<td>NOT ELIGIBLE</td>";}
                            else
                            {echo "<td>ELIGIBLE</td>";}

                        }
                        echo "<td><a href='hall.php?roll=$r&&sem=$sem'><button type='button' value='Ticket'>Ticket</button></a></td>";
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
