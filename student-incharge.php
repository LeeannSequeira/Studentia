
<?php
include "Db_Connection.php"; // Using database connection file here
//variables retrieved from form are copied into simpler variable names
if(isset($_POST["button"]))
{
if($_POST["button"]=="Add")
{
$roll = $_POST["sroll"];
$fname=$_POST["sfname"];
$mname = $_POST["smname"];
$lname = $_POST["slname"];
$doj = $_POST["sjdate"];
$prog = $_POST["sprog"];
$ay = $_POST["say"];

//insert into student table
$queryInsertStudent = "INSERT INTO student(Roll_no,Fname,Mname,Lname,Dateofjoin,Education_year,Program) VALUES ('$roll','$fname','$mname','$lname','$doj','$ay',$prog);";
$resultInsertStudent = mysqli_query($connection,$queryInsertStudent) or die ("Error in query: ".$queryInsertStudent." ".mysqli_connect_error());

$queryGetCourses = "Select Course_id from semester_courses where Prog_id='$prog';";
$resultGetCourses = mysqli_query($connection,$queryGetCourses) or die ("Error in query: ".$queryGetCourses." ".mysqli_connect_error());


//mettez dans enroll tableau
while ($row= mysqli_fetch_assoc($result)) {
  $un=$row["T_id"];
}

$queryInsertEnroll = "INSERT INTO enroll(Course_id,Roll_no) VALUES ('$cid','$roll');";
$resultInsertEnroll = mysqli_query($connection,$queryInsertEnroll) or die ("Error in query: ".$queryInsertEnroll." ".mysqli_connect_error());


echo "<script>alert('Added Student Successfully');</script>";
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
            <a class="nav-link" href="student-incharge.html">Student</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="test-incharge.html">Test</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="marks-incharge.html">Marks</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="result-incharge.html">Result</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="hallticket-incharge.html">Hall Ticket</a>
          </li>
        </ul>
      </div>
    </div>
    </nav>
    <!-- END OF NAV---------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="container landing">
      <div class="row landingrow">
        <div class="col-md-3" id="function-left-section"><!-- LEFT PARTITION----------------------------------------------------------------------------------------------------------->
          <div class="row">
            <div class="adminfunction"><img id="functionicon-admin" src="images/studenticon.png">&nbsp<span id="functiontitle-admin"> Student</span></div>
          </div>
          <form id="studentfilter" name="sfilter" action="" method="POST">
         <div class="row">
              <div class="col-6 st-colalign">Department</div><div class="col-6 st-colalign"><select class="roundedinputselect st-input" name="sdept"><option value="-1" selected>Department</option><option value="1">BCA</option><option value="2">BBA</option><option value="3">BAMC</option></select></div>
         </div>
         <div class="row">
             <div class="col-6 st-colalign"> Class</div><div class="col-6 st-colalign"><select class="roundedinputselect st-input" name="sclass"><option value="-1" selected>Class</option><option value="1">FY</option><option value="2">SY</option><option value="3">TY</option></select></div>
         </div>
         <div class="row">
             <div class="col-6 st-colalign"> Rollno</div><div class="col-6 st-colalign"><input class="roundedinput st-input" type="text" name="sroll"></div>
         </div>
         <div class="row">
             <div class="col-12 st-colalign"><center><input type="submit" value="Search" id="st-searchbtn"></center></div>
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
                  <div id="st-addform"><form id="addcourse-admin" name="addst"  method="POST" onSubmit="return validateAddStudent()">
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
                  <div id="st-addform"><form id="addcourse-admin" name="updatest" action="" method="POST" onsubmit="return validateUpdateStudent()">
                    <div class="row mb-3"><div class="col-6">Roll No.</div><div class="col-6"><input class="roundedinput" type="text" name="sroll"></div></div>
                    <div class="row mb-3"><div class="col-6">First Name</div><div class="col-6"><input class="roundedinput" type="text" name="sfname"></div></div>
                    <div class="row mb-3"><div class="col-6">Middle Name</div><div class="col-6"><input class="roundedinput" type="text" name="smname"></div></div>
                    <div class="row mb-3"><div class="col-6">Last Name</div><div class="col-6"><input class="roundedinput" type="text" name="slname"></div></div>
                    <div class="row mb-3"><div class="col-6">Date of Joining(yyyy-mm-dd)</div><div class="col-6"><input class="roundedinput" type="text" name="sjdate"></div></div>
                    <div class="row mb-3"><div class="col-6">Department</div>
                      <div class="col-6"><select class="roundedinputselect" name="sdept"><option value="-1" selected>Choose Department</option><option value="1">BCA</option><option value="2">BBA</option><option value="3">BAMC</option></select></div>
                    </div>
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
                  <div id="st-addform"><form id="addcourse-admin" name="deletest" action="" method="POST" onsubmit="return validateDeleteStudent()">
                    <div class="row mb-3"><div class="col-6">Roll No.</div><div class="col-6"><input class="roundedinput" type="text" name="sroll"></div></div>
                    <div class="row mb-3"><center><input type="submit" name="button" value="Delete" id="add-coursebtn"></center></div>
                  </form></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
