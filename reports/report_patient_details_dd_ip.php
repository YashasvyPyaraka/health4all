<?php $thispage = "reports"; ?>
<!DOCTYPE html>
 <html>

 <head>
    <script src="../scripts/jquery183.js"></script>
    <script src="../scripts/jquery-ui.js"></script>
	<script src="../scripts/jquery.ui.core.min.js"></script>
	<script src="../scripts/jquery.ui.widget.js"></script>
	<script src="../scripts/datepicker.js"></script>
	<script src="../scripts/registration.js"></script>
 <!-- link to css style sheet -->
	<link rel="stylesheet" href="../scripts/jquery-ui.css" />
 	<link rel="stylesheet" type="text/css" href="../health4all.css">
 </head>

 <body>
 <!-- begin wrap contents of page  -->
 <div id="wrapper">



 <!--menubar-->
 <?php include '../menubar_reports.php' ;?>

 <!-- begin main page content -->
  <div id="content-main">
 
 <!-- begin right div content -->
 <div id="right">
 
 <h3>Report : In-Patient Details (Discharged & Deaths)</h3>

<form action="report_patient_details_dd_ip.php" method="post">
<?php 
require_once "report_classes/table_form_oc.php";?>
</form>
<br>

<?php
 if (isset($_POST['submit'])){

 if($_POST['from_date']==$_POST['to_date']) {
 $dates=date("d M Y", strtotime($_POST['from_date']));}
 else {
 $dates=date("d M Y", strtotime($_POST['from_date'])) ." to ". date("d M Y", strtotime($_POST['to_date']));
 }

 //connect to database
 include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 
 if($_POST['department']!=""){
 $dept= "AND (patient_visits.department_id='" . $_POST['department'] . "')";
 }
 else $dept="";
 
 if($_POST['gender']!=""){
 $gender= "AND (patients.gender='" . $_POST['gender'] . "')";
 }
 else $gender="";
 
 if($_POST['outcome']!=""){
 $outcome= "AND (patient_visits.outcome='" . $_POST['outcome'] . "')";
 }
 else $outcome="AND (patient_visits.outcome!='transfer')";
 
 $unit=""; $i=0;
 foreach($_POST['unit'] as $un) {
 if($un!=""){
 if($i==0){
 $unit="(patient_visits.unit='" . $un . "')";
 }else{ 
 $unit= $unit . "OR (patient_visits.unit='" . $un . "')";
 }}
 else {$unit=""; break; }
 $i++;}
 
 if($unit!='') {
 $unit= "AND (" .$unit. ")";
 }
  
 $area=""; $i=0;
 foreach($_POST['area'] as $ar) {
 if($ar!=""){
 if($i==0){
 $area="(patient_visits.area='" . $ar . "')";
 }else{ 
 $area= $area . "OR (patient_visits.area='" . $ar . "')";
 }}
 else {$area=""; break; }
 $i++;}
 
 if($area!='') {
 $area= "AND (" .$area. ")";
 }
 
 echo "<b><u>Report Period</u> : </b>" . $dates . "</br>";
 echo "<b><u>Department</u> : </b>"; $query_dept= "SELECT * FROM departments WHERE department_id='" . $_POST['department'] . "'"; $result_dept = mysql_query($query_dept); $record_dept = mysql_fetch_array($result_dept); if($record_dept['department']==""){echo"ALL";}else{echo "$record_dept[department]";} if(isset($_POST['unit'])){
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Unit</u> : </b>"; $a=0; foreach($_POST['unit'] as $un) { if($un!=""){$query_unit= "SELECT * FROM units WHERE unit_id='" . $un . "'"; $result_unit = mysql_query($query_unit); $record_unit = mysql_fetch_array($result_unit); if($a!='0'){echo ", ";} echo $record_unit['unit_name']; $a++;} else {echo "ALL"; break;}}  
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Area</u> : </b>"; $a=0; foreach($_POST['area'] as $ar) { if($ar!=""){$query_area= "SELECT * FROM areas WHERE area_id='" . $ar . "'"; $result_area = mysql_query($query_area); $record_area = mysql_fetch_array($result_area); if($a!='0'){echo ", ";} echo $record_area['area_name']; $a++;} else {echo "ALL"; break;}} } 
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Gender</u> : </b>"; if($_POST['gender']=="M"){echo "Male";} elseif($_POST['gender']=="F"){echo "Female";} else {echo "ALL";} 
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Outcome</u> : </b>"; if($_POST['outcome']!=""){echo $_POST['outcome'];} else {echo "ALL";} echo"</br></br>"; 

 
 $query= "SELECT
          	patients.patient_id \"pid\", visit_id, admit_id, hosp_file_no, name, mother_name, father_name, place, phone, gender, dob, admit_date, outcome_date, provisional_diagnosis, outcome, DATEDIFF( outcome_date, admit_date ) AS Duration
			FROM patient_visits
			INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
			WHERE  ((outcome_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (admit_id=visit_id) AND (visit_type='IP')" . $dept . $unit . $area . $gender . $outcome . ")";
		  
 $result = mysql_query($query);
 if(mysql_num_rows($result) != 0) {
 $i=1;
 echo "<div class=\"scrollbar\" style=\"width: 950px; height: 400px;\">";
 echo "<table id=\"table-his\">";
 echo "<thead>";
 echo "<tr><th>S.no</th>";  echo "<th>Patient ID</th>";  echo "<th>Visit ID</th>";  echo "<th>Admit ID</th>"; echo "<th>IP NO</th>"; echo "<th>Patient Name</th>"; echo "<th>Mother's / Father's Name</th>"; echo "<th>Address/Phone</th>"; echo "<th>Sex</th>"; echo "<th>Age at Admission (days)</th>"; echo "<th>Provisional Diagnosis</th>"; echo "<th>Admit Date</th>"; echo "<th>Outcome Date</th>";echo "<th>Duration of Stay</th>"; echo "<th>Outcome</th></tr>"; 
 echo "</thead>";
 echo "<tbody>";
 
 while ($record = mysql_fetch_array($result)){
 if($record['dob']!=''){
 $age = abs(strtotime($record['admit_date']) - strtotime($record['dob'])) / (60 * 60 * 24);
 } else { $age=''; }
 echo "<tr>";
 echo "<td>" . $i . "</td>";
 echo "<td>" . $record['pid'] . "</td>";
 echo "<td>" . $record['visit_id'] . "</td>";
 echo "<td>" . $record['admit_id'] . "</td>";
 echo "<td>" . $record['hosp_file_no'] . "</td>";
 echo "<td>" . $record['name'] . "</td>";
 echo "<td>" . $record['mother_name'] ."/". $record['father_name'] . "</td>";
 echo "<td>" . $record['place'] ."/". $record['phone'] . "</td>";
 echo "<td>" . $record['gender'] . "</td>";
 echo "<td>" . $age . "</td>";
 echo "<td>" . $record['provisional_diagnosis'] . "</td>";
 echo "<td>" . date('dMY', strtotime($record['admit_date'])) . "</td>";
 echo "<td>" . date('dMY', strtotime($record['outcome_date'])) . "</td>";
 echo "<td>" . $record['Duration'] . "</td>";
 echo "<td>" . $record['outcome'] . "</td>";
 echo "</tr>";
 $i++;
 }
 echo "</tbody>";
 echo "</table>";
 echo "</div>"; 
 } else { echo "<br><br><b style=\"color:red;\">No data in this given dates</b>"; }
 }
 
 ?>
  <!-- end right div content -->
 </div>

 <?php include '../footer.php'; ?>
  <!-- end main page content -->
</div>
 <!-- end wrap contents of page  -->
 </div>
 </body>
 </html>
