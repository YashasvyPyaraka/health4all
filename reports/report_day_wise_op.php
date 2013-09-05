 <?php
 $action_page="report_day_wise_op.php"; 				//action on submit
 $report_title="Day wise OP Visits Summary"; 		//title of the report
 $dept_selection=1;										// 1 if yes, 0 is no
 
 require_once 'report_classes/report_page_header.php';	//head section of the page includes: page header, reports form & report title.
 
 if (isset($_POST['submit']))
 {
 	// begin of query
 $query= "SELECT
          admit_date \"Date\",
          SUM(CASE WHEN visit_id = admit_id  THEN 1 ELSE 0 END) \"OP\",
		  SUM(CASE WHEN age_years <= 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"child\",
		  SUM(CASE WHEN gender = 'F' AND age_years <= 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"fchild\",
		  SUM(CASE WHEN gender = 'M' AND age_years <= 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"mchild\",
		  SUM(CASE WHEN age_years > 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"adult\",
		  SUM(CASE WHEN gender = 'F' AND age_years > 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"fadult\",
		  SUM(CASE WHEN gender = 'M' AND age_years > 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"madult\"
          FROM patient_visits
		  JOIN patients ON patients.patient_id = patient_visits.patient_id
		  WHERE  ((admit_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='OP')".$dept . $unit . $area . $gender.")
          GROUP BY admit_date";
	// end of query
    
 $column1="Date";   	// "Year" "District" "Date"
 $column2=""; 		// **only for month "Month" or ""
 $report_type="OP"; 	// "OP" or "IP"
 $chart_name="day_wise_op_line";	// Name of the chart to be include
 }
 
 require_once 'report_classes/report_page_footer.php'; 	//foot section of the page includes: report table & page footer.
 ?>
 
