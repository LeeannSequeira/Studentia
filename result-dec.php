<?php
include "Db_Connection.php"; // db connection

    $roll=$_GET['roll'];
    $sem=$_GET['sem'];

    $queryinfo = "select student.Roll_no, student.Fname, student.Mname, student.Lname, student.Program, student_spi.SPI FROM student
                  INNER JOIN student_spi USING (Roll_no)
                  where student.Roll_no=$roll and student_spi.Sem_id=$sem;";
    $resultinfo = mysqli_query($connection,$queryinfo) or die ("Error in query: ".$queryinfo." ".mysqli_connect_error());

    if($resultinfo )
    {$row=mysqli_fetch_row($resultinfo);}
    //{echo "<script>alert('Marks successfully Updated');</script>";}

echo '<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="Studentia.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container" id="resBorder">
      <div class="row mb-3"><center><h2>RESULT</h2></center></div>
      <div class="row mb-3">Name:'.$row[1].' '.$row[2].' '.$row[3].'</div>
      <div class="row mb-3">Roll no: '.$row[0].'</div>
      <div class="row mb-3">Program: '.$row[4].'</div>
      <div class="row mb-3">Semester:<?php echo " $sem";?> </div>
      <div class="row mb-3">
        <table class="table table-striped" id="studgrade">
          <tr>
            <th>Course</th><th>Grade</th>
          </tr>
<?php
    $querysemcours="select semester_courses.Course_id,enroll.Course_grade from semester_courses
                    inner join enroll on semester_courses.Course_id=enroll.C_id
                    where Prog_id=".$row[4]." and semester_courses.Sem_id=$sem and Roll_no='$roll';";
    $resultsemcours = mysqli_query($connection,$querysemcours) or die ("Error in query: ".$querysemcours." ".mysqli_connect_error());
    while($rowCours=mysqli_fetch_row($resultsemcours))
    {
      echo "<tr>";
      echo "<td>".$rowCours[0]."</td>";
      echo "<td>".$rowCours[1]."</td>";
      echo "</tr>";
    }

      if(($rowCours[1]=='F')||($row[5]<4.0))
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
<div class="row mb-3">SPI: <?php echo " ".$row[5];?> </div>
<div class="row mb-3">Result: <?php echo " $resultdec";?> </div>
</div>
</body>
</html>
<?php
// Include autoloader
require_once 'dompdf/autoload.inc.php';

// Reference the Dompdf namespace
use Dompdf\Dompdf;

    $dompdf = new Dompdf();
    $dompdf->load_html('C:\xamp\htdocs\dashboard\Studentia\result-dec.php');
    $dompdf->render();
    $dompdf->stream("file.pdf");
?>
