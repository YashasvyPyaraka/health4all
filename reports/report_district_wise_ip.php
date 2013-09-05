 <?php
 $action_page="report_district_wise_ip.php"; 				//action on submit
 $report_title="District wise IP Admissions Summary"; 		//title of the report
 $dept_selection=1;										// 1 if yes, 0 is no
 
 require_once 'report_classes/report_page_header.php';	//head section of the page includes: page header, reports form & report title.
 
 if (isset($_POST['submit']))
 {
 	// begin of query
 $query= "SELECT
          patients.district_id,
		  district \"District\",
		  SUM(CASE WHEN visit_id = admit_id  THEN 1 ELSE 0 END) \"IP\",
		  SUM(CASE WHEN age_years <= 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"child\",
		  SUM(CASE WHEN gender = 'F' AND age_years <= 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"fchild\",
		  SUM(CASE WHEN gender = 'M' AND age_years <= 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"mchild\",
		  SUM(CASE WHEN age_years > 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"adult\",
		  SUM(CASE WHEN gender = 'F' AND age_years > 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"fadult\",
		  SUM(CASE WHEN gender = 'M' AND age_years > 14 AND visit_id = admit_id THEN 1 ELSE 0 END) \"madult\"
          FROM patient_visits
		  INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
		  INNER JOIN districts ON patients.district_id = districts.district_id
		  WHERE  ((admit_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='IP')".$dept . $unit . $area . $gender.")
          GROUP BY district
		  ORDER BY patients.district_id";
	// end of query
  
 $column1="District";   	// "Year" "District" "Date"
 $column2=""; 		// **only for month "Month" or ""
 $report_type="IP"; 	// "OP" or "IP"
 $chart_name="district_wise_ip_bar";	// Name of the chart to be include
 }
 
 require_once 'report_classes/report_page_footer.php'; 	//foot section of the page includes: report table & page footer.
 ?>
 
