<?php
include "Db_Connection.php"; // db connection
if(isset($_POST["button"]))
{
if($_REQUEST['button']=="Add") //---------------------------------------------------------------------------------------------------------------------------------ADD BUTTON
{

  $roll = $_POST["sroll"];
  $mk=$_POST["smk"];
  if(($mk<0 )|| ($mk>10))
  {
    echo "<script>alert('OOPS! Enter entitlement marks between 0 and 10');</script>";
  }
  else
  {
  //mettez dans Student tableau
  $query = "Update student set Entitlement_marks=$mk where Roll_no='$roll';";
  $result = mysqli_query($connection,$query) or die ("Error in query: ".$query." ".mysqli_connect_error());

  echo "<script>alert('Entitlement marks added successfully');</script>";
  mysqli_close($connection);
}}
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

      $(document).ready(function(){           //Filter dynamic course list
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

      function togglePopupaddst() //refered from https://www.gitto.tech/posts/simple-popup-box-using-html-css-and-javascript/
      {
        document.getElementById("popup-addst").classList.toggle("active");
      }

      function validateem()
      {
        var s=document.addst.sroll.value;
        var r=document.addst.smk.value;
        if(s==null||s=="")
         {
          alert("Please enter student roll number");
            return false;

         }
         if(r==null||r=="")
          {
           alert("Please enter Entitlement marks");
             return false;

          }
        if(isNaN(r))
          {
        alert(	"Oops! Entitlement Marks are Numeric!"	);
        return	false;
          }
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
            <div class="adminfunction"><img id="functionicon-admin" src="images/markicon.png">&nbsp<span id="functiontitle-admin"> Marks</span></div>
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
              <button class="functionbtn" id="AddAtten" name ="button" value="Add" onclick="togglePopupaddst()">Add Entitlement Marks</button>
              <div class="popup" id="popup-addst">
                <div class="overlay"></div>
                <div class="stcontent">
                  <div class="close-btn" onclick="togglePopupaddst()">×</div><!--popup content-->
                  <span id="addform-title">ADD STUDENT ENTITLEMENT MARKS</span><br>
                  <div id="st-addform"><form id="addcourse-admin" name="addst" method="POST" onSubmit="return validateem()">
                    <div class="row mb-3"><div class="col-6">Roll No.</div><div class="col-6"><input class="roundedinput" type="text" name="sroll"></div></div>
                    <div class="row mb-3"><div class="col-6">Entitlement marks </div><div class="col-6"><input class="roundedinput" type="text" name="smk"></div></div>
                    <div class="row mb-3"><center><input type="submit" name="button" value="Add" id="add-coursebtn"></center></div>
                  </form></div>
                </div>
              </div>
            </div>
          <div class="searchresults">
          <?php
          if(isset($_POST['button']))
          {
            if($_REQUEST['button']=="Search") //----------------------------------------------------------------------------------------------------------------FILTER BUTTON
            {
              $dept = $_POST["sdept"];
              $prog = $_POST["tprog"];
              $cours = $_POST["tcours"];

              if(isset($cours)&& ($cours!="-1"))
              {
                $query2 = "Select Test_conducted.Test_id,Test.T_name,test_conducted.Roll_no,student.Fname,student.Lname,test_conducted.Obtained_marks,test_conducted.Attempt_no from test
                          inner join test_conducted USING (Test_id)
                          inner join student using(Roll_no)
                          where test.Course=$cours
                          order by Test_conducted.Test_id;";
              }
              else if (isset($prog)&& ($prog!='-1'))
              {
                $query2="Select Test_conducted.Test_id,Test.T_name,test_conducted.Roll_no,student.Fname,student.Lname,test_conducted.Obtained_marks,test_conducted.Attempt_no from test
                        inner join test_conducted USING (Test_id)
                        inner join semester_courses on test.Course=semester_courses.Course_id
                        inner join student using(Roll_no)
                        where semester_courses.Prog_id=$prog and student.Program=$prog
                        order by Test_conducted.Test_id;";
              }
              else if(isset($dept)&& ($dept!='-1'))
              {
                $query2="Select Test_conducted.Test_id,Test.T_name,test_conducted.Roll_no,student.Fname,student.Lname,test_conducted.Obtained_marks,test_conducted.Attempt_no from test inner join test_conducted USING (Test_id)
                        inner join semester_courses on test.Course=semester_courses.Course_id
                        inner join program on program.P_id=semester_courses.Prog_id
                        inner join student using(Roll_no)
                        where program.Department=$dept and student.Program=(SELECT program.P_id from program where program.Department=$dept)
                        order by Test_conducted.Test_id;";
              }
              else
              {
                $query2 = "Select Test_conducted.Test_id,Test.T_name,test_conducted.Roll_no,student.Fname,student.Lname,test_conducted.Obtained_marks,test_conducted.Attempt_no from test inner join test_conducted USING (Test_id) inner join student using(Roll_no) order by Test_conducted.Test_id;";
              }

              $result2 = mysqli_query($connection,$query2) or die ("Error in query: ".$query2." ".mysqli_connect_error());

              if(mysqli_num_rows($result2)>0)
              {
                echo "<table class='table table-striped' id='studdata'>";
                echo "<tr><th>Test ID</th><th>Test Name</th><th>Roll No.</th><th>Student Name</th><th>Marks</th><th>Attempt no.</th></tr>";
              while ($row= mysqli_fetch_row($result2))
              {
                echo "<tr id='".$row[0]."'>";
                echo "<td>".$row[0]."</td>";
                echo "<td>".$row[1]."</td>";
                echo "<td>".$row[2]."</td>";
                echo "<td>".$row[3]." ".$row[4]."</td>";
                echo "<td>".$row[5]."</td>";
                echo "<td>".$row[6]."</td>";
                echo "<td><a href='edit-marks.php?tid=".$row[0]."'><button type='button' value='Edit'>Edit</button></a></td>";
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
