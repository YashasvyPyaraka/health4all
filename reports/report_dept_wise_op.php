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
	 <link rel="stylesheet" href="../amcharts/images/style.css" type="text/css">
        <script src="../amcharts/amcharts/amcharts.js" type="text/javascript"></script>         
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
 

<?php
$report_title="Department wise OP Visits Summary";
echo "<h3>Report : ".$report_title."</h3>";
echo "<form action=\"report_dept_wise_op.php\" method=\"post\">"; ?>
<table>
<tr>
<th>From Date</th>
<th>To Date</th>
</tr>
<tr>
<td><input type="text" name="from_date" id="vdatepicker" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'></td>
<td><input type="text" name="to_date" id="datepicker" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="submit"></td>
</tr>
</table>
</form>
<?php
 if (isset($_POST['submit'])){
 echo "<hr>";
 //connect to database
 include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 
 echo "<table style=\"font-weight: bold;\">
	   <tr><td>Report </td>
	   <td>: ".$report_title."</td></tr>
	   <tr><td>Report Period </td>
	   <td>: " . date("jS M Y", strtotime($_POST['from_date'])) . " - " . date("jS M Y", strtotime($_POST['to_date'])) . "</td>
	   </tr></table>"; 

 	// begin of query
 $query= "SELECT
          department \"Department\",
          SUM(CASE WHEN visit_id = admit_id  THEN 1 ELSE 0 END) \"OP\",
		  SUM(CASE WHEN age_years <= 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"child\",
		  SUM(CASE WHEN gender = 'F' AND age_years <= 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"fchild\",
		  SUM(CASE WHEN gender = 'M' AND age_years <= 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"mchild\",
		  SUM(CASE WHEN age_years > 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"adult\",
		  SUM(CASE WHEN gender = 'F' AND age_years > 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"fadult\",
		  SUM(CASE WHEN gender = 'M' AND age_years > 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"madult\"
          FROM patient_visits
		  JOIN patients ON patients.patient_id = patient_visits.patient_id
		  JOIN departments ON patient_visits.department_id = departments.department_id
		  WHERE  ((admit_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='OP'))
          GROUP BY department";
 	// end of query
  
 $column1="Department";   	// "Year" "District" "Date"
 $column2=""; 		// **only for month "Month" or ""
 $report_type="OP"; 	// "OP" or "IP"
 $chart_name="dept_wise_op_bar";	// Name of the chart to be include
 }
 
 require_once 'report_classes/report_page_footer.php'; 	//foot section of the page includes: report table & page footer.
 ?>
     

 
