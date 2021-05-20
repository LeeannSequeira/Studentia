<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <script type="text/javascript">
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

  function validateUpdateTest() //Validates Test id, Test date
  {
    var	r=document.updatest.tid.value;
    if(r==null||r=="")
     {
      alert("Please enter Test id");
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
    return true;
    }
    </script>
  </head>
  <body>
    <div class="col-4"><!-- UPDATE------------------------------------------------------------------------------------------------------->
      <button class="functionbtn" value="update" onclick="togglePopupupdatest()">Update</button>
      <div class="popup" id="popup-updatest">
        <div class="overlay"></div>
        <div class="stcontent">
          <div class="close-btn" onclick="togglePopupupdatest()">×</div><!--popup content-->
          <span id="addform-title">UPDATE TEST</span><br>
          <div id="st-addform"><form id="addcourse-admin" name="updatest"  method="POST" onSubmit="return validateUpdateTest()">
              <div class="row mb-3"><div class="col-6">Test ID</div><div class="col-6"><input class="roundedinput" type="text" name="tid"></div></div>
            <div class="row mb-3"><div class="col-6">Test Name</div><div class="col-6"><input class="roundedinput" type="text" name="tname"></div></div>
            <div class="row mb-3"><div class="col-6">Test Date(yyyy-mm-dd)</div><div class="col-6"><input class="roundedinput" type="text" name="tdate"></div></div>
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
  </body>
</html>
