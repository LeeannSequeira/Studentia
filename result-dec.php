/**
 * Author:    Leeann Sequeira
 *
 * Last update Date: 8th August 2021
 *
 **/

<?php
include "Db_Connection.php"; // db connection


    $roll=$_GET['roll'];
    $sem=$_GET['sem'];

    $queryinfo = "select student.Roll_no, student.Fname, student.Mname, student.Lname, program.P_name, student_spi.SPI,student.Program FROM student
                  INNER JOIN student_spi USING (Roll_no)
                  INNER JOIN program on program.P_id=student.Program
                  where student.Roll_no='$roll' and student_spi.Sem_id=$sem;";
    $resultinfo = mysqli_query($connection,$queryinfo) or die ("Error in query: ".$queryinfo." ".mysqli_connect_error());

    if($resultinfo )
    {$row=mysqli_fetch_row($resultinfo);
    //{echo "<script>alert('Marks successfully Updated');</script>";}

?>
<html lang="en" dir="ltr">
  <head>
    <title>Studentia Result</title>
    <link rel="icon"
      type="image/png"
      href="images/logo-fav.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="Studentia.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container" id="resBorder">
      <div class="row mb-3"><center><h2>RESULT</h2></center></div>
      <div class="row">   <div class="col-6" style="width: 60%;">
      <div class="row mb-3">Name: <?php echo " ".$row[1]." ".$row[2]." ".$row[3];?></div>
      <div class="row mb-3">Roll no: <?php echo " ".$row[0];?></div>
      <div class="row mb-3">Program: <?php echo " ".$row[4];?></div>
      <div class="row mb-3">Semester:<?php echo " $sem";?> </div>
    </div><div class="col-1"></div><div id="stimg" class="col-5">Paste Photo here</div></div>
      <div class="row mb-3">
        <table class="table table-striped" id="studgrade">
          <tr>
            <th>Course</th><th>Grade</th>
          </tr>
          <?php
            $querysemcours="select course.C_name ,enroll.Course_grade from semester_courses
                            inner join enroll on semester_courses.Course_id=enroll.C_id
                            inner join course on course.C_id=semester_courses.Course_id
                            where Prog_id=".$row[6]." and semester_courses.Sem_id=$sem and Roll_no='$roll';";
            $resultsemcours = mysqli_query($connection,$querysemcours) or die ("Error in query: ".$querysemcours." ".mysqli_connect_error());
            $count=0;
            while($rowCours=mysqli_fetch_row($resultsemcours))
            {
              echo "<tr>";
              echo "<td>".$rowCours[0]."</td>";
              echo "<td>".$rowCours[1]."</td>";
              echo "</tr>";
              if($rowCours[1]=='F')
              {
                $count=$count+1;
              }
            }

              if(($count>0)||($row[5]<4.0))
              {
                $resultdec="FAIL";
              }
              else
              {
                $resultdec="PASS";
              }

          ?>
        </table>
      </div>
      <div class="row mb-3">
        <div class="col-4">
          SPI: <?php echo " ".$row[5];?>
        </div>
      <?php
      if ($sem==6)
       { echo '<div class="col-4">  CPI:'.$row[5].'</div>';}
       else {
         echo '<div class="col-4"> </div>';
       }
       ?>
        <div class="col-4">
          Result: <?php echo " $resultdec";}?>
        </div>
      </div>
    </div>
  </body>
</html>
