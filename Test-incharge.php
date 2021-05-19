<?php
include "Db_Connection.php"; // db connection
if(isset($_POST["button"]))
{
if($_REQUEST['button']=="Add") //---------------------------------------------------------------------------------------------------------------------------------ADD BUTTON
{
  include "Db_Connection.php"; // db connection

  $name=$_POST["tname"];
  $cat = $_POST["tcat"];
  $date = $_POST["tdate"];
  $max = $_POST["tmax"];
  $cours = $_POST["tcours"];
  $prog = $_POST["tprog"];

  //mettez dans test tableau
  $query = "INSERT INTO test(T_name,Date_conducted,Max_marks,Test_Category,Course) VALUES ('$name','$date',$max,'$tcat',$cours);";
  $result = mysqli_query($connection,$query) or die ("Error in query: ".$query." ".mysqli_connect_error());

  //mettez dans test_conducted tableau parceque le etudient repondront un jour

  $query4="Select Test_id from Test where program='$prog' and Date_conducted='$date' and T_name='$name';";
  $result4 = mysqli_query($connection,$query4) or die ("Error in query: ".$query4." ".mysqli_connect_error());
  $id= mysqli_fetch_row($result4)

  $query2="Select Roll_no from student where program='$prog';";
  $result2 = mysqli_query($connection,$query2) or die ("Error in query: ".$query2." ".mysqli_connect_error());

  if($result2)
  {
  while ($row= mysqli_fetch_row($result2))  //mettez dans sem_cours tableau
  {
    $query3="insert into test_conducted(Test_id,Roll_no)values($id,'$row[0]');";
    $result3 = mysqli_query($connection,$query3) or die ("Error in query: ".$query3." ".mysqli_connect_error());
  }
  }
  echo "<script>alert('Test added Successfully');</script>";
  mysqli_close($connection);
}
else if($_REQUEST['button']=="Update") //----------------------------------------------------------------------------------------------------------------------------UPDATE BUTTON
{
  $name=$_POST["tname"];
  $cat = $_POST["tcat"];
  $date = $_POST["tdate"];
  $max = $_POST["tmax"];
  $cours = $_POST["tcours"];
  $prog = $_POST["tprog"];

  //verife tous noms pour vider noms
  if(isset($name)&& ($name!=null) && ($name!=""))
  {
    $query1 = "update student set Fname='$fname' where Roll_no='$roll';";
    $result1 = mysqli_query($connection,$query1) or die ("Error in query: ".$query1." ".mysqli_connect_error());
  }
  if(isset($cat)&& ($cat!='-1')))
  {
    $query2 = "update student set Mname='$mname' where Roll_no='$roll';";
    $result2 = mysqli_query($connection,$query2) or die ("Error in query: ".$query2." ".mysqli_connect_error());
  }
  if(isset($date)&& ($date!=null) && ($date!=""))
  {
    $query3 = "update student set Lname='$lname' where Roll_no='$roll';";
    $result3 = mysqli_query($connection,$query3) or die ("Error in query: ".$query3." ".mysqli_connect_error());
  }
  if(isset($max)&& ($max!=null) && ($max!=""))
  {
    $query4 = "update student set Dateofjoin='$doj' where Roll_no='$roll';";
    $result4 = mysqli_query($connection,$query4) or die ("Error in query: ".$query4." ".mysqli_connect_error());
  }

///////////////////////CHAnge all the body of above if statements and add course verification below////////////////////////////////////




  if(isset($prog)&& ($prog!=null) && ($prog!=""))
  {
    $query5 = "update student set Program='$prog' where Roll_no='$roll';";
    $result5 = mysqli_query($connection,$query5) or die ("Error in query: ".$query5." ".mysqli_connect_error());

    $query7="delete from enroll where roll_no='$roll';";
    $result7 = mysqli_query($connection,$query7) or die ("Error in query: ".$query7." ".mysqli_connect_error());

    $query7="Select Course_id from semester_courses where Prog_id=$prog;";
    $result7 = mysqli_query($connection,$query7) or die ("Error in query: ".$query7." ".mysqli_connect_error());
    if($result7)
    {
    while ($row= mysqli_fetch_row($result7))  //mettez dans sem_cours tableau
    {
      $cid=$row[0];
      $query8="insert into enroll(C_id, Roll_no) values($cid,'$roll');";
      $result8 = mysqli_query($connection,$query8) or die ("Error in query: ".$query8." ".mysqli_connect_error());
    }
    }
  }
  if(isset($ay))
  {
    $query6 = "update student set Education_year='$ay' where Roll_no='$roll';";
    $result6 = mysqli_query($connection,$query6) or die ("Error in query: ".$query6." ".mysqli_connect_error());
  }
  echo "<script>alert('Student Record Updated Successfully');</script>";
  mysqli_close($connection);
}
else if($_REQUEST['button']=="Delete") //------------------------------------------------------------------------------------------------------------------------------DELETE BUTTON
{
  $roll = $_POST["sroll"];//get values from form and place them in variables

  //efface dans sem_cours tableau (voir le autre tableux)
  $query = "delete from enroll where roll_no='$roll';";
  $result = mysqli_query($connection,$query) or die ("Error in query: ".$query." ".mysqli_connect_error());

  //efface dans Student tableau
  $query = "delete from student where Roll_no='$roll';";
  $result = mysqli_query($connection,$query) or die ("Error in query: ".$query." ".mysqli_connect_error());

  echo "<script>alert('Student Record Deleted Successfully');</script>";
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

  function validateAddTest() //Validates Test name, Test date, Test max marks, test category
  {
    var	x=document.addst.tname.value;
    var	z=document.addst.tcat.value;
    var	r=document.addst.tmax.value;
    var	date=document.addst.tdate.value;
    if(x==null||x=="")
     {
      alert("Please enter Test name");
     }
     if(datevalidation(date)==false)
       {
        alert("Please enter correct date format");
       }
    if(r==null||r=="")
     {
      alert("Please enter Max marks");
     }

     if (z == "-1")
     {
       alert("please choose Test Category");
     }
    return true;
    }

    function validateUpdateTest() //Validates Test id, Test date
    {
      var	r=document.updatest.tid.value;
      if(r==null||r=="")
       {
        alert("Please enter teacher id");
       }
      var	date=document.updatest.tdate.value;
      if(date!=null&&date!="")
      {
        if(datevalidation(date)==false)
        {
         alert("Please enter correct date format");
        }
      }
      return true;
      }

      function validateDeleteStudent()//Validates Test id
      {
        var	r=document.deletest.tid.value;
        if(r==null||r=="")
         {
          alert("Please enter teacher id");
         return true;
      }
    }

    $(document).ready(function(){           //Filter dynamic course list
        $('#tpro').on('change', function(){
            var pid = $(this).val();
            if(pid){
                $.ajax({
                    url:"ajaxData.php",
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

 </script>

</head>
  <body>
    <!--LANDING PAGE BASIC PARTITION-------------------------------------------------->
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
            <div class="adminfunction"><img id="functionicon-admin" src="images/testicon.png">&nbsp<span id="functiontitle-admin"> Test</span></div>
          </div>
          <form id="studentfilter" name="sfilter" action="" method="POST">
         <div class="row">
              <div class="col-6 st-colalign">Department</div><div class="col-6 st-colalign"><select class="roundedinputselect st-input" name="sdept"><option value="-1" selected>Department</option><option value="1">BCA</option><option value="2">BBA</option><option value="3">BAMC</option></select></div>
         </div>
         <div class="row">
             <div class="col-6 st-colalign"> Program</div><div class="col-6 st-colalign"><select class="roundedinputselect st-input" name="tprog" id="tpro"><option value="-1" selected>Program</option><option value="1">BCA</option><option value="2">BBA</option><option value="3">BAMC</option></select></div>
         </div>
         <div class="row">
             <div class="col-6 st-colalign">Course</div><div class="col-6 st-colalign"><select class="roundedinputselect st-input" name="tcours" id="tco">
               <option value="-1" selected>Course</option>
             </select></div>
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
                  <span id="addform-title">ADD A TEST</span><br>
                  <div id="st-addform"><form id="addcourse-admin" name="addst"  method="POST" onSubmit="return validateAddTest()">
                    <div class="row mb-3"><div class="col-6">Test Name</div><div class="col-6"><input class="roundedinput" type="text" name="tname"></div></div>
                    <div class="row mb-3"><div class="col-6">Test Date(yyyy-mm-dd)</div><div class="col-6"><input class="roundedinput" type="text" name="tdate"></div></div>
                    <div class="row mb-3"><div class="col-6">Maximum marks</div><div class="col-6"><input class="roundedinput" type="text" name="tmax"></div></div>
                    <div class="row mb-3"><div class="col-6">Test category</div>
                      <div class="col-6"><select class="roundedinputselect" name="tcat"><option value="-1" selected>category</option><option value="1">ISA</option><option value="2">ESE</option><option value="3">OBT</option><option value="4">Quiz</option><option value="5">Assignment</option><option value="6">Presentation</option></select></div>
                    </div>
                    <div class="row">
                        <div class="col-6 st-colalign"> Program</div><div class="col-6 st-colalign"><select class="roundedinputselect st-input" name="tprog" onchange="run()"><option value="-1" selected>Program</option><option value="1">BCA</option><option value="2">BBA</option><option value="3">BAMC</option></select></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">Course</div><div class="col-6 "><input class="roundedinput st-input" type="text" name="tcourse"></div>
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
                  <span id="addform-title">UPDATE TEST</span><br>
                  <div id="st-addform"><form id="addcourse-admin" name="addst"  method="POST" onSubmit="return validateAddTest()">
                      <div class="row mb-3"><div class="col-6">Test ID</div><div class="col-6"><input class="roundedinput" type="text" name="tid"></div></div>
                    <div class="row mb-3"><div class="col-6">Test Name</div><div class="col-6"><input class="roundedinput" type="text" name="tname"></div></div>
                    <div class="row mb-3"><div class="col-6">Test Date(yyyy-mm-dd)</div><div class="col-6"><input class="roundedinput" type="text" name="tdate"></div></div>
                    <div class="row mb-3"><div class="col-6">Maximum marks</div><div class="col-6"><input class="roundedinput" type="text" name="tmax"></div></div>
                    <div class="row mb-3"><div class="col-6">Test category</div>
                      <div class="col-6"><select class="roundedinputselect" name="tcat"><option value="-1" selected>category</option><option value="1">ISA</option><option value="2">ESE</option><option value="3">OBT</option><option value="4">Quiz</option><option value="5">Assignment</option><option value="6">Presentation</option></select></div>
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
                  <span id="addform-title">DELETE A TEST</span><br>
                  <div id="st-addform"><form id="addcourse-admin" name="deletest" action="" method="POST" onsubmit="return validateDeleteTest()">
                    <div class="row mb-3"><div class="col-6">Test ID</div><div class="col-6"><input class="roundedinput" type="text" name="tid"></div></div>
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
