<?php
include "Db_Connection.php"; // db connection
if(isset($_POST["button"]))
{
if($_REQUEST['button']=="Add") //---------------------------------------------------------------------------------------------------------------------------------ADD BUTTON
{
  include "Db_Connection.php"; // db connection

  $roll = $_POST["sroll"];//get values from form and place them in variables
  $fname=$_POST["sfname"];
  $mname = $_POST["smname"];
  $lname = $_POST["slname"];
  $doj = $_POST["sjdate"];
  $prog = $_POST["sprog"];
  $ay = $_POST["say"];

  $queryvalidate = "select * from student where Roll_no='$roll';";
  $resultvalidate = mysqli_query($connection,$queryvalidate) or die ("Error in query: ".$queryvalidate." ".mysqli_connect_error());
  $check=mysqli_fetch_row($resultvalidate);
  if($check>0)
  {
    echo "<script>alert('OOPS! Student with that roll no. already exists');</script>";
  }
  else
  {
    //mettez dans Student tableau
    $query = "INSERT INTO student(Roll_no,Fname,Mname,Lname,Dateofjoin,Education_year,program) VALUES ('$roll','$fname','$mname','$lname','$doj','$ay',$prog);";
    $result = mysqli_query($connection,$query) or die ("Error in query: ".$query." ".mysqli_connect_error());

    //enroll student in every course belonging to the selected program
    //cours choisis par le college- avant

    $query2="Select Course_id from semester_courses where Prog_id=$prog;";
    $result2 = mysqli_query($connection,$query2) or die ("Error in query: ".$query2." ".mysqli_connect_error());

    if($result2)
    {
    while ($row= mysqli_fetch_row($result2))  //mettez dans sem_cours tableau
    {
      $cid=$row[0];
      $query3="insert into enroll(C_id, Roll_no) values($cid,'$roll');";
      $result3 = mysqli_query($connection,$query3) or die ("Error in query: ".$query3." ".mysqli_connect_error());

      $querytestid="Select Test_id from test where Course=$cid;";
      $resulttestid = mysqli_query($connection,$querytestid) or die ("Error in query: ".$querytestid." ".mysqli_connect_error());

      if($resulttestid)
      {
        while ($id= mysqli_fetch_row($resulttestid))
        {
          $queryinsertIntoTest="insert into test_conducted(Test_id,Roll_no)values($id[0],'$roll');";
      $resultinsertIntoTest = mysqli_query($connection,$queryinsertIntoTest) or die ("Error in query: ".$queryinsertIntoTest." ".mysqli_connect_error());
      }  }



    }
    }
    //insert rows in Student_SPI for SPI calculations
    $querysem="Select Sem_id from semester;";
    $resultsem = mysqli_query($connection,$querysem) or die ("Error in query: ".$querysem." ".mysqli_connect_error());

    if($resultsem)
    {
    while ($row= mysqli_fetch_row($resultsem))  //mettez dans sem_cours tableau
    {
      $sid=$row[0];
      $queryInsertSem="insert into student_spi(Sem_id, Roll_no) values($sid,'$roll');";
      $resultInsertSem = mysqli_query($connection,$queryInsertSem) or die ("Error in query: ".$queryInsertSem." ".mysqli_connect_error());
    }
    }


    echo "<script>alert('Student added Successfully');</script>";
  }
  mysqli_close($connection);
}
else if($_REQUEST['button']=="Update") //----------------------------------------------------------------------------------------------------------------------------UPDATE BUTTON
{
  $roll = $_POST["sroll"];//get values from form and place them in variables
  $fname=$_POST["sfname"];
  $mname = $_POST["smname"];
  $lname = $_POST["slname"];
  $doj = $_POST["sjdate"];
  $prog = $_POST["sprog"];
  $ay = $_POST["say"];

  $queryvalidate = "select * from student where Roll_no='$roll';";
  $resultvalidate = mysqli_query($connection,$queryvalidate) or die ("Error in query: ".$queryvalidate." ".mysqli_connect_error());
  $check=mysqli_fetch_row($resultvalidate);
  if(($check==0 )|| ($check==null))
  {
    echo "<script>alert('OOPS! Student with that roll no. doesn\'t exist');</script>";
  }
  else
  {
  //verife tous noms pour vider
  if(isset($fname)&& ($fname!=null) && ($fname!=""))
  {
    $query1 = "update student set Fname='$fname' where Roll_no='$roll';";
    $result1 = mysqli_query($connection,$query1) or die ("Error in query: ".$query1." ".mysqli_connect_error());
  }
  if(isset($mname)&& ($mname!=null) && ($mname!=""))
  {
    $query2 = "update student set Mname='$mname' where Roll_no='$roll';";
    $result2 = mysqli_query($connection,$query2) or die ("Error in query: ".$query2." ".mysqli_connect_error());
  }
  if(isset($lname)&& ($lname!=null) && ($lname!=""))
  {
    $query3 = "update student set Lname='$lname' where Roll_no='$roll';";
    $result3 = mysqli_query($connection,$query3) or die ("Error in query: ".$query3." ".mysqli_connect_error());
  }
  if(isset($doj)&& ($doj!=null) && ($doj!=""))
  {
    $query4 = "update student set Dateofjoin='$doj' where Roll_no='$roll';";
    $result4 = mysqli_query($connection,$query4) or die ("Error in query: ".$query4." ".mysqli_connect_error());
  }
  if(isset($prog)&& ($prog!=null) && ($prog!="-1"))
  {
    $query5 = "update student set Program='$prog' where Roll_no='$roll';";
    $result5 = mysqli_query($connection,$query5) or die ("Error in query: ".$query5." ".mysqli_connect_error());

    $query7="delete from enroll where roll_no='$roll';";
    $result7 = mysqli_query($connection,$query7) or die ("Error in query: ".$query7." ".mysqli_connect_error());

    $querydeltestcond="delete from test_conducted where roll_no='$roll';";
    $resultdeltestcond = mysqli_query($connection,$querydeltestcond) or die ("Error in query: ".$querydeltestcond." ".mysqli_connect_error());

    $query7="Select Course_id from semester_courses where Prog_id=$prog;";
    $result7 = mysqli_query($connection,$query7) or die ("Error in query: ".$query7." ".mysqli_connect_error());
    if($result7)
    {
    while ($row= mysqli_fetch_row($result7))  //mettez dans sem_cours tableau
    {
      $cid=$row[0];
      $query8="insert into enroll(C_id, Roll_no) values($cid,'$roll');";
      $result8 = mysqli_query($connection,$query8) or die ("Error in query: ".$query8." ".mysqli_connect_error());

      $querytestid="Select Test_id from test where Course=$cid;";
      $resulttestid = mysqli_query($connection,$querytestid) or die ("Error in query: ".$querytestid." ".mysqli_connect_error());
      if($resulttestid)
      {
        while ($id= mysqli_fetch_row($resulttestid))
        {
          $queryinsertIntoTest="insert into test_conducted(Test_id,Roll_no)values($id[0],'$roll');";
      $resultinsertIntoTest = mysqli_query($connection,$queryinsertIntoTest) or die ("Error in query: ".$queryinsertIntoTest." ".mysqli_connect_error());
      }  }
    }
  }
  //INSERT INTO TEST CONDUCTED?????
  }
  if((isset($ay))&&($ay!="-1"))
  {
    $query6 = "update student set Education_year='$ay' where Roll_no='$roll';";
    $result6 = mysqli_query($connection,$query6) or die ("Error in query: ".$query6." ".mysqli_connect_error());
  }
  echo "<script>alert('Student Record Updated Successfully');</script>";
}
  mysqli_close($connection);
}
else if($_REQUEST['button']=="Delete") //------------------------------------------------------------------------------------------------------------------------------DELETE BUTTON
{
  $roll = $_POST["sroll"];//get values from form and place them in variables

  $queryvalidate = "select * from student where Roll_no='$roll';";
  $resultvalidate = mysqli_query($connection,$queryvalidate) or die ("Error in query: ".$queryvalidate." ".mysqli_connect_error());
  $check=mysqli_fetch_row($resultvalidate);
  if(($check==0 )|| ($check==null))
  {
    echo "<script>alert('OOPS! Student with that roll no. doesn\'t exist');</script>";
  }
  else
  {
    //efface dans sem_cours tableau (voir le autre tableux)
    $querydelen = "delete from enroll where roll_no='$roll';";
    $resultdelen = mysqli_query($connection,$querydelen) or die ("Error in query: ".$querydelen." ".mysqli_connect_error());

    $querydelsp = "delete from student_spi where Roll_no='$roll';";
    $resultdelsp = mysqli_query($connection,$querydelsp) or die ("Error in query: ".$querydelsp." ".mysqli_connect_error());

    $querydeltest = "delete from test_conducted where Roll_no='$roll';";
    $resultdeltest = mysqli_query($connection,$querydeltest) or die ("Error in query: ".$querydeltest." ".mysqli_connect_error());

    //efface dans Student tableau
    $querydelstud = "delete from student where Roll_no='$roll';";
    $resultdelstud = mysqli_query($connection,$querydelstud) or die ("Error in query: ".$querydelstud." ".mysqli_connect_error());

    echo "<script>alert('Student Record Deleted Successfully');</script>";
}
  mysqli_close($connection);
}
}
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
  function togglePopupaddst() //refered from https://www.gitto.tech/posts/simple-popup-box-using-html-css-and-javascript/
  {
    document.getElementById("popup-addst").classList.toggle("active");
  }
  function togglePopupupdatest()
  {
    document.getElementById("popup-updatest").classList.toggle("active");
  }
  function togglePopupdeletest()
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
    var regEx = /^[A-Z][a-z\s]*$/;

    if(r==null||r=="")
     {
      alert("Please enter Rollno");    //roll num
      return false;
     }
    if(x==null||x=="")
     {
      alert("Please enter First name");    //FIrst name
      return false;
     }
     if(!(x.match(regEx)))
      {
     alert(	"Oops! invalid First name!"	);
    return	false;
      }
    if((y!=null)&&(y!=""))
     {if(!(isNaN(y)))
      {
        alert(	"Oops! invalid Middle name!"	);
        return false;
      }}
     if(z==null||z=="")
      {
       alert("Please enter Last name");     //last name
       return false;
      }
      if(!(z.match(regEx)))
       {
         alert(	"Oops! invalid Last name!"	);
         return false;
       }
      if(datevalidation(date)==false)
      {
       alert("Please enter correct date format");     //date
       return false;
      }
      if (document.addst.sprog.value == "-1")
      {
        alert("please choose the program");        //Program
        return false;
      }
      if (document.addst.say.value == "-1")
      {
        alert("please choose the class");        //Program
        return false;
      }
    return true;
    }

    function validateUpdateStudent()
    {
      var	x=document.updatest.sfname.value;
      var	y=document.updatest.smname.value;
      var	z=document.updatest.slname.value;
      var	r=document.updatest.sroll.value;
      var	date=document.updatest.sjdate.value;
      var regEx = /^[A-Z][a-z\s]*$/;
      if(r==null||r=="")
       {
        alert("Please enter Rollno");    //roll num
        return false;
       }
       if((x!=null)&&(x!=""))
       {
         if(!(x.match(regEx)))
          {
            alert(	"Oops! invalid name!"	);
            return false;
          }
       }
       if((y!=null)&&(y!=""))
       {
         if(!(y.match(regEx)))
          {
            alert(	"Oops! invalid name!"	);
            return false;
          }
       }
       if((z!=null)&&(z!=""))
       {
         if(!(z.match(regEx)))
          {
            alert(	"Oops! invalid name!"	);
            return false;
          }
       }
      if(date!=null&&date!="")
      {
        if(datevalidation(date)==false)
        {
         alert("Please enter correct date format");     //date
         return false;
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
            <div class="adminfunction"><img id="functionicon-admin" src="images/studenticon.png">&nbsp<span id="functiontitle-admin"> Student</span></div>
          </div>
          <form id="studentfilter" name="sfilter" action="student-incharge.php" method="POST">
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

            <div class="col-4"><!--ADD------------------------------------------------------------------------------------------------------->
              <button class="functionbtn" value="Add" onclick="togglePopupaddst()">Add</button>
              <div class="popup" id="popup-addst">
                <div class="overlay"></div>
                <div class="stcontent">
                  <div class="close-btn" onclick="togglePopupaddst()">×</div><!--popup content-->
                  <span id="addform-title">ADD A STUDENT</span><br>
                  <div id="st-addform"><form id="addcourse-admin" name="addst" action="student-incharge.php" method="POST" onSubmit="return validateAddStudent()">
                    <div class="row mb-3"><div class="col-6">Roll No.</div><div class="col-6"><input class="roundedinput" type="text" name="sroll"></div></div>
                    <div class="row mb-3"><div class="col-6">First Name</div><div class="col-6"><input class="roundedinput" type="text" name="sfname"></div></div>
                    <div class="row mb-3"><div class="col-6">Middle Name</div><div class="col-6"><input class="roundedinput" type="text" name="smname"></div></div>
                    <div class="row mb-3"><div class="col-6">Last Name</div><div class="col-6"><input class="roundedinput" type="text" name="slname"></div></div>
                    <div class="row mb-3"><div class="col-6">Date of Joining(yyyy-mm-dd)</div><div class="col-6"><input class="roundedinput" type="date" name="sjdate"></div></div>
                    <div class="row mb-3"><div class="col-6">Program</div>
                      <div class="col-6"><select class="roundedinputselect" name="sprog" required><option value="-1" selected>Choose Program</option><option value="1">BCA</option><option value="2">BBA</option><option value="3">BAMC</option></select></div>
                    </div>
                    <div class="row mb-3"><div class="col-6">Academic year</div>
                      <div class="col-6"><select class="roundedinputselect" name="say" ><option value="-1" selected>Choose year</option><option value="1">FY</option><option value="2">SY</option><option value="3">TY</option></select></div>
                    </div>
                    <div class="row mb-3"><center><input type="submit" name="button" value="Add" id="add-coursebtn"></center></div>
                  </form></div>
                </div>
              </div>
            </div>

            <div class="col-4"><!-- UPDATE------------------------------------------------------------------------------------------------------->
              <button class="functionbtn" value="update" onclick="togglePopupupdatest()">Update</button>
              <div class="popup" id="popup-updatest">
                <div class="overlay"></div>
                <div class="stcontent">
                  <div class="close-btn" onclick="togglePopupupdatest()">×</div><!--popup content-->
                  <span id="addform-title">UPDATE STUDENT</span><br>
                  <div id="st-addform"><form id="addcourse-admin" name="updatest" action="student-incharge.php" method="POST" onsubmit="return validateUpdateStudent()">
                    <div class="row mb-3"><div class="col-6">Roll No.</div><div class="col-6"><input class="roundedinput" type="text" name="sroll"></div></div>
                    <div class="row mb-3"><div class="col-6">First Name</div><div class="col-6"><input class="roundedinput" type="text" name="sfname"></div></div>
                    <div class="row mb-3"><div class="col-6">Middle Name</div><div class="col-6"><input class="roundedinput" type="text" name="smname"></div></div>
                    <div class="row mb-3"><div class="col-6">Last Name</div><div class="col-6"><input class="roundedinput" type="text" name="slname"></div></div>
                    <div class="row mb-3"><div class="col-6">Date of Joining(yyyy-mm-dd)</div><div class="col-6"><input class="roundedinput" type="date" name="sjdate"></div></div>
                    <div class="row mb-3"><div class="col-6">Program</div>
                      <div class="col-6"><select class="roundedinputselect" name="sprog"><option value="-1" selected>Choose Program</option><option value="1">BCA</option><option value="2">BBA</option><option value="3">BAMC</option></select></div>
                    </div>
                    <div class="row mb-3"><div class="col-6">Academic year</div>
                      <div class="col-6"><select class="roundedinputselect" name="say"><option value="-1" selected>Choose year</option><option value="1">FY</option><option value="2">SY</option><option value="3">TY</option></select></div>
                    </div>
                    <div class="row mb-3"><center><input type="submit" name="button" value="Update" id="add-coursebtn"></center></div>
                  </form></div>
                </div>
              </div>
            </div>
            <div class="col-4">
              <button class="functionbtn" value="delete" onclick="togglePopupdeletest()">Delete</button>
              <div class="popup" id="popup-deletest">
                <div class="overlay"></div>
                <div class="stcontent">
                  <div class="close-btn" onclick="togglePopupdeletest()">×</div><!--popup content-->
                  <span id="addform-title">DELETE A STUDENT</span><br>
                  <div id="st-addform"><form id="addcourse-admin" name="deletest" action="student-incharge.php" method="POST" onsubmit="return validateDeleteStudent()">
                    <div class="row mb-3"><div class="col-6">Roll No.</div><div class="col-6"><input class="roundedinput" type="text" name="sroll"></div></div>
                    <div class="row mb-3"><center><input type="submit" name="button" value="Delete" id="add-coursebtn"></center></div>
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
