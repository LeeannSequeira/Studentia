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

  $queryval = "select sum(Max_marks) from test where Course=$cours;";
  $resultval = mysqli_query($connection,$queryval) or die ("Error in query: ".$queryval." ".mysqli_connect_error());
  $check=mysqli_fetch_row($resultval);
  $trial=(intval($max)+$check[0]);
  if($trial>100)
  {
    echo "<script>alert('WARNING: Total Marks for this course will exceed 100');</script>";
  }
  else
  {
  //mettez dans test tableau
  $query = "INSERT INTO test(T_name,Date_conducted,Max_marks,Test_Category,Course) VALUES ('$name','$date',$max,'$cat',$cours);";
  $result = mysqli_query($connection,$query) or die ("Error in query: ".$query." ".mysqli_connect_error());

  //mettez dans test_conducted tableau parceque le etudient repondront un jour

  $query4="Select Test_id from test where Course=$cours and Date_conducted='$date' and T_name='$name';";
  $result4 = mysqli_query($connection,$query4) or die ("Error in query: ".$query4." ".mysqli_connect_error());
  $id= mysqli_fetch_row($result4);

  $query2="select Roll_no from student
          inner join semester_courses on student.Program =semester_courses.Prog_id
          where semester_courses.Course_id=$cours;";
  $result2 = mysqli_query($connection,$query2) or die ("Error in query: ".$query2." ".mysqli_connect_error());

  if($result2)
  {
  while ($row= mysqli_fetch_row($result2))  //mettez dans sem_cours tableau
  {
    $query3="insert into test_conducted(Test_id,Roll_no)values($id[0],'$row[0]');";
    $result3 = mysqli_query($connection,$query3) or die ("Error in query: ".$query3." ".mysqli_connect_error());
  }
  }
  echo "<script>alert('Test added Successfully');</script>";
}

}
else if($_REQUEST['button']=="Update") //----------------------------------------------------------------------------------------------------------------------------UPDATE BUTTON
{
  $tid=$_POST["tid"];
  $name=$_POST["tname"];
  $cat = $_POST["tcat"];
  $date = $_POST["tdate"];
  $max = $_POST["tmax"];
  $cours = $_POST["tcours"];

  $queryvalidate = "select * from test where Test_id=$tid;";
  $resultvalidate = mysqli_query($connection,$queryvalidate) or die ("Error in query: ".$queryvalidate." ".mysqli_connect_error());
  $check=mysqli_fetch_row($resultvalidate);
  if(($check==0 )|| ($check==null))
  {
    echo "<script>alert('OOPS! Test doesn\'t exist');</script>";
  }
  else
  {

  $queryval = "select sum(Max_marks) from test where Course=$cours;";
  $resultval = mysqli_query($connection,$queryval) or die ("Error in query: ".$queryval." ".mysqli_connect_error());
  $check=mysqli_fetch_row($resultval);
  $trial=(intval($max)+$check[0]);
  if($trial>100)
  {
    echo "<script>alert('WARNING: Total Marks for this course will exceed 100');</script>";
  }
  else
  {
  //verife tous noms pour vider noms
  if(isset($name)&& ($name!=null) && ($name!=""))
  {
    $query1 = "Update test set T_name='$name' where Test_id=$tid;";
    $result1 = mysqli_query($connection,$query1) or die ("Error in query: ".$query1." ".mysqli_connect_error());
  }
  if(isset($cat)&& ($cat!='-1'))
  {
    $query2 ="Update test set Test_Category='$cat' where Test_id=$tid;";
    $result2 = mysqli_query($connection,$query2) or die ("Error in query: ".$query2." ".mysqli_connect_error());
  }
  if(isset($date)&& ($date!=null) && ($date!=""))
  {
    $query3 = "Update test set Date_conducted='$date' where Test_id=$tid;";
    $result3 = mysqli_query($connection,$query3) or die ("Error in query: ".$query3." ".mysqli_connect_error());
  }
  if(isset($max)&& ($max!=null) && ($max!=""))
  {
    $query4 = "Update test set Max_marks='$max' where Test_id=$tid;";
    $result4 = mysqli_query($connection,$query4) or die ("Error in query: ".$query4." ".mysqli_connect_error());
  }

  if(isset($cours)&& ($cours!='-1'))
  {
    $query5 = "Update test set Course=$cours where Test_id=$tid;";
    $result5 = mysqli_query($connection,$query5) or die ("Error in query: ".$query5." ".mysqli_connect_error());
  }
  echo "<script>alert('Test Record Updated Successfully');</script>";
}}

}
else if($_REQUEST['button']=="Delete") //------------------------------------------------------------------------------------------------------------------------------DELETE BUTTON
{
  $tid=$_POST["tid"];

  $queryvalidate = "select * from test where Test_id=$tid;";
  $resultvalidate = mysqli_query($connection,$queryvalidate) or die ("Error in query: ".$queryvalidate." ".mysqli_connect_error());
  $check=mysqli_fetch_row($resultvalidate);
  if(($check==0 )|| ($check==null))
  {
    echo "<script>alert('OOPS! Test doesn\'t exist');</script>";
  }
  else
  {
  $query6 = "delete from test_conducted where Test_id=$tid;";
  $result6 = mysqli_query($connection,$query6) or die ("Error in query: ".$query6." ".mysqli_connect_error());

  $query = "delete from test where Test_id=$tid;";
  $result = mysqli_query($connection,$query) or die ("Error in query: ".$query." ".mysqli_connect_error());


  echo "<script>alert('Student Record Deleted Successfully');</script>";

}}
}
?>
<html>
<head>
  <title>Studentia Test Page</title>
  <link rel="icon"
    type="image/png"
    href="images/logo-fav.png">
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

    function countWords(str) {
        str = str.replace(/(^\s*)|(\s*$)/gi,"");
        str = str.replace(/[ ]{2,}/gi," ");
        str = str.replace(/\n /,"\n");
        return str.split(' ').length;
     }

  function validateAddTest() //Validates Test name, Test date, Test max marks, test category
  {
    var	x=document.addst.tname.value;
    var	z=document.addst.tcat.value;
    var	r=document.addst.tmax.value;
    var	date=document.addst.tdate.value;
    var	c=document.addst.tcours.value;
    if(x==null||x=="")
     {
      alert("Please enter Test name");
        return false;

     }
     if(countWords(x)>1)
     {
       alert("Test name can only be one word, You can use special characters as word seperaters");
         return false;
     }

     if(datevalidation(date)==false)
       {
        alert("Please enter correct date format");
          return false;

       }
    if(r==null||r=="")
     {
      alert("Please enter Max marks");
        return false;

     }
     if(isNaN(r	))
       {
     alert(	"Oops! Marks must be Numeric!"	);
     return	false;
       }

     if (z == "-1")
     {
       alert("please choose Test Category");
         return false;

     }
     if (c == "-1")
     {
       alert("please choose Test Course");
         return false;

     }
    return true;
    }

    function validateUpdateTest() //Validates Test id, Test date
    {
      var	r=document.updatest.tid.value;
      if(r==null||r=="")
       {
        alert("Please enter Test id");
          return false;

       }
       if(isNaN(r))
         {
       alert(	"Oops! Test ID is Numeric!"	);
       return	false;
         }
         var	x=document.updatest.tname.value;

         if(countWords(x)>1)
         {
           alert("Test name can only be one word, You can use special characters as word seperaters");
             return false;
         }
      var	date=document.updatest.tdate.value;
      if(date!=null&&date!="")
      {
        if(datevalidation(date)==false)
        {
         alert("Please enter correct date format");
           return false;

        }
      }

      var	m=document.updatest.tmax.value;
        if((m!=null)&&(m!=""))
          {if(isNaN(m))
            {
          alert(	"Oops! Marks must be Numeric!"	);
          return	false;
            }}

        return true;
        }
      function validateDeleteTest()//Validates Test id
      {
        var	r=document.deletest.tid.value;
        if(r==null||r=="")
         {
          alert("Please enter Test id");
            return false;
         }
         if(isNaN(r))
           {
         alert(	"Oops! Test ID is Numeric!"	);
         return	false;
           }
         return true;
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

    $(document).ready(function(){           //Add test- dynamic course list
        $('#addpro').on('change', function(){
            var pid = $(this).val();
            if(pid){
                $.ajax({
                    url:"testFilter.php",
                    method:"POST",
                    data: {pid:pid},
                    success:function(html){
                        $('#addtco').html(html);
                    }
                });
            }else{
                $('#addtco').html('<option value="">Select Program first</option>');
            }
        });
    });

    $(document).ready(function(){           //Update test- dynamic course list
        $('#uppro').on('change', function(){
            var pid = $(this).val();
            if(pid){
                $.ajax({
                    url:"testFilter.php",
                    method:"POST",
                    data: {pid:pid},
                    success:function(html){
                        $('#uptco').html(html);
                    }
                });
            }else{
                $('#uptco').html('<option value="">Select Program first</option>');
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
                  <span id="addform-title">ADD A TEST</span><br>
                  <div id="st-addform"><form id="addcourse-admin" name="addst"  method="POST" onSubmit="return validateAddTest()">
                    <div class="row mb-3"><div class="col-6">Test Name</div><div class="col-6"><input class="roundedinput" type="text" name="tname" required></div></div>
                    <div class="row mb-3"><div class="col-6">Test Date(yyyy-mm-dd)</div><div class="col-6"><input class="roundedinput" type="date" name="tdate" required></div></div>
                    <div class="row mb-3"><div class="col-6">Maximum marks</div><div class="col-6"><input class="roundedinput" type="text" name="tmax" required></div></div>
                    <div class="row mb-3"><div class="col-6">Test category</div>
                      <div class="col-6"><select class="roundedinputselect" name="tcat"><option value="-1" selected>category</option><option value="ISA">ISA</option><option value="ESE">ESE</option><option value="OBT">OBT</option><option value="Quiz">Quiz</option><option value="Assignment">Assignment</option><option value="Presentation">Presentation</option></select></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 "> Program</div><div class="col-6"><select class="roundedinputselect st-input" name="tprog" id="addpro"><option value="-1" selected>Program</option><option value="1">BCA</option><option value="2">BBA</option><option value="3">BAMC</option></select></div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-6 ">Course</div><div class="col-6"><select class="roundedinputselect st-input" name="tcours" id="addtco">
                        <option value="-1" selected>Course</option>
                      </select></div>
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
                  <div id="st-addform"><form id="addcourse-admin" name="updatest"  method="POST" onSubmit="return validateUpdateTest()">
                      <div class="row mb-3"><div class="col-6">Test ID</div><div class="col-6"><input class="roundedinput" type="text" name="tid" required></div></div>
                    <div class="row mb-3"><div class="col-6">Test Name</div><div class="col-6"><input class="roundedinput" type="text" name="tname"></div></div>
                    <div class="row mb-3"><div class="col-6">Test Date(yyyy-mm-dd)</div><div class="col-6"><input class="roundedinput" type="date" name="tdate"></div></div>
                    <div class="row mb-3"><div class="col-6">Maximum marks</div><div class="col-6"><input class="roundedinput" type="text" name="tmax"></div></div>
                    <div class="row mb-3"><div class="col-6">Test category</div>
                      <div class="col-6"><select class="roundedinputselect" name="tcat"><option value="-1" selected>category</option><option value="ISA">ISA</option><option value="ESE">ESE</option><option value="OBT">OBT</option><option value="Quiz">Quiz</option><option value="Assignment">Assignment</option><option value="Presentation">Presentation</option></select></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6"> Program</div><div class="col-6"><select class="roundedinputselect st-input" name="tprog" id="uppro"><option value="-1" selected>Program</option><option value="1">BCA</option><option value="2">BBA</option><option value="3">BAMC</option></select></div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-6">Course</div><div class="col-6"><select class="roundedinputselect st-input" name="tcours" id="uptco">
                        <option value="-1" selected>Course</option>
                      </select></div>
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
                    <div class="row mb-3"><div class="col-6">Test ID</div><div class="col-6"><input class="roundedinput" type="text" name="tid" required></div></div>
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
              $dept = $_POST["sdept"];
              $prog = $_POST["tprog"];
              $cours = $_POST["tcours"];

              if(isset($cours)&& ($cours!="-1"))
              {
                $query2 ="select distinct test.Test_id,test.T_name,test.Date_conducted,test.Max_marks,test.Test_Category,course.C_name from test
                        inner join semester_courses on test.Course=semester_courses.Course_id
                        inner join course on course.C_id=test.Course
                        where Course=$cours;";
              }
              else if (isset($prog)&& ($prog!='-1'))
              {
                $query2="select distinct test.Test_id,test.T_name,test.Date_conducted,test.Max_marks,test.Test_Category,course.C_name from test
                        inner join semester_courses on test.Course=semester_courses.Course_id
                        inner join course on course.C_id=test.Course
                        where semester_courses.Prog_id=$prog;";
              }
              else if(isset($dept)&& ($dept!='-1'))
              {
                $query2="select distinct test.Test_id,test.T_name,test.Date_conducted,test.Max_marks,test.Test_Category,course.C_name from test
                        inner join semester_courses on test.Course=semester_courses.Course_id
                        inner join course on course.C_id=test.Course
                        where program.Department=$dept;";
              }
              else
              {
                $query2 = "select distinct test.Test_id,test.T_name,test.Date_conducted,test.Max_marks,test.Test_Category,course.C_name from test
                        inner join semester_courses on test.Course=semester_courses.Course_id
                        inner join course on course.C_id=test.Course;";
              }

              $result2 = mysqli_query($connection,$query2) or die ("Error in query: ".$query2." ".mysqli_connect_error());

              if(mysqli_num_rows($result2)>0)
              {
                echo "<table class='table table-striped' id='studdata'>";
                echo "<tr><th>Test ID</th><th>Name</th><th>Date of Test</th><th>Max Marks</th><th>Test Category</th><th>Course</th></tr>";
              while ($row= mysqli_fetch_row($result2))
              {
                echo "<tr>";
                echo "<td>".$row[0]."</td>";
                echo "<td>".$row[1]."</td>";
                echo "<td>".$row[2]."</td>";
                echo "<td>".$row[3]."</td>";
                echo "<td>".$row[4]."</td>";
                echo "<td>".$row[5]."</td>";
                echo "</tr>";
              }
                echo "</table>";
              }}
              mysqli_close($connection);
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
