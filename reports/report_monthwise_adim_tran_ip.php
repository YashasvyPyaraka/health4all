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
 
 <h3>Report : Month wise IP Admissions Summary</h3>

<form action="report_monthwise_adim_tran_ip.php" method="post">
<?php require_once "report_classes/table_form.php";?>
</form>
<br>

<?php
if (isset($_POST['submit'])){

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
 }?>
<?php

 echo "</br>";
 echo "<b><u>Report Period</u> : </b>" . date("jS M Y", strtotime($_POST['from_date'])) . " to " . date("jS M Y", strtotime($_POST['to_date'])) . "</br>";
 echo "<b><u>Department</u> : </b>"; $query_dept= "SELECT * FROM departments WHERE department_id='" . $_POST['department'] . "'"; $result_dept = mysql_query($query_dept); $record_dept = mysql_fetch_array($result_dept); if($record_dept['department']==""){echo"ALL";}else{echo "$record_dept[department]";} if(isset($_POST['unit'])){
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Unit</u> : </b>"; $a=0; foreach($_POST['unit'] as $un) { if($un!=""){$query_unit= "SELECT * FROM units WHERE unit_id='" . $un . "'"; $result_unit = mysql_query($query_unit); $record_unit = mysql_fetch_array($result_unit); if($a!='0'){echo ", ";} echo $record_unit['unit_name']; $a++;} else {echo "ALL"; break;}}  
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Area</u> : </b>"; $a=0; foreach($_POST['area'] as $ar) { if($ar!=""){$query_area= "SELECT * FROM areas WHERE area_id='" . $ar . "'"; $result_area = mysql_query($query_area); $record_area = mysql_fetch_array($result_area); if($a!='0'){echo ", ";} echo $record_area['area_name']; $a++;} else {echo "ALL"; break;}} } 
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Gender</u> : </b>"; if($_POST['gender']=="M"){echo "Male";} elseif($_POST['gender']=="F"){echo "Female";} else {echo "ALL";} echo"</br>"; 
 
 $query= "SELECT
          Month(admit_date) \"Month\",
		  Year(admit_date) \"Year\",
          SUM(CASE WHEN visit_id = admit_id  THEN 1 ELSE 0 END) \"IP_ADMIN\",
		  SUM(CASE WHEN visit_id != admit_id  THEN 1 ELSE 0 END) \"IP_TRANS\",
		  COUNT(visit_id) \"TOTAL\"
          FROM patient_visits
		  INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
		  WHERE  ((admit_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='IP')" . $dept . $unit . $area . $gender . ")
          GROUP BY Month(admit_date), Year(admit_date)
          ORDER BY Year(admit_date),Month(admit_date) ASC";
          
 $result = mysql_query($query);
 if(mysql_num_rows($result) != 0) {
 $arr_m = array("","January","February","March","April","May","June","July","August","September","October","November","December");
 $i=1; $m=0; $f=0; $ma=0;
 echo "<table name=\"table-his\" id=\"table-his\">";
 echo "<thead>";
 echo "<tr><th>S.no</th>"; echo "<th>Year</th>"; echo "<th>Month</th>"; echo "<th>Admissions</th>"; echo "<th>Transfers</th>"; echo "<th>Total</th></tr>"; 
 echo "</thead>";
    $csv_hdr = " S.no,Year,Month,Admissions,Transfers,Total";
    $csv_output="";
 echo "<tbody>";
 while ($record = mysql_fetch_array($result)){
 echo "<tr>";
 echo "<td>" . $i . "</td>";
$csv_output .= $i . ", ";
 echo "<td>" . $record['Year'] . "</td>";
$csv_output .= $record['Year'] . ", ";
 echo "<td>" . $arr_m[$record['Month']] . "</td>";
$csv_output .= $record['Month'] . ", ";
 echo "<td>" . $record['IP_ADMIN'] . "</td>";
$csv_output .= $record['IP_ADMIN'] . ", ";
 echo "<td>" . $record['IP_TRANS'] . "</td>";
$csv_output .= $record['IP_ADMIN'] . ", ";
 echo "<td>" . $record['TOTAL'] . "</td>";
$csv_output .= $record['TOTAL'] . "\n";
 echo "</tr>";
 $m=$m+$record['IP_ADMIN']; $f=$f+$record['IP_TRANS'];  $ma=$ma+$record['TOTAL'];
 $i++;
 }
 echo "<tr>";
 echo "<td style=\"border-top:1px solid;\"></td>";
 echo "<td style=\"border-top:1px solid;\"></td>";
 echo "<td style=\"border-top:1px solid;\">Total Admissions</td>";
 echo "<td style=\"border-top:1px solid;\">" . $m . "</td>";
 echo "<td style=\"border-top:1px solid;\">" . $f . "</td>";
 echo "<td style=\"border-top:1px solid;\">" . $ma . "</td>";
 echo "</tr>";
 echo "</tr>";
 echo "</tbody>";
 echo "</table>"; 
 echo "</br></br>";
 include "../charts/adim_trans_ip_bar.php";
 ?>
<form name="export" action="export.php" method="post">
<input type="submit" value="Export table to CSV">
<input type="hidden" value="<?php echo $csv_hdr; ?>" name="csv_hdr">
<input type="hidden" value="<?php echo $csv_output; ?>" name="csv_output">
</form>
<input type="submit" value="Print report" onclick="window.print();">
 <?php
 }
  else
 {
 Echo "<br><br><b style=\"color:red;\">No data in this given dates</b>";
 }
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
