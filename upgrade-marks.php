<?php
include "Db_Connection.php"; // db connection
if(isset($_POST["rbutton"]))
{
if($_REQUEST['rbutton']=="Edit") //---------------------------------------------------------------------------------------------------------------------------------ADD BUTTON
{


include "Db_Connection.php"; // db connection
    $roll=$_POST["rollno"];
  $cours=$_POST["coursid"];
  echo "<script>alert('$roll  $cours');</script>";


  $queryCh = "Select test_conducted.Test_id,test.T_name from test_conducted
              inner join test using(Test_id)
              where Roll_no='$roll' and test.Course=$cours;";
  $resultCh = mysqli_query($connection,$queryCh) or die ("Error in query: ".$queryCh." ".mysqli_connect_error());
  while($row=mysqli_fetch_row($resultCh))
  {
    $mk=$_POST["$row[1]"];

    $queryTest = "update test_conducted set test_conducted.Obtained_marks=$mk
                where Roll_no='$roll' and test_conducted.Test_id=".$row[0].";";
    $resultTest = mysqli_query($connection,$queryTest) or die ("Error in query: ".$queryTest." ".mysqli_connect_error());
  }
  echo "<script>alert('Edit Successful');</script>";
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

  function togglePopupedit() //refered from https://www.gitto.tech/posts/simple-popup-box-using-html-css-and-javascript/
  {
    document.getElementById("popup-editst").classList.toggle("active");
  }
  function togglePopupaddst() //refered from https://www.gitto.tech/posts/simple-popup-box-using-html-css-and-javascript/
  {
    document.getElementById("popup-addst").classList.toggle("active");
  }

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

      $(document).ready(function(){           //Filter dynamic course list
          $('.Rollbutton').click(function(){
              var r = $(this).val();
              var c= $("#"+r).text();
              if(r){
                  $.ajax({
                      url:"upgrade-marksEdit.php",
                      method:"POST",
                      data: {r:r,c:c},
                      success:function(html){
                          $('#editcourse-admin').html(html); //change the innerhtml of
                      }
                  });
              }else{
                  $('#editcourse-admin').html('Oops!Something went wrong');
              }
          });
      });




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

      function validates()
      {
        var d=document.sfilter.sdept.value;
        var p=document.sfilter.tprog.value;
        var c=document.sfilter.tcours.value;
        if(d=="-1")
         {
          alert("Please choose Department");
            return false;
         }
         if(p=="-1")
          {
           alert("Please choose Program");
             return false;
          }
          if(c=="-1")
           {
            alert("Please choose Course");
              return false;
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
            <div class="adminfunction"><img id="functionicon-admin" src="images/markicon.png">&nbsp<span id="functiontitle-admin"> Marks</span></div>
          </div>
          <form id="studentfilter" name="sfilter" action="" method="POST" onsubmit="return validates()">
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

                //2- Select all tests in a course and place them as headers
                $query2 = "Select Test.Test_id, test.T_name from test where test.Course=$cours;";
                $result2 = mysqli_query($connection,$query2) or die ("Error in query: ".$query2." ".mysqli_connect_error());
                echo "<table class='table table-striped' id='mktable'>";
                echo "<tr><th>Roll no.</th><th>Course ID.</th>";
                while($rowc=mysqli_fetch_row($result2))
                {
                  echo "<th>".$rowc[1]."</th>";
                }
                echo "<th>Action</th></tr>";

                $queryroll = "Select student.Roll_no from student where program=$prog;";
                $resultroll = mysqli_query($connection,$queryroll) or die ("Error in query: ".$queryroll." ".mysqli_connect_error());
                while($rowr=mysqli_fetch_row($resultroll))
                {
                  //3- for each roll number in the program and enrolled in course, get obtained marks and place them in the cells in every row
                  echo "<tr><td>".$rowr[0]."</td><td id=".$rowr[0].">$cours</td>";

                  $queryGetMk = "Select test_conducted.Obtained_marks from test_conducted
                            INNER JOIN test using(Test_id)
                            where test.Course=$cours and test_conducted.Roll_no='".$rowr[0]."';";
                  $resultGetMk = mysqli_query($connection,$queryGetMk) or die ("Error in query: ".$queryGetMk." ".mysqli_connect_error());
                  while ($rowmk=mysqli_fetch_row($resultGetMk))
                  {
                    echo "<td>".$rowmk[0]."</td>";
                  }
                  echo "<td><button type='button' class='Rollbutton' name='Rollbutton' value='".$rowr[0]."' onclick='togglePopupedit()'>Edit</button></td>";
                  echo "</tr>";
                }
                echo "</table>";


              }}
              ?>

              <div class="popup" id="popup-editst">
                <div class="overlay"></div>
                <div class="stcontent">
                <div class="close-btn" onclick="togglePopupedit()">×</div><!--popup content-->
                  <span id="addform-title">Edit Student Marks</span><br>
                  <div id="st-addform"><form id="editcourse-admin" name="addst"  action="" method="POST" onSubmit="return validateAddTest()">


                  </form></div>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>
  </body>
</html>
