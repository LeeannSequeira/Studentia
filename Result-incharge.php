<?php
include "Db_Connection.php"; // db connection
?>
<html>
<head>
  <title>Studentia Result Page</title>
  <link rel="icon"
    type="image/png"
    href="images/logo-fav.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="Studentia.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
  <script type="text/javascript">
  function togglePopupaddst() //refered from https://www.gitto.tech/posts/simple-popup-box-using-html-css-and-javascript/
  {
    document.getElementById("popup-addst").classList.toggle("active");
  }
  function togglePopupupdatest() //refered from https://www.gitto.tech/posts/simple-popup-box-using-html-css-and-javascript/
  {
    document.getElementById("popup-updatest").classList.toggle("active");
  }
  function togglePopupdeletest() //refered from https://www.gitto.tech/posts/simple-popup-box-using-html-css-and-javascript/
  {
    document.getElementById("popup-deletest").classList.toggle("active");
  }


  function datevalidation(dateString)
    { var regEx = /^\d{4}-\d{2}-\d{2}$/;       //date validation
if(!dateString.match(regEx))
  {
    return false;  // Invalid format
  }
var d = new Date(dateString);
var dNum = d.getTime();
if(!dNum && dNum !== 0)
{
  return false; // NaN value, Invalid date
}
return d.toISOString().slice(0,10) === dateString;
}

  function validateAddStudent()
  {
    var	x=document.addst.sfname.value;
    var	y=document.addst.smname.value;
    var	z=document.addst.slname.value;
    var	r=document.addst.sroll.value;
    var	date=document.addst.sjdate.value;
    if(r==null||r=="")
     {
      alert("Please enter Rollno");    //roll num
     }
    if(x==null||x=="")
     {
      alert("Please enter First name");    //FIrst name
     }
    if(y==null||y=="")
     {
      alert("Please enter Middle name");     //mid name
     }
     if(z==null||z=="")
      {
       alert("Please enter Last name");     //last name
      }
      if(datevalidation(date)==false)
      {
       alert("Please enter correct date format");     //date
      }
      if (document.addst.sdept.value == "-1")
      {
        alert("please choose the department");        //Department
      }
      if (document.addst.sprog.value == "-1")
      {
        alert("please choose the program");        //Program
      }
      if (document.addst.say.value == "-1")
      {
        alert("please choose the class");        //Program
      }
    return true;
    }

    function validateUpdateStudent()
    {
      var	r=document.updatest.sroll.value;
      var	date=document.updatest.sjdate.value;
      if(r==null||r=="")
       {
        alert("Please enter Rollno");    //roll num
       }
      if(date!=null&&date!="")
      {
        if(datevalidation(date)==false)
        {
         alert("Please enter correct date format");     //date
        }
      }
      return true;
      }

      function validateDeleteStudent()
      {
        var	r=document.deletest.sroll.value;
        if(r==null||r=="")
         {
          alert("Please enter Rollno");    //roll num
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
            <div class="adminfunction"><img id="functionicon-admin" src="images/resulticon.png">&nbsp;<span id="functiontitle-admin">&nbsp;Result</span></div>
          </div>
          <form id="studentfilter" name="sfilter" action="" method="POST">
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
          <div class="searchresults">
          <?php
          if(isset($_POST['button']))
          {
            if($_REQUEST['button']=="Search") //----------------------------------------------------------------------------------------------------------------FILTER BUTTON
            {
              $prog = $_POST["sprog"];
              $class = $_POST["sclass"];
              $semester=$_POST["sem"];

              $queryGetRoll = "Select Roll_no from student;";
              $resultGetRoll = mysqli_query($connection,$queryGetRoll) or die ("Error in query: ".$queryGetRoll." ".mysqli_connect_error());
              if(mysqli_num_rows($resultGetRoll)>0)
              {
                while ($row= mysqli_fetch_row($resultGetRoll))
                {
                  $r=$row[0];
                  $counter=0;
                  //calculate course garde
                //  CASE when sum(select obtained marks from test_conducted where Roll_no='$r')>90 then insert into enroll(Course_grade) values END;
                  $queryCourse = "select C_id from enroll where Roll_no='$r';";
                  $resultCourse = mysqli_query($connection,$queryCourse) or die ("Error in query: ".$queryCourse." ".mysqli_connect_error());
                  if(mysqli_num_rows($resultCourse)>0)
                  {
                    while ($rowc= mysqli_fetch_row($resultCourse))
                    {
                      $c=$rowc[0];
                      $queryCourseTotal = "select sum(test_conducted.Obtained_marks) from test_conducted
                                          inner join test USING (Test_id )
                                          where Roll_no='$r' and test.course=$c;";
                      $resultCourseTotal = mysqli_query($connection,$queryCourseTotal) or die ("Error in query: ".$queryCourseTotal." ".mysqli_connect_error());
                      $resc=mysqli_fetch_row($resultCourseTotal);
                      $rc=intval($resc[0]);
                      //insert Grade into enroll
                      if(($rc>=85)&&($rc<=100))
                      {
                        $queryEnrollGrade="update enroll set Course_grade='O', Grade_point=10 where Roll_no='$r' and C_id=$c;";

                      }
                      else if(($rc>=75)&&($rc<85))
                      {
                        $queryEnrollGrade="update enroll set Course_grade='A+', Grade_point=9 where Roll_no='$r' and C_id=$c;";
                      }
                      else if(($rc>=65)&&($rc<75))
                      {
                        $queryEnrollGrade="update enroll set Course_grade='A', Grade_point=8 where Roll_no='$r' and C_id=$c;";
                      }
                      else if(($rc>=55)&&($rc<65))
                      {
                        $queryEnrollGrade="update enroll set Course_grade='B+', Grade_point=7 where Roll_no='$r' and C_id=$c;";
                      }
                      else if(($rc>=50)&&($rc<55))
                      {
                        $queryEnrollGrade="update enroll set Course_grade='B', Grade_point=6 where Roll_no='$r' and C_id=$c;";
                      }
                      else if(($rc>=45)&&($rc<50))
                      {
                        $queryEnrollGrade="update enroll set Course_grade='C', Grade_point=5 where Roll_no='$r' and C_id=$c;";
                      }
                      else if(($rc>=40)&&($rc<45))
                      {
                        $queryEnrollGrade="update enroll set Course_grade='P', Grade_point=4 where Roll_no='$r' and C_id=$c;";
                      }
                      else if(($rc<40))
                      {
                        //calculate entitlement marks
                        $queryEntitlement="Select Entitlement_marks from student where Roll_no='$r';";
                        $resultpEntitlement= mysqli_query($connection,$queryEntitlement) or die ("Error in query: ".$queryEntitlement." ".mysqli_connect_error());
                        $rowent= mysqli_fetch_row($resultpEntitlement);
                        $ent=$rowent[0];

                        if($ent>0 && $counter<1)
                        {
                          $rc=$rc+$ent;
                          if(($rc>=50)&&($rc<55))
                          {
                            $queryEnrollGrade="update enroll set Course_grade='\$B', Grade_point=6 where Roll_no='$r' and C_id=$c;"; $counter=$counter+1;
                          }
                          else if(($rc>=45)&&($rc<50))
                          {
                            $queryEnrollGrade="update enroll set Course_grade='\$C', Grade_point=5 where Roll_no='$r' and C_id=$c;"; $counter=$counter+1;
                          }
                          else if(($rc>=40)&&($rc<45))
                          {
                            $queryEnrollGrade="update enroll set Course_grade='\$P', Grade_point=4 where Roll_no='$r' and C_id=$c;"; $counter=$counter+1;
                          }
                          else if(($rc<40))
                          {
                            $queryEnrollGrade="update enroll set Course_grade='F', Grade_point=0 where Roll_no='$r' and C_id=$c;"; $counter=$counter+1;
                          }
                        }
                        else {
                          $queryEnrollGrade="update enroll set Course_grade='F', Grade_point=0 where Roll_no='$r' and C_id=$c;";
                        }
                      }
                      $resultEnrollGrade = mysqli_query($connection,$queryEnrollGrade) or die ("Error in query: ".$queryEnrollGrade." ".mysqli_connect_error());
                    }
                    //SPI Calculations INCOMPLETE
                    //for each semester in a program, calculate sum of all courses in the semester and divide by 10, insert it into table SPI
                    $queryprog="Select P_id from program;";
                    $resultprog = mysqli_query($connection,$queryprog) or die ("Error in query: ".$queryprog." ".mysqli_connect_error());

                    if($resultprog)
                    {
                    while ($rowp= mysqli_fetch_row($resultprog))
                    {
                      $pid=$rowp[0];
                      $querysem="Select Sem_id from semester;";
                      $resultsem = mysqli_query($connection,$querysem) or die ("Error in query: ".$querysem." ".mysqli_connect_error());

                      if($resultsem)
                      {
                        while ($row= mysqli_fetch_row($resultsem))
                        {
                          $sid=$row[0];
                          //for each semester and program get course list
                          $queryInsertSem="Select sum(Grade_point)/10 from enroll
                                          inner join semester_courses on enroll.C_id=semester_courses.Course_id
                                          inner join student using(Roll_no)
                                          where semester_courses.Sem_id=$sid and semester_courses.Prog_id=$pid and enroll.Roll_no='$r';";
                          $resultInsertSem = mysqli_query($connection,$queryInsertSem) or die ("Error in query: ".$queryInsertSem." ".mysqli_connect_error());
                          while($rowspi= mysqli_fetch_row($resultInsertSem))
                          {$spi=$rowspi[0];
                          if($spi)
                          {
                          $queryInsertSpi="Update student_spi set SPI= $spi where Roll_no='$r' and Sem_id=$sid;";
                          $resultInsertSpi = mysqli_query($connection,$queryInsertSpi) or die ("Error in query: ".$queryInsertSpi." ".mysqli_connect_error());
                        }

                        }
                        //CPI CALCULATION
                        $queryGetSpi = "select sum(SPI)/count(SPI) from student_spi where Roll_no='$r';";
                        $resultGetSpi = mysqli_query($connection,$queryGetSpi) or die ("Error in query: ".$queryGetSpi." ".mysqli_connect_error());
                        $rowcpi= mysqli_fetch_row($resultGetSpi);
                        $cpi=$rowcpi[0];
                        if($cpi)
                        {
                        $queryEnterCpi = "update student set CPI=$cpi where Roll_no='$r';";
                        $resultEnterCpi = mysqli_query($connection,$queryEnterCpi) or die ("Error in query: ".$queryEnterCpi." ".mysqli_connect_error());


                        }
                        }
                      }
                    }
                    }

                  }


                }
              }

//------------------SPI CALCULATED---------------------------BELOW: Search result


              if (isset($prog)&& ($prog!='-1'))
              {
                if(isset($class)&& ($class!='-1'))
                {
                  if(isset($semester)&& ($semester!='-1'))
                  {
                $queryres="select student.Roll_no, student.Fname, student.Mname, student.Lname, student_spi.Sem_id,student_spi.SPI FROM student
                          INNER JOIN student_spi USING (Roll_no)
                          where student.Program=$prog and student.Education_year='$class' and student_spi.Sem_id=$semester;";
                  }
                  else
                  {
                    $queryres="select student.Roll_no, student.Fname, student.Mname, student.Lname, student_spi.Sem_id,student_spi.SPI FROM student
                              INNER JOIN student_spi USING (Roll_no)
                              where student.Program=$prog and student.Education_year='$class';";
                  }
                }
                else
                {
                  if(isset($semester)&& ($semester!='-1'))
                  {
                  $queryres="select student.Roll_no, student.Fname, student.Mname, student.Lname, student_spi.Sem_id,student_spi.SPI FROM student
                            INNER JOIN student_spi USING (Roll_no)
                            where student.Program=$prog and student_spi.Sem_id=$semester;";
                  }
                  else
                  {
                    $queryres="select student.Roll_no, student.Fname, student.Mname, student.Lname, student_spi.Sem_id,student_spi.SPI FROM student
                              INNER JOIN student_spi USING (Roll_no)
                              where student.Program=$prog;";
                  }
                }
              }
              else
              {
                if(isset($class)&& ($class!='-1'))
                {
                  if(isset($semester)&& ($semester!='-1'))
                  {
                  $queryres="select student.Roll_no, student.Fname, student.Mname, student.Lname, student_spi.Sem_id,student_spi.SPI FROM student
                            INNER JOIN student_spi USING (Roll_no)
                            where student.Education_year='$class' and student_spi.Sem_id=$semester;";
                  }
                  else
                  {
                    $queryres="select student.Roll_no, student.Fname, student.Mname, student.Lname, student_spi.Sem_id,student_spi.SPI FROM student
                              INNER JOIN student_spi USING (Roll_no)
                              where student.Education_year='$class';";
                  }
                }
                else
                {
                  if(isset($semester)&& ($semester!='-1'))
                  {
                  $queryres="select student.Roll_no, student.Fname, student.Mname, student.Lname, student_spi.Sem_id,student_spi.SPI FROM student
                            INNER JOIN student_spi USING (Roll_no)
                            where student_spi.Sem_id=$semester;";
                  }
                  else
                  {
                    $queryres="select student.Roll_no, student.Fname, student.Mname, student.Lname, student_spi.Sem_id,student_spi.SPI FROM student
                              INNER JOIN student_spi USING (Roll_no);";
                  }
                }
              }

              $resultres = mysqli_query($connection,$queryres) or die ("Error in query: ".$queryres." ".mysqli_connect_error());

              if(mysqli_num_rows($resultres)>0)
              {
                echo "<table class='table table-striped' id='studdata'>";
                echo "<tr><th>Roll_no</th><th>Name</th><th>Semester</th><th>SPI</th><th>Action</th></tr>";
              while ($row= mysqli_fetch_row($resultres))
              {
                echo "<tr>";
                echo "<td>".$row[0]."</td>";
                echo "<td>".$row[1]." ".$row[2]." ".$row[3]."</td>";
                echo "<td>".$row[4]."</td>";
                echo "<td>".$row[5]."</td>";
                echo "<td><a href='result-dec.php?roll=".$row[0]."&&sem=".$row[4]."'><button type='button' value='Result'>Result</button></a></td>";
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
