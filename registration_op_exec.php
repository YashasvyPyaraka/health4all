
 <?php
if (isset($_POST['repeat_submit'])){


	 //connect to database
 include("db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
	
	$admit_time_24= DATE("H:i", STRTOTIME($_POST['op_time']));
	$birth_weight=($_POST['birth_weight_kgs']*1000)+$_POST['birth_weight_gms'];
	$admit_weight=($_POST['admit_weight_kgs']*1000)+$_POST['admit_weight_gms'];
	$discharge_weight=($_POST['discharge_weight_kgs']*1000)+$_POST['discharge_weight_gms'];
	$outcome_time_24= DATE("H:i", STRTOTIME($_POST['outcm_time']));
	
	$opcounter=mysql_query("SELECT count from counters WHERE counter_name='OPcounter'");
	while($record=mysql_fetch_array($opcounter)){$_POST['hosp_file_no']=++$record['count'];
	mysql_query("UPDATE counters SET count='$record[count]++' WHERE counter_name='OPcounter'");
	}
	$id=$_POST['patient_id'];
	$update_patients = "UPDATE patients SET  name='$_POST[pname]', dob='$_POST[dob]', gender='$_POST[gender]', age_years='$_POST[age_years]', age_months='$_POST[age_months]', age_days='$_POST[age_days]', address='$_POST[address]', place='$_POST[place]', district_id='$_POST[district]', father_name='$_POST[father_name]', mother_name='$_POST[mother_name]', spouse_name='$_POST[spouse_name]', phone='$_POST[phone_no]', blood_group='$_POST[blood_group]', id_proof='$_POST[id_proof]', id_proof_number='$_POST[id_proof_no]', occupation='$_POST[occupation]', education_level='$_POST[edu_level]', education_qualification='$_POST[edu_qualification]', mr_no='$_POST[mr_no]', bc_no='$_POST[bc_no]', gestation='$_POST[gestation]',gestation_type='$_POST[gestation_type]', Delivery_mode='$_POST[delivery_mode]', Delivery_location='$_POST[Del_location]', Delivery_place='$_POST[Del_place]', hospital_type='$_POST[hospital_type]', delivery_location_type='$_POST[Delivery_loc_type]', delivery_plan='$_POST[booked_unbooked]', birth_weight='$birth_weight', congenital_anomalies='$_POST[congenital_anomalies]'
						WHERE patient_id='$id'";

	$update = mysql_query($update_patients);

	$insert_patient_visits = "INSERT INTO patient_visits(visit_id, visit_type, patient_id, admit_date, admit_time, department_id, hosp_file_no, insurance_case, insurance_no, unit, area, presenting_complaints, past_history, admit_weight, pulse_rate,respiratory_rate, temperature, sbp, dbp, provisional_diagnosis, doctor, nurse, final_diagnosis, icd_10, icd_10_ext, discharge_weight, outcome, outcome_date, outcome_time, ip_file_received, mlc)
							 VALUES (NULL, 'OP', '$_POST[patient_id]','$_POST[op_date]', '$admit_time_24', '$_POST[department]', '$_POST[hosp_file_no]', '$_POST[aarogya]', '$_POST[aarogya_number]', '$_POST[unit]', '$_POST[area]', '$_POST[chief_complaint]', '$_POST[past_history]', '$admit_weight', '$_POST[pulse_rate]', '$_POST[respiratory_rate]', '$_POST[temperature]', '$_POST[sbp]', '$_POST[dbp]', '$_POST[provisional_diagnosis]', '$_POST[doctor]', '$_POST[nurse]', '$_POST[final_diagnosis]', '$_POST[icd_10]', '$_POST[icd_10_ext]', '$discharge_weight', '$_POST[outcome]', '$_POST[outcm_date]', '$outcome_time_24', '$_POST[fileres_date]', '$_POST[mlc]')";
	
	$registration = mysql_query($insert_patient_visits);	
	$idvis = mysql_insert_id();
	$sql_pv_update = mysql_query("UPDATE patient_visits SET admit_id=visit_id WHERE visit_id='$idvis'");
	
	if($_POST['mlc']=="1"){
	$mlc="INSERT INTO mlc (visit_id, mlc_number, ps_name) VALUES ('$idvis', '$_POST[mlc_number]', '$_POST[ps_name]')";
	$mlcreg = mysql_query($mlc);}
	
	session_start();
	$actreg=mysql_query("INSERT INTO user_activity(visit_id,user_id,register) VALUES ('$idvis','$_SESSION[SESS_USER_ID]', '1')");

	 //////////////////////////////////////////////////////
	$i=1; $count = count($_POST['treatment']);
	if($count>1){
	while ($i < $count) {
	$treatment_date=$_POST['treatment_date'][$i];
	$treatment_time=$_POST['treatment_time'][$i];
	$treatment_type=$_POST['treatment_type'][$i];
	$treatment=$_POST['treatment'][$i];
	$notes=$_POST['notes'][$i];
	$duration=$_POST['duration'][$i];
	
	if($treatment_type!=''){
	$query_treat = "INSERT INTO patient_treatments(treatment_date, treatment_time, treatment_type, treatment, notes, duration, visit_id)
				VALUES ('$treatment_date', '$treatment_time', '$treatment_type', '$treatment', '$notes', '$duration', '$idvis')";
	mysql_query($query_treat) or die ("Error in query: ".mysql_error());
	}
	$i++;
	}}
	
	if($_POST['department']=='22'){
	
		//////////////////////////////////////////////////////
		if($_POST['marital_status']!=""){
		$sql_gynic1= "UPDATE marital_info SET marital_status='$_POST[marital_status]' ,consanguinous='$_POST[consanguinous]' ,marital_life='$_POST[marital_life]'
						WHERE patient_id='$id'";
		$excu_marital_status = mysql_query($sql_gynic1);
		// or die ("Error in query: ".mysql_error());
		if(mysql_num_rows($excu_marital_status)==0){
		$sql_gynic2= "INSERT into marital_info(patient_id, marital_status,consanguinous,marital_life)
				VALUES ('$id','$_POST[marital_status]','$_POST[consanguinous]','$_POST[marital_life]')";
		mysql_query($sql_gynic2);
		}
		}		
		//////////////////////////////////////////////////////

		$i=1; $count = count($_POST['baby_gestation']);
		if($count>1){
		while ($i < $count) {
		$baby_gestation=$_POST['baby_gestation'][$i]; $lmp=$_POST['lmp'][$i];	$edd=$_POST['edd'][$i];	$afi=$_POST['afi'][$i];	$anesthesia_type=$_POST['anesthesia_type'][$i];
		$placenta=$_POST['placenta'][$i]; $baby_outcome=$_POST['baby_outcome'][$i]; $baby_delivery_mode=$_POST['baby_delivery_mode'][$i]; $sex=$_POST['sex'][$i];
		$baby_birth_weight=$_POST['baby_birth_weight'][$i]; $baby_dob=$_POST['baby_dob'][$i]; $apgar=$_POST['apgar'][$i]; $suture_removal_date=$_POST['suture_removal_date'][$i];
		$booking_status=$_POST['booking_status'][$i]; $nicu_admission=$_POST['nicu_admission'][$i];	$nicu_admission_reason=$_POST['nicu_admission_reason'][$i];
		$cause_of_death=$_POST['cause_of_death'][$i]; $dod=$_POST['dod'][$i];
		
		$sql_gynic2= "INSERT into obstetric_history(patient_id,pregnancy_number,gestation,lmp,edd,afi,anesthesia_type,placenta,outcome,delivery_mode,sex,birth_weight,dob,apgar,suture_removal_date,booking_status,nicu_admission,nicu_admission_reason,cause_of_death,dod)
				VALUES ('$id','$i','$baby_gestation','$lmp','$edd','$afi','$anesthesia_type','$placenta','$baby_outcome','$baby_delivery_mode','$sex','$baby_birth_weight','$baby_dob','$apgar','$suture_removal_date','$booking_status','$nicu_admission','$nicu_admission_reason','$cause_of_death','$dod')";
		mysql_query($sql_gynic2) or die ("Error in query: ".mysql_error());
		$i++;
		}}

		//////////////////////////////////////////////////////
		if($_POST['regularity']!=""){
		$sql_gynic3 = "INSERT into menstrual_history(visit_id,regularity,cycle,flow_amount,dysmenorrhea)
				VALUES ('$idvis','$_POST[regularity]','$_POST[cycle]','$_POST[flow_amount]','$_POST[dysmenorrhea]')";
		mysql_query($sql_gynic3) or die ("Error in query: ".mysql_error());
		}
		//////////////////////////////////////////////////////	
		if($_POST['presentation']!=""){
		$sql_gynic4= "INSERT into antenatal_visit(visit_id,fundal_height,presentation,fetal_heart_rate,liquor,scan_finding,advice)
				VALUES ('$idvis','$_POST[fundal_height]','$_POST[presentation]','$_POST[fetal_heart_rate]','$_POST[liquor]','$_POST[scan_finding]','$_POST[advice]')";
		mysql_query($sql_gynic4) or die ("Error in query: ".mysql_error());
		}
		//////////////////////////////////////////////////////
	}
	if($update && $registration){
	header("Location: registered_op.php?patient_id=" . $_POST['patient_id'] . "&&visit_id=" . $idvis);
	exit();
	}
  }
?>

<!----------------------------------------------------------------------------------------------------------------------------------------->

<?php
if (isset($_POST['first_submit'])){

 //connect to database
 include("db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 
 //////////////////////////////////////////////////////
 
	$birth_weight=($_POST['birth_weight_kgs']*1000)+$_POST['birth_weight_gms'];
	$admit_weight=($_POST['admit_weight_kgs']*1000)+$_POST['admit_weight_gms'];
	$discharge_weight=($_POST['discharge_weight_kgs']*1000)+$_POST['discharge_weight_gms'];
	$outcome_time_24= DATE("H:i", STRTOTIME($_POST['outcm_time']));
	
	$opcounter=mysql_query("SELECT count from counters WHERE counter_name='OPcounter'");
	while($record=mysql_fetch_array($opcounter)){$_POST['hosp_file_no']=++$record['count'];
	mysql_query("UPDATE counters SET count='$record[count]++' WHERE counter_name='OPcounter'");
	}

	$sql_patients = "INSERT INTO patients(patient_id, name, dob, gender, age_years, age_months, age_days, address, place, district_id, father_name, mother_name, spouse_name ,phone, blood_group, id_proof, id_proof_number, occupation, education_level, education_qualification, mr_no, bc_no, gestation,gestation_type, Delivery_mode, Delivery_location, Delivery_place, hospital_type, delivery_location_type, delivery_plan, birth_weight, congenital_anomalies)
				  VALUES (NULL,'$_POST[name]', '$_POST[dob]','$_POST[gender]', '$_POST[age_years]', '$_POST[age_months]', '$_POST[age_days]', '$_POST[address]', '$_POST[place]', '$_POST[district]', '$_POST[father_name]', '$_POST[mother_name]', '$_POST[spouse_name]','$_POST[phone_no]', '$_POST[blood_group]', '$_POST[id_proof]', '$_POST[id_proof_no]', '$_POST[occupation]', '$_POST[edu_level]', '$_POST[edu_qualification]', '$_POST[mr_no]', '$_POST[bc_no]', '$_POST[gestation]','$_POST[gestation_type]', '$_POST[delivery_mode]', '$_POST[Del_location]', '$_POST[Del_place]', '$_POST[hospital_type]', '$_POST[Delivery_loc_type]', '$_POST[booked_unbooked]', '$birth_weight', '$_POST[congenital_anomalies]')";
	echo "ERROR : ". mysql_error();
	$registration_1 = mysql_query($sql_patients);
	$id = mysql_insert_id();
	$admit_time_24= DATE("H:i", STRTOTIME($_POST['op_time']));

	$sql_patient_visits = "INSERT INTO patient_visits(patient_id, visit_type, admit_date, admit_time, department_id, hosp_file_no, insurance_case, insurance_no, unit, area, presenting_complaints, past_history, admit_weight, pulse_rate,respiratory_rate, temperature, sbp, dbp, provisional_diagnosis, doctor, nurse, final_diagnosis, icd_10, icd_10_ext, discharge_weight, outcome, outcome_date, outcome_time, ip_file_received, mlc)
					VALUES ('$id','OP', '$_POST[op_date]', '$admit_time_24', '$_POST[department]', '$_POST[hosp_file_no]', '$_POST[aarogya]', '$_POST[aarogya_number]', '$_POST[unit]', '$_POST[area]', '$_POST[chief_complaint]', '$_POST[past_history]', '$admit_weight', '$_POST[pulse_rate]', '$_POST[respiratory_rate]', '$_POST[temperature]', '$_POST[sbp]', '$_POST[dbp]', '$_POST[provisional_diagnosis]', '$_POST[doctor]', '$_POST[nurse]', '$_POST[final_diagnosis]', '$_POST[icd_10]', '$_POST[icd_10_ext]', '$discharge_weight', '$_POST[outcome]', '$_POST[outcm_date]', '$outcome_time_24', '$_POST[fileres_date]', '$_POST[mlc]')";
	
	
	$registration_2 = mysql_query($sql_patient_visits);
	$idvis = mysql_insert_id();
	
	//////////////////////////////////////////////////////
	
	if($_POST['mlc']=="1"){
	$mlc="INSERT INTO mlc (visit_id, mlc_number, ps_name) VALUES ('$idvis', '$_POST[mlc_number]', '$_POST[ps_name]')";
	$mlcreg = mysql_query($mlc);}

	 //////////////////////////////////////////////////////
	$sql_pv_update = mysql_query("UPDATE patient_visits SET admit_id=visit_id WHERE visit_id='$idvis'");
	
	 //////////////////////////////////////////////////////
	session_start();
	$actreg=mysql_query("INSERT INTO user_activity(visit_id,user_id,register) VALUES ('$idvis','$_SESSION[SESS_USER_ID]', '1')");

	 //////////////////////////////////////////////////////
	$i=1; $count = count($_POST['treatment']);
	if($count>1){
	while ($i < $count) {
	$treatment_date=$_POST['treatment_date'][$i];
	$treatment_time=$_POST['treatment_time'][$i];
	$treatment_type=$_POST['treatment_type'][$i];
	$treatment=$_POST['treatment'][$i];
	$notes=$_POST['notes'][$i];
	$duration=$_POST['duration'][$i];
	
	if($treatment_type!=''){
	$query_treat = "INSERT INTO patient_treatments(treatment_date, treatment_time, treatment_type, treatment, notes, duration, visit_id)
				VALUES ('$treatment_date', '$treatment_time', '$treatment_type', '$treatment', '$notes', '$duration', '$idvis')";
	mysql_query($query_treat) or die ("Error in query: ".mysql_error());
	}
	$i++;
	}}
	 
	
	if($_POST['department']=='22'){
	
		//////////////////////////////////////////////////////
		if($_POST['marital_status']!=""){
		$sql_gynic1= "INSERT into marital_info(patient_id, marital_status,consanguinous,marital_life)
				VALUES ('$id','$_POST[marital_status]','$_POST[consanguinous]','$_POST[marital_life]')";
		mysql_query($sql_gynic1) or die ("Error in query: ".mysql_error());
		}		
		//////////////////////////////////////////////////////

		$i=1; $count = count($_POST['baby_gestation']);
		if($count>1){
		while ($i < $count) {
		$baby_gestation=$_POST['baby_gestation'][$i]; $lmp=$_POST['lmp'][$i];	$edd=$_POST['edd'][$i];	$afi=$_POST['afi'][$i];	$anesthesia_type=$_POST['anesthesia_type'][$i];
		$placenta=$_POST['placenta'][$i]; $baby_outcome=$_POST['baby_outcome'][$i]; $baby_delivery_mode=$_POST['baby_delivery_mode'][$i]; $sex=$_POST['sex'][$i];
		$baby_birth_weight=$_POST['baby_birth_weight'][$i]; $baby_dob=$_POST['baby_dob'][$i]; $apgar=$_POST['apgar'][$i]; $suture_removal_date=$_POST['suture_removal_date'][$i];
		$booking_status=$_POST['booking_status'][$i]; $nicu_admission=$_POST['nicu_admission'][$i];	$nicu_admission_reason=$_POST['nicu_admission_reason'][$i];
		$cause_of_death=$_POST['cause_of_death'][$i]; $dod=$_POST['dod'][$i];
		
		$sql_gynic2= "INSERT into obstetric_history(patient_id,pregnancy_number,gestation,lmp,edd,afi,anesthesia_type,placenta,outcome,delivery_mode,sex,birth_weight,dob,apgar,suture_removal_date,booking_status,nicu_admission,nicu_admission_reason,cause_of_death,dod)
				VALUES ('$id','$i','$baby_gestation','$lmp','$edd','$afi','$anesthesia_type','$placenta','$baby_outcome','$baby_delivery_mode','$sex','$baby_birth_weight','$baby_dob','$apgar','$suture_removal_date','$booking_status','$nicu_admission','$nicu_admission_reason','$cause_of_death','$dod')";
		mysql_query($sql_gynic2) or die ("Error in query: ".mysql_error());
		$i++;
		}}

		//////////////////////////////////////////////////////
		if($_POST['regularity']!=""){
		$sql_gynic3 = "INSERT into menstrual_history(visit_id,regularity,cycle,flow_amount,dysmenorrhea)
				VALUES ('$idvis','$_POST[regularity]','$_POST[cycle]','$_POST[flow_amount]','$_POST[dysmenorrhea]')";
		mysql_query($sql_gynic3) or die ("Error in query: ".mysql_error());
		}
		//////////////////////////////////////////////////////	
		if($_POST['presentation']!=""){
		$sql_gynic4= "INSERT into antenatal_visit(visit_id,fundal_height,presentation,fetal_heart_rate,liquor,scan_finding,advice)
				VALUES ('$idvis','$_POST[fundal_height]','$_POST[presentation]','$_POST[fetal_heart_rate]','$_POST[liquor]','$_POST[scan_finding]','$_POST[advice]')";
		mysql_query($sql_gynic4) or die ("Error in query: ".mysql_error());
		}
		//////////////////////////////////////////////////////
	}
				
	if($registration_1 && $registration_2){
		header("location:registered_op.php?patient_id=".$id."&&visit_id=".$idvis."");
		exit();
	}
	else {
	echo "Error in Registration";
	}
}
?>
