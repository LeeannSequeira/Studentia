/**
 * Author:    Leeann Sequeira
 *
 * Last update Date: 8th August 2021
 *
 **/

<?php
include "Db_Connection.php"; // Using database connection file here
//variables retrieved from form are copied into simpler variable names
if(isset($_POST["button"]))
{
if($_REQUEST['button']=="Signup") //---------------------------------------------------------------------------------------------------------------------------------ADD BUTTON
{
$fname=$_POST["tfname"];
$lname = $_POST["tlname"];
$mail = $_POST["tmail"];
$pass = $_POST["tpassword"];
$gen = $_POST["tgen"];
//-------------------------------store check box data code
$dept = $_POST["tdept"];
$role = $_POST["trole"];

$querymail="Select T_id from teacher where Email='$mail';";
$resultmail = mysqli_query($connection,$querymail) or die ("Error in query: ".$querymail." ".mysqli_connect_error());
if((mysqli_fetch_row($resultmail))>0)
{
echo "<script>alert('Sorry! Email already exists!');</script>";
}
else
{
//insert into teacher table
$query = "INSERT INTO teacher(Fname,Lname, Gender, Password, Email,T_role,Department) VALUES ('$fname','$lname','$gen','$pass','$mail','$role','$dept');";
$result = mysqli_query($connection,$query) or die ("Error in query: ".$query." ".mysqli_connect_error());

//get TID of record
$query="Select T_id from teacher where Email='$mail';";
$result = mysqli_query($connection,$query) or die ("Error in query: ".$query." ".mysqli_connect_error());

while ($row= mysqli_fetch_assoc($result)) {
  $un=$row["T_id"];
}


echo "<script>alert('Your Username is $un');</script>";
}
mysqli_close($connection);
}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Studentia Signup</title>
    <link rel="icon"
      type="image/png"
      href="images/logo-fav.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="Studentia.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
    <script type="text/javascript">
      function validateForm() //login input validation
      {
        var	x=document.signupform.tfname.value;
        var	y=document.signupform.tlname.value;
        var regEx = /^[A-Z][a-z\s]*$/;

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
        if(y==null||y=="")
         {
          alert("Please enter Last name");     //last name
          return false;
         }
         if(!(y.match(regEx)))
         	{
         alert(	"Oops! invalid Last name!"	);
 	       return	false;
         	}
        var	z=document.signupform.tmail.value;
        var atpos=z.indexOf("@");
        var dotpos=z.lastIndexOf(".");
        if(atpos<1||dotpos<atpos+2||dotpos+2>=z.length||z==null||z=="")
		      {
		          alert("Please enter valid email");                            //email
              return false;
		      }
        var pass=document.signupform.tpassword.value;
        var repass=document.signupform.trepassword.value;
        if(pass==null||pass=="")
         {
          alert("Please enter password");                    //password and re-password
          return false;
         }
         if(pass.length<6)
          {
           alert("Oops! Password length must be more than 6 characters");                    //password and re-password
           return false;
          }
        if(repass!=pass)
         {
          alert("Please re-enter password correctly");
         }
        if (document.signupform.tdept.value == "-1")
        {
          alert("please choose your department");        //Department
          return false;
        }
        var rad=null;
        var rad=document.signupform.trole.value;
        if (rad==null)
        {
          alert("please choose your role");       //role   NOT WORKING!
          return false;
        }

      return true;}
    </script>
  </head>
  <body>
    <!-- LANDING PAGE -signup------------------------------------------------------------------------------------------------------------------------------>
    <div class="container landing">
      <div class="row landingrow">
        <div class="col-md-4" id="landing-left-section">
          <div id="namelogo"><span id="title">Studentia</span><br><img id="loginpagelogo" src="images/logo.png" alt="Studentia Logo"></div>
        </div>
        <div class="col-md-8" id="landing-right-section">
          <div id="signupVerticalAlign">
          <div id="signupframe">
            <form id="signupform" name="signupform" action="" method="POST" onsubmit="return validateForm()">
                <div class="row mb-3"><div class="col-6">First name</div><div class="col-6"><input class="roundedinput" type="text" name="tfname" required></div></div>
                <div class="row mb-3"><div class="col-6">Last name</div><div class="col-6"><input class="roundedinput" type="text" name="tlname" required></div></div>
                <div class="row mb-3"><div class="col-6">Email</div><div class="col-6"><input class="roundedinput" type="mail" name="tmail" required></div></div>
                <div class="row mb-3"><div class="col-6">Gender</div><div class="col-6"><input type="radio" name="tgen" value="m">Male &nbsp;<input type="radio" name="tgen" value="f">Female</div></div>
                <div class="row mb-3"><div class="col-6">Password</div><div class="col-6"><input class="roundedinput" type="password" name="tpassword" required></div></div>
                <div class="row mb-3"><div class="col-6">Re-enter password</div><div class="col-6"><input class="roundedinput" type="password" name="trepassword" required></div></div>
              <!--  <div class="row mb-3"><div class="col-6">Courses</div><div class="col-6"></div></div> -->
                <div class="row mb-3"><div class="col-6">Role</div><div class="col-6"><input type="radio" name="trole" value="teacher">Teacher &nbsp;<input type="radio" name="trole" value="incharge">Exam Incharge</div></div>
                <div class="row mb-3"><div class="col-6">Department</div>
                  <div class="col-6"><select class="roundedinputselect" name="tdept"><option value="-1" selected>Choose Department</option><option value="1">BCA</option><option value="2">BBA</option><option value="3">BAMC</option></select></div>
                </div>

                <div class="row mb-3"><center><span id="notesignup"> Note: Username will be generated on signup </span></center></div>
                <div class="row mb-3"><center><input type="Submit" value="Signup" name="button" id="signup-button"></center></div>
            </form>
          </div>
          <!--COURSE CHECK BOX  <div class="row"><div class="col-6"><input type="checkbox" name="cb0" value="0"> Database management system</input></div><div class="col-6"><input type="checkbox" name="cb7" value="7"> Database management system</input></div></div>
            <div class="row"><div class="col-6"><input type="checkbox" name="cb1" value="1">Software Testing</input></div><div class="col-6"><input type="checkbox" name="cb8" value="8"> Database management system</input></div></div>
            <div class="row"><div class="col-6"><input type="checkbox" name="cb2" value="2"> Human Resourse Management</input></div><div class="col-6"><input type="checkbox" name="cb9" value="9"> Database management system</input></div></div>
            <div class="row"><div class="col-6"><input type="checkbox" name="cb3" value="3"> IT project Management</input></div><div class="col-6"><input type="checkbox" name="cb10" value="10"> Database management system</input></div></div>
            <div class="row"><div class="col-6"><input type="checkbox" name="cb4" value="4"> Web Technology</input></div><div class="col-6"><input type="checkbox" name="cb11" value="11"> Database management system</input></div></div>
            <div class="row"><div class="col-6"><input type="checkbox" name="cb5" value="5"> Web Technology Lab</input></div><div class="col-6"><input type="checkbox" name="cb12" value="12"> Database management system</input></div></div>
            <div class="row"><div class="col-6"><input type="checkbox" name="cb6" value="6"> Business Ethics</input></div><div class="col-6"><input type="checkbox" name="cb13" value="0"> Database management system</input></div></div> -->


          <br><span id="signup-question">Already have an account? </span>&nbsp;
          <button id="signup-button-login" value="Login" onclick="location.href='Landingpage-login.php';">Login</button>
        </div></div>
      </div>
    </div>
  </body>
</html>
