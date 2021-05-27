<?php
  include "Db_Connection.php"; // db connection
    $roll=$_GET['roll'];
    $sem=$_GET['sem'];

    $queryinfo = "select student.Fname, student.Mname, student.Lname, student.Education_year, student.Program from student where student.Roll_no='$roll';";
    $resultinfo = mysqli_query($connection,$queryinfo) or die ("Error in query: ".$queryinfo." ".mysqli_connect_error());

    if($resultinfo)
    {
      while($row=mysqli_fetch_row($resultinfo))
      {

    //  }
    //}
    //{echo "<script>alert('Marks successfully Updated');</script>";}

?>
<html lang="en" dir="ltr">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="Studentia.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container" id="resBorder">
      <div class="row mb-3"><center><h2>Hall Ticket</h2></center></div>
      <div class="row mb-3">Name: <?php echo " ".$row[0]." ".$row[1]." ".$row[2];?></div>
      <div class="row mb-3">Roll no: <?php echo " $roll";?></div>
      <div class="row mb-3">Program: <?php echo " ".$row[4];?></div>
      <div class="row mb-3">Semester:<?php echo " $sem";?> </div>
      <div class="row mb-3">
        <table class="table table-striped" id="studgrade">
          <tr>
            <th>Course Code</th><th>Course Name</th><th>Eligibility</th><th>Signature</th>
          </tr>
          <?php
          $queryCourse="Select enroll.C_id, course.C_name, enroll.attendance from enroll
                         inner join semester_courses on enroll.C_id=semester_courses.Course_id
                         inner join course on course.C_id = enroll.C_id
                         inner join student using(Roll_no)
                         where semester_courses.Sem_id=$sem and semester_courses.Prog_id=student.Program and Enroll.Roll_no='$roll';";

          $resultCourse = mysqli_query($connection,$queryCourse) or die ("Error in query: ".$queryCourse." ".mysqli_connect_error());

            while($rowCours=mysqli_fetch_row($resultCourse))
            {
              echo "<tr>";
              echo "<td>".$rowCours[0]."</td>";
              echo "<td>".$rowCours[1]."</td>";
              $ch=intval($rowCours[2]);
                if(($ch<75)||($ch==0))
                {echo "<td>NOT ELIGIBLE</td>";}
                else
                {echo "<td>ELIGIBLE</td>";}
                if(($ch<75)||($ch==0))
                {echo "<td>Signature_________________</td>";}
                else
                {echo "<td>-----N/A-----</td>";}
              echo "</tr>";
            }
          }}

          ?>
        </table>
      </div>
      <div class="row mb-3">
        <p>Please note: Inorder to answer exams marked ineligible, Principal's signature against course</p>
      </div>
    </div>
  </body>
</html>
