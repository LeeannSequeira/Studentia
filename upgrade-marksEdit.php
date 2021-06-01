<?php
include "Db_Connection.php"; // db connection
if(isset($_POST["r"]))
{
    $ro=$_POST['r'];
    $cours = $_POST["c"];

    echo "<div class='row mb-3'><div class='col-6'>Roll No.</div><div class='col-6'><input class='roundedinput' type='text' name='rollno' value='$ro' readonly></div></div>";
    echo "<div class='row mb-3'><div class='col-6'>Course ID</div><div class='col-6'><input class='roundedinput' type='text' name='coursid' value='$cours' readonly></div></div>";

  //  <div class="row mb-3"><div class="col-6">Test ID</div><div class="col-6"><input class="roundedinput" type="text" name="tid"></div></div>

    $queryeditPop = "Select test.T_name,test_conducted.Obtained_marks from test_conducted
              INNER JOIN test using(Test_id)
              where test.Course=$cours and test_conducted.Roll_no='$ro';";
    $resulteditPop = mysqli_query($connection,$queryeditPop) or die ("Error in query: ".$queryeditPop." ".mysqli_connect_error());// get test name and marks obtained

    while ($rowtm=mysqli_fetch_row($resulteditPop))
    {
      echo "<div class='row mb-3'><div class='col-6 '>".$rowtm[0]."</div><div class='col-6'><input class='roundedinput editMark' type='text' name='".$rowtm[0]."' value='".$rowtm[1]."'></div></div>";
    }
    echo "<div class='row'><div class='col-12'><center><input type='submit' name='rbutton' value='Edit' id='st-searchbtn'></center></div></div>";
    
  //   mysqli_close($connection);
  }
 ?>
