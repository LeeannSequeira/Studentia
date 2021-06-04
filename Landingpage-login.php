<?php
    include('Db_connection.php');

    if(isset($_POST["button"]))
    {
    if($_REQUEST['button']=="Login") //---------------------------------------------------------------------------------------------------------------------------------ADD BUTTON
    {
    $un = $_POST['tusername'];
    $pass = $_POST['tpassword'];

        $query = "select *from teacher where T_id = $un and Password = '$pass';";
        $result = mysqli_query($connection, $query) or die ("Error in query: ".$query." ".mysqli_connect_error());
        $count=mysqli_num_rows($result);
        if($count == 1){
          $query="Select T_role from teacher where T_id = $un;";
          $result = mysqli_query($connection, $query) or die ("Error in query: ".$query." ".mysqli_connect_error());
          $row= mysqli_fetch_assoc($result);
          if($row['T_role']=="incharge")
          {
            header("Location: dashboard-incharge.html");
            exit();
          }
          else
          {
            header("Location: dashboard-teacher.html");
            exit();
          }
        }
        else{
            echo "<script>alert('Login Failed');</script>";
            echo "<script>alert('Incase of forgotten password, Contact Admin');</script>";
        }
}}
?>

<html>
  <head>
    <title>Studentia Login</title>
    <link rel="icon"
      type="image/png"
      href="images/logo-fav.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="Studentia.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
    <script>
      function validateForm() //login input validation
      {
        var	x=document.loginform.tusername.value;
        var	y=document.loginform.tpassword.value;
        if(x==null||x=="")
		     {
		      alert("Please enter username");
          return false;
        }
        if(isNaN(	x	))
        	{
        alert(	"Oops! Usernames are numeric until the next upgrade!"	);
	      return	false;
        	}

        if(y==null||y=="")
         {
          alert("Please enter password");
          return false;
         }
         if(y.length<6)
          {
           alert("Oops! Password length must be more than 6 characters");                    //password and re-password
           return false;
          }
        else {
          return true;
        }
      }
    </script>
  </head>
  <body>
    <!-- LANDING PAGE BASIC PARTITION------------------------------------------------------------------------------------------------------------------------------>
    <div class="container landing">
      <div class="row landingrow">
        <div class="col-md-4" id="landing-left-section">
          <div id="namelogo"><span id="title">Studentia</span><br><img id="loginpagelogo" src="images/logo.png"></div>
        </div>
        <div class="col-md-8" id="landing-right-section">
          <div id="loginVerticalAlign"><div id="loginframe">
            <form id="loginform" name="loginform" method="post" onsubmit="return	validateForm()">
                <div class="row mb-3"><div class="col-6">Username</div><div class="col-6"><input class="roundedinput" type="text" name="tusername" required></div></div>
                <div class="row mb-3"><div class="col-6">Password</div><div class="col-6"><input class="roundedinput" type="password" name="tpassword" required></div></div>
                <div class="row mb-3"><center><input type="submit" value="Login" name="button" id="login-button"></center></div>
            </form>
          </div>
          <br><span id="login-question">Don't have an account? </span><br>
          <br><button id="signup-button-login"value="Signup" onclick="location.href='landingpage-signup.php';">Sign up</button>
        </div>
      </div>
    </div>
  </body>
</html>
