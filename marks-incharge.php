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
        alert("please choose your department");        //Department
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
            <a class="nav-link" href="dashboard-incharge.php">Home</a>
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
             <div class="col-6 st-colalign"> Program</div><div class="col-6 st-colalign"><select class="roundedinputselect st-input" name="sprog"><option value="-1" selected>Program</option><option value="1">BCA</option><option value="2">BBA</option><option value="3">BAMC</option></select></div>
         </div>
         <div class="row">
             <div class="col-6 st-colalign">Course</div><div class="col-6 st-colalign"><input class="roundedinput st-input" type="text" name="scourse"></div>
         </div>
         <div class="row">
             <div class="col-6 st-colalign">Class</div><div class="col-6 st-colalign"><input class="roundedinput st-input" type="text" name="scourse"></div>
         </div>
         <div class="row">
             <div class="col-12 st-colalign"><center><input type="submit" value="Search" id="st-searchbtn"></center></div>
         </div>
        </form>
        </div>
        <div class="col-md-9" id="function-right-section">  <!-- RIGHT PARTITION------------------------------------------------------------------------------------------------------->
          <div class="row course-editbtn">

            <div class="col-4"><!--blank------------------------------------------------------------------------------------------------------->

            </div>
            <div class="col-4"><!--blank------------------------------------------------------------------------------------------------------->

            </div>
            <div class="col-4"><!--edit------------------------------------------------------------------------------------------------------->
              <button class="functionbtn" value="edit" onclick="togglePopupdeletest()">Edit</button>
              <div class="popup" id="popup-deletest">
                <div class="overlay"></div>
                <div class="stcontent">
                  <div class="close-btn" onclick="togglePopupdeletest()">×</div><!--popup content-->
                  <span id="addform-title">Edit Marks</span><br>
                  <div id="st-addform"><form id="addcourse-admin" name="deletest" action="" method="POST" onsubmit="return validateDeleteTest()">
                    <div class="row mb-3"><div class="col-6">Roll No.</div><div class="col-6"><input class="roundedinput" type="text" name="sroll"></div></div>
                      <div id="marksec">

                      </div>
                    <div class="row mb-3"><center><input type="submit" value="Enter" id="add-coursebtn"></center></div>
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
