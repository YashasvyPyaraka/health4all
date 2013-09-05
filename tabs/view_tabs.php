<script src="scripts/datepicker.js"></script>
<script type="text/javascript" src="scripts/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="scripts/jquery.mousewheel.js"></script>
<script type="text/javascript" src="scripts/validation.js"></script>
<script type="text/javascript" src="scripts/autocomplete.js"></script>
<style type="text/css">
span.link 
{
    	position: relative;
}
span.link a span 
{
    	display: none;
}
span.link a:hover 
{
    	font-size: 99%;
    	font-color: #ffffff;
}
span.link a:hover span 
{ 
   	display: block; 
    	position: absolute; 
    	margin-top: 10px; 
    	margin-left: 10px; 
	width: 150px; 
	padding: 5px; 
    	z-index: 100; 
    	color: #000000; 
    	background:orange; 
    	font: 12px "Arial", sans-serif;
    	text-align: left; 
    	text-decoration: none;
}
</style>
<script type="text/javascript">
	function reveal(div,button){
		var e=document.getElementById(div);
		var b=document.getElementById(button);
		if(e.style.display=="none"){
			for(var i=1;i<=7;i++){
				var m="div_"+i;
				var k=document.getElementById(m)
				k.style.display="none"
				var n="button_"+i;
				var j=document.getElementById(n)
				j.style.background="#eee"
				}
			e.style.display="block";
			b.style.background="#febbbb";
		} else {
			for(var i=1;i<=6;i++){
				var m="div_"+i;
				var k=document.getElementById(m)
				k.style.display="none"
				}
			b.style.background="#eee";
		}
		 return true;
		}
</script>
<form name="reg" action="view.php" onsubmit="return validateForm_ip();" method="post">
<table>
	<tr><td></td><td>
		<table width="100%">
			<tr>
				<td>Patient Name * :<?php echo "<input type=\"text\" name=\"pname\" style='text-transform:capitalize' value=\"" . $record['name'] . "\" readonly>";?></td>
				<td>Patient ID:<?php echo "<input type=\"text\" name=\"patient_id\" style=\"width:80px;\" readonly value=\"" . $record['patient_id'] . "\" readonly>";?></td>
				<td>Visit ID :<?php echo "<input type=\"text\" name=\"visit_id\" style=\"width:80px;\" value=\"" . $record['visit_id'] . "\" readonly>";?></td>
			</tr>
		</table>
	</td></tr>
	<tr>
		<td style="position:relative; vertical-align:top; padding-right:0px; padding-top:20px;">
			<table>
				<tr><td><input type="button" id="button_1" value="Patient Info" onclick="reveal('div_1','button_1');" style="width:100%; background:#febbbb"></td></tr>
				<tr><td><input type="button" id="button_2" value="Birth Info" onclick="reveal('div_2','button_2');" style="width:100%;"></td></tr>
				<tr><td><input type="button" id="button_3" value="Visit/Admit Info" onclick="reveal('div_3','button_3');" style="width:100%;"></td></tr>
				<tr id="gynic_button" <?php if($record['department_id']!=22){ echo "hidden"; }?> >
				<td><input type="button" id="button_6" value="OBG Info" onclick="reveal('div_6','button_6');" style="width:100%;"></td></tr>
				<tr><td><input type="button" id="button_4" value="Treatment Info" onclick="reveal('div_4','button_4');" style="width:100%;"></td></tr>
				<tr><td><input type="button" id="button_5" value="Discharge Info" onclick="reveal('div_5','button_5');" style="width:100%;"></td></tr>
				<tr><td><input type="button" id="button_7" value="History" onclick="reveal('div_7','button_7');" style="width:100%;"></td></tr>
			</table>
		</td>
		<td>
			
			<div style="width:750px; height:300px; overflow: auto; border: solid 1px">
			
				<div id="div_1" style="display:block; ">
					<table width="100%" id="table-tab">
						<tr>
						<td>Date of birth</td>
						<td>
						<?php echo "<input type=\"text\" name=\"dob\" value=\""; if($record['dob']!='0000-00-00') {echo date("d M Y", strtotime($record['dob']));} echo "\" readonly >";?>
						</td>
						<td>Age</td>
						<td>
						<?php if($record['age_years']==0) echo "<input type=\"text\" id=\"age\" name=\"age_years\" size=\"3\" maxlength=\"3\" value=\"\">"; else if($record['age_years']!=0) echo "<input type=\"text\" id=\"age\" name=\"age_years\" size=\"3\" maxlength=\"3\" value=\"" . $record['age_years'] . "\">";?>Yrs <?php if($record['age_months']==0) echo "<input type=\"text\" name=\"age_months\" id=\"age_months\"  size=\"3\" maxlength=\"3\" value=\"\">"; else if($record['age_months']!=0) echo "<input type=\"text\" name=\"age_months\" id=\"age_months\"  size=\"3\" maxlength=\"3\" value=\"" . $record['age_months'] . "\">" ;?>Mnts<?php if($record['age_days']==0) echo "<input type=\"text\" name=\"age_days\"  id=\"age_days\" size=\"3\" maxlength=\"3\" value=\"\">"; else if($record['age_days']!=0) echo "<input type=\"text\" name=\"age_days\"  id=\"age_days\" size=\"3\" maxlength=\"3\" value=\"" . $record['age_days'] . "\">";?>Dys
						</td>
						</tr>
						<tr>
						<td>Gender</td>
						<td>
						<?php
						$f = ''; $m = '';if($record['gender']=="F"){$f = 'checked="checked"';} else if($record['gender']=="M"){$m = 'checked="checked"';}
						echo "<input type=\"radio\" name=\"gender\" value=\"F\"" . $f . " disabled='disabled'>Female</input>";
						echo "<input type=\"radio\" name=\"gender\" value=\"M\"" . $m . " disabled='disabled'>Male</input>";
						?>
						</td>
						<td>Address</td>
						<td>
						<?php echo "<input type=\"text\" name=\"address\" value=\"" . $record['address'] . "\" readonly >";?>
						</td>
						</tr>
						<tr>
						<td>Place</td>
						<td>
						<?php echo "<input type=\"text\" name=\"place\" value=\"" . $record['place'] . "\" readonly >";?>
						</td>
						<td>District</td>
						<td>
						<?php echo "<input type=\"text\" name=\"district\" value=\"" . $record['district'] . "\" readonly >";?>
						</td>
						</tr>
						<tr><td colspan="4" align="center"><hr></td></tr>

						<tr>
						<td>Father's Name</td>
						<td>
						<?php echo "<input type=\"text\" name=\"father_name\" value=\"" . $record['father_name'] . "\" readonly >";?>
						</td>
						<td>Mother's Name</td>
						<td>
						<?php echo "<input type=\"text\" name=\"mother_name\" value=\"" . $record['mother_name'] . "\" readonly >";?>
						</td>
						</tr>
						<td>Spouse's Name *</td>
							<td>
								<?php echo "<input type=\"text\" name=\"spouse_name\" style='text-transform:capitalize' value=\"" . $record['spouse_name'] . "\">";?>
							</td>
						<tr>
						<td>Phone No</td>
						<td>
						<?php 
						if($record['phone']==0) echo "<input type=\"text\" name=\"phone_no\" value=\"\" readonly >";
						else  echo "<input type=\"text\" name=\"phone_no\" value=\"" . $record['phone'] . "\" readonly >";
						?>
						</td>
						<td>Blood Group</td>
						<td>
						<?php echo "<input type=\"text\" name=\"blood_group\" value=\"" . $record['blood_group'] . "\" readonly >";?>
						</td>
						</tr>
						<tr>
						<td>ID Proof</td>
						<td>
						<?php echo "<input type=\"text\" name=\"id_proof\" value=\"" . $record['id_proof'] . "\" readonly >";?>
						</td>
						<td>ID Proof No</td>
						<td>
						<?php echo "<input type=\"text\" name=\"id_proof_no\" value=\"" . $record['id_proof_number'] . "\" readonly >";?>
						</td>
						</tr>
						<tr>
						<td>Occupation</td>
						<td>
						<?php echo "<input type=\"text\" name=\"occupation\" value=\"" . $record['occupation'] . "\" readonly >";?>
						</td>
						<td>Education Level</td>
						<td>
						<?php echo "<input type=\"text\" name=\"edu_level\" value=\"" . $record['education_level'] . "\" readonly >";?>
						</td>
						</tr>
						<tr>
						<td>Education Qualification</td>
						<td>
						<?php echo "<input type=\"text\" name=\"edu_qualification\" value=\"" . $record['education_qualification'] . "\" readonly >";?>
						</td>
						<td>Blood Group</td>
						<td>
						<?php echo "<input type=\"text\" name=\"blood_group\" value=\"" . $record['blood_group'] . "\" readonly >";?>
						</td>
						</tr>
						</table>
				</div>
				<div id="div_2" style="display:none;">
					<table width="100%" id="table-tab">
						<tr>
						<td>MR.no</td>
						<td>
						<?php echo "<input type=\"text\" name=\"mr_no\" value=\"" . $record['mr_no'] . "\" readonly >";?>
						</td>
						<td>BC.no</td>
						<td>
						<?php echo "<input type=\"text\" name=\"bc_no\" value=\"" . $record['bc_no'] . "\" readonly >";?>
						</td>
						</tr>
						<tr>
						<td>Gestation(in weeks)</td>
							<td>
								<?php echo "<input type=\"text\" name=\"gestation\" style='text-transform:capitalize' value=\"" . $record['gestation'] . "\" readonly>";
							?>
							</td>
							<td>Gestation</td>
							<td>
							<?php echo "<input type=\"text\" name=\"gestation_type\" style='text-transform:capitalize' value=\"" . $record['gestation_type'] . "\" readonly>";
							?>	
							</td>
						</tr>

						<tr>
						<td>Delivery Location</td>
						<td colspan="3">
						<?php
						$hosp = ''; $hom = ''; $enr = '';if($record['delivery_location']=="hospital"){$hosp = 'checked="checked"';} else if($record['delivery_location']=="home") {$hom = 'checked="checked"';} else if($record['delivery_location']=="enroute") {$enr = 'checked="checked"';}
						echo "<input type=\"radio\" name=\"Del_location\" value=\"hospital\"" . $hosp . " disabled='disabled'>Hospital</input>";
						echo "<input type=\"radio\" name=\"Del_location\" value=\"home\"" . $hom . " disabled='disabled'>Home</input>";
						echo "<input type=\"radio\" name=\"Del_location\" value=\"enroute\"" . $enr . " disabled='disabled'>Enroute</input>";
						?>
						</td>
						</tr>
						<tr>
						<td>Type of Hospital</td>
						<td colspan="3">
						<?php
						$gov = ''; $pri = '';if($record['hospital_type']=="government"){$gov = 'checked="checked"';} else if($record['hospital_type']=="private"){$pri = 'checked="checked"';}
						echo "<input type=\"radio\" name=\"hospital_type\" value=\"government\"" . $gov . " disabled='disabled'>Government</input>";
						echo "<input type=\"radio\" name=\"hospital_type\" value=\"private\"" . $pri . " disabled='disabled'>Private</input>";
						?>
						</td>
						</tr>
						<tr>
						<td>Delivery Location Type</td>
						<td>
						<?php
						$in = ''; $out = '';if($record['delivery_location_type']=="IN"){$in = 'checked="checked"';} else if($record['delivery_location_type']=="OUT"){$out = 'checked="checked"';}
						echo "<input type=\"radio\" name=\"Delivery_loc_type\" value=\"IN\"" . $in . " disabled='disabled'>In-Born</input>";
						echo "<input type=\"radio\" name=\"Delivery_loc_type\" value=\"OUT\"" . $out . " disabled='disabled'>Out-Born</input>";
						?>
						</td>
						</tr>
						<tr>
						<td>Booked/Unbooked</td>
						<td>
						<?php
						$bk = ''; $ubk = '';if($record['delivery_plan']=="booked"){$bk = 'checked="checked"';} else if($record['delivery_plan']=="unbooked"){$ubk = 'checked="checked"';}
						echo "<input type=\"radio\" name=\"booked_unbooked\" value=\"booked\"" . $bk . " disabled='disabled'>Booked</input>";
						echo "<input type=\"radio\" name=\"booked_unbooked\" value=\"unbooked\"" . $ubk . " disabled='disabled'>Unbooked</input>";
						?>
						</td>
						</tr>
						<tr>
						<td>Delivery Mode</td>
						<td>
						<?php echo "<input type=\"text\" name=\"delivery_mode\" value=\"" . $record['delivery_mode'] . "\" readonly >";?>
						</td>
						<td>Hospital Name / Enroute Mode</td>
						<td>
						<?php echo "<input type=\"text\" name=\"Del_place\" value=\"" . $record['delivery_place'] . "\" readonly >";?>
						</td>
						</tr>
						<tr>
						<td>Weight at Birth</td>
						<td>
						<?php if($record['birth_weight']==0) {echo "<input type=\"text\" name=\"birth_weight_kgs\" size=\"1\" maxlength=\"1\" value=\"\" readonly>kgs<input type=\"text\" name=\"birth_weight_gms\" size=\"2\" maxlength=\"3\" value=\"\" readonly>gms";}
						else {echo "<input type=\"text\" name=\"birth_weight_kgs\" size=\"1\" maxlength=\"1\" value=\"" . ($record['birth_weight']-$record['birth_weight']%1000)/1000 . "\" readonly>kgs<input type=\"text\" name=\"birth_weight_gms\" size=\"2\" maxlength=\"3\" value=\"" . $record['birth_weight']%1000 . "\" readonly>gms";}
						?>
						</td>
						<td>Congenital anomalies</td>
						<td>
						<?php echo "<input type=\"text\" name=\"congenital_anomalies\" value=\"" . $record['congenital_anomalies'] . "\" readonly >";?>
						</td>
						</tr>
					</table>
				</div>
				<div id="div_3" style="display:none;" >
					<table width="100%" id="table-tab">
						<tr>
						<td>Visit/Admit Date</td>
						<td>
						<?php echo "<input type=\"text\" name=\"admit_date\" value=\""; if($record['admit_date']!='0000-00-00') {echo date("d M Y", strtotime($record['admit_date']));} echo "\" readonly >";?>
						</td>
						<td>Visit/Admit Time</td>
						<td>
						<?php 
						echo "<input type=\"text\" name=\"admit_time\" value=\""; if($record['admit_time']!='00:00:00') {echo date("g:ia", strtotime($record['admit_time']));} echo "\" readonly >";?>
						</td>
						</tr>
						<tr>
						<td>Department</td>
						<td>
						<?php echo "<input type=\"text\" name=\"department\" value=\"" . $record['department'] . "\" readonly >";?>
						</td>
						<td>Presenting Complaints</td>
						<td>
						<?php echo "<input type=\"text\" name=\"presenting_complaints\" value=\"" . $record['presenting_complaints'] . "\" readonly >";?>
						</td>
						</tr>
						<tr><td colspan="4" align="center"><hr></td></tr>
						<tr>
						<td>Hospital File No</td>
						<td>
						<?php if($record['hosp_file_no']==0) echo "<input type=\"text\" name=\"hosp_file_no\" value=\"\" readonly >";
						else echo "<input type=\"text\" name=\"hosp_file_no\" value=\"" . $record['hosp_file_no'] . "\" readonly >";
						?>
						</td>
						<td>Past History</td>
						<td>
						<?php echo "<input type=\"text\" name=\"past_history\" value=\"" . $record['past_history'] . "\" readonly >";?>
						</td>
						</tr>
						<tr>
						<td>Unit</td>
						<td>
						<?php
						 $unit="$record[unit]"; 
						 $result_unit = mysql_query("select * from units where unit_id='" . $unit . "'");
						 if(mysql_num_rows($result_unit)>0){
						 while ($record_unit = mysql_fetch_array($result_unit,MYSQL_ASSOC)){
						 echo "<input type=\"text\" name=\"unit\" value=\"" . $record_unit['unit_name'] . "\" readonly >";
						 }}
						 else{
						 echo "<input type=\"text\" name=\"unit\" value=\"\" readonly >";
						 }
						?>
						</td>
						<td>Area</td>
						<td>
						<?php
						 $area="$record[area]";
						 $result_area = mysql_query("select * from areas where area_id='" . $area . "'");
						 if(mysql_num_rows($result_area)>0){
						 while ($record_area = mysql_fetch_array($result_area,MYSQL_ASSOC)){
						 echo "<input type=\"text\" name=\"area\" value=\"" . $record_area['area_name'] . "\" readonly >";
						 }}
						 else{
						 echo "<input type=\"text\" name=\"unit\" value=\"\" readonly >";
						 }
						?>
						</td>
						</tr>
						<tr>
						<td>Weight at Admission</td>
						<td>
						<?php if($record['admit_weight']==0) {echo "<input type=\"text\" name=\"admit_weight_kgs\" size=\"2\" maxlength=\"3\" value=\"\" readonly>kgs<input type=\"text\" name=\"admit_weight_gms\" size=\"2\" maxlength=\"3\" value=\"\" readonly>gms";}
						else {echo "<input type=\"text\" name=\"admit_weight_kgs\" size=\"2\" maxlength=\"3\" value=\"" . ($record['admit_weight']-$record['admit_weight']%1000)/1000 . "\" readonly>kgs<input type=\"text\" name=\"admit_weight_gms\" size=\"2\" maxlength=\"3\" value=\"" . $record['admit_weight']%1000 . "\" readonly>gms";}
						?>
						</td>
						<td>Pulse Rate</td>
						<td>
						<?php if($record['pulse_rate']==0) echo "<input type=\"text\" name=\"pulse_rate\" value=\"\" readonly >";
						else echo "<input type=\"text\" name=\"pulse_rate\" value=\"" . $record['pulse_rate'] . "\" readonly >";
						?>
						</td>
						</tr>
						<tr>
						<td>Respiratory Rate</td>
						<td>
						<?php if($record['respiratory_rate']==0) echo "<input type=\"text\" name=\"respiratory_rate\" value=\"\" readonly >";
						else echo "<input type=\"text\" name=\"respiratory_rate\" value=\"" . $record['respiratory_rate'] . "\" readonly >";
						?>
						</td>
						<td>Temperature</td>
						<td>
						<?php if($record['temperature']==0) echo "<input type=\"text\" name=\"temperature\" value=\"\" readonly >";
						else echo "<input type=\"text\" name=\"temperature\" value=\"" . $record['temperature'] . "\" readonly >";
						?>
						</td>
						</tr>
						<tr>
						<td>Blood Pressure</td>
						<td>
						<?php if($record['sbp']==0) echo "<input type=\"text\" name=\"sbp\" style=\"width:50px;\" value=\"\" readonly>"; else echo "<input type=\"text\" name=\"dbp\" style=\"width:50px;\" value=\"" . $record['sbp'] . "\" readonly>";?> / <?php if($record['dbp']==0) echo "<input type=\"text\" name=\"dbp\" style=\"width:50px;\" value=\"\" readonly>"; else echo "<input type=\"text\" name=\"dbp\" style=\"width:50px;\" value=\"" . $record['dbp'] . "\" readonly>";?>
						</td>
						<td>Provisional Diagnosis</td>
						<td>
						<?php echo "<input type=\"text\" name=\"provisional_diagnosis\" value=\"" . $record['provisional_diagnosis'] . "\" readonly >";?>
						</td>
						</tr><tr>
						<td>Doctor Name</td>
						<td>
						<?php echo "<input type=\"text\" name=\"doctor\" value=\"" . $record['doctor'] . "\" readonly >";?>
						</td>
						<td>Nurse Name</td>
						<td>
						<?php echo "<input type=\"text\" name=\"nurse\" value=\"" . $record['nurse'] . "\" readonly >";?>
						</td>
						</tr>
						<tr>
						<td>Aarogya Sri</td>
						<td>
						<?php $y = ''; $n = '';if($record['insurance_case']=="yes"){$y = 'checked="checked"';} else if($record['insurance_case']=="no"){$n = 'checked="checked"';}
						echo "<input type=\"radio\" name=\"aarogya\" value=\"yes\"" . $y . " disabled='disabled'>Yes</input>";
						echo "<input type=\"radio\" name=\"aarogya\" value=\"no\"" . $n . " disabled='disabled'>No</input>"; ?>
						</td>
						<td>Aarogya Sri no.</td>
						<td>
						<?php echo "<input type=\"text\" name=\"aarogya_number\" value=\"" . $record['insurance_no'] . "\" readonly >";?>
						</td>
						</tr>
						<tr>
						<td>MLC number</td>
						<td>
						<?php
						include("db_connect.php");
						$query = "SELECT * FROM mlc";
						mysql_connect("$dbhost","$dbuser","$dbpass");
						mysql_select_db("$dbdatabase");
						$result = mysql_query($query);
						$row=mysql_fetch_array($result);
						echo "<input type=\"text\" name=\"mlc_number\" ondblclick=\"this.checked=!this.checked\" value=\"" . $row['mlc_number'] . "\" readonly>";
						?>
						</td>
						<td>PS Name</td>
						<td>
						<?php
						echo "<input type=\"text\" name=\"ps_name\" ondblclick=\"this.checked=!this.checked\" value=\"". $row['ps_name'] . "\" readonly>";
						?>
						</td>
						</tr>
						</tbody>
						</table>
				</div>
				<div id="div_6" style="display:none;">
					<?php include("tabs/gynic/gynic_v_u.php"); ?>
				</div>
				<div id="div_4" style="display:none;">
					<script type="text/javascript" src="scripts/treatment.js"></script>
					<table width="100%" id="table-tab">
						<tr>
							<td>Date of Treatment</td>
							<td><input type="text" id="treatment_date"></td>
							<td>Time of Treatment</td>
							<td><input type="text" id="treatment_time" size="10"></td>
						</tr>
						<tr>
							<td>Type of Treatment</td>
							<td>
								<select id="treatment_type" style="width:155px;">
									<option value="0">--Select--</option>
									<?php 
									$sql_treat=mysql_query("select * from treatment_type");
									while($row_treat=mysql_fetch_array($sql_treat)) { 
									echo "<option value=\"" . $row_treat['treatment_type'] . "\">" . $row_treat['treatment_type'] . "</option>";
									}
									?>
								</select>
							</td>
							<td>Duration</td>
							<td>
								<table width="100%"><tr><td>Days</td><td>Hours</td><td>Mins</td></tr><tr>
								<td><input type="text" id="duration_days" style="width:50px;" maxlength="3"></td>
								<td><input type="text" id="duration_hours" style="width:50px;" maxlength="3"></td>
								<td><input type="text" id="duration_mins" style="width:50px;" maxlength="3"></td>
								</tr></table>
							</td>
							
						</tr>
						<tr>
							<td>Treatment</td>
							<td><textarea rows="3" cols="20" id="treatment" style='text-transform:capitalize'></textarea></td>
							
							<td> Notes</td>
							<td><textarea rows="3" cols="20" id="notes" style='text-transform:capitalize'></textarea></td>
							
						</tr>
						<tr>
							<td colspan="4" align="center"><input type="button" value="Add Treatment To List" onclick="addRow('dataTable')" />    <input type="button" value="Delete From the List" onclick="deleteRow('dataTable')" /></td>
						</tr>
					</table>	
					<div class="scrollbar" style=" height: 180px; ">
					<table id="dataTable">
						<tr id="dataTablehead" hidden>
						<th>Date</th>
						<th>Time</th>
						<th>Treatment Type</th>
						<th>Treatment</th>
						<th>Duration(Hrs,Dys,Mns)</th>
						<th>Notes</th>
						</tr>
						<tr hidden>
							<td><input type="checkbox" name="chk"/></td>
							<td><input type="text" name="treatment_date[]"></td>
							<td><input type="text" name="treatment_time[]"></td>
							<td><input type="text" name="treatment_type[]"></td>
							<td><input type="text" name="treatment[]"></td>
							<td><input type="text" name="duration[]"></td>
							<td><textarea rows="1" cols="20" name="notes[]"></textarea></td>
						</tr>
					</table>
					<table>
					<?php
					$query_obstetric= "SELECT * 
							FROM patient_treatments 
							WHERE visit_id='".$record['visit_id']."'";
					
					$result_obstetric = mysql_query($query_obstetric);
					if(mysql_num_rows($result_obstetric)!= 0) { ?>
					<tr>
						<th></th>
						<th>Date</th>
						<th>Time</th>
						<th>Treatment Type</th>
						<th>Treatment</th>
						<th>Duration(Hrs,Dys,Mns)</th>
						<th>Notes</th>
					</tr>
				<?php	
					while($record_obstetric = mysql_fetch_array($result_obstetric)){
				?>
					<tr>
						<td><input type="checkbox" name="chk"/></td>
							<td><input type="text" name="treatment_date[]" value="<?php echo $record_obstetric['treatment_date']; ?>"></td>
							<td><input type="text" name="treatment_time[]" value="<?php echo $record_obstetric['treatment_time']; ?>"></td>
							<td><input type="text" name="treatment_type[]" value="<?php echo $record_obstetric['treatment_type']; ?>"></td>
							<td><input type="text" name="treatment[]" value="<?php echo $record_obstetric['treatment']; ?>"></td>
							<td><input type="text" name="duration[]" value="<?php echo $record_obstetric['duration']; ?>"></td>
							<td><textarea rows="1" cols="20" name="notes[]" value="<?php echo $record_obstetric['notes']; ?>"></textarea></td>
					</tr>
				<?php } 
				}?>
				</table>
					</div>
				</div>

				<div id="div_5" style="display:none;">
					<table width="100%" id="table-tab">
						<tr>
						<td>Final Diagnosis</td>
						<td>
						<?php echo "<input type=\"text\" name=\"final_diagnosis\" value=\"" . $record['final_diagnosis'] . "\" readonly >";?>
						</td>
						</tr>
						<tr>
						<td>ICD-10 Code</td>
						<td>
						<?php echo "<input type=\"text\" name=\"icd_10\" style=\"width:50px;\" value=\"" . $record['icd_10'] . "\" readonly >";?> . <?php if($record['icd_10_ext']==0) echo "<input type=\"text\" name=\"icd_10_ext\" style=\"width:30px;\" value=\"\" readonly >";
						else echo "<input type=\"text\" name=\"icd_10_ext\" style=\"width:30px;\" value=\"" . $record['icd_10_ext'] . "\" readonly >";
						?>
						</td>
						</tr>
						<tr>
						<td>Weight at Discharge</td>
						<td>
						<?php if($record['discharge_weight']==0) {echo "<input type=\"text\" name=\"discharge_weight_kgs\" size=\"2\" maxlength=\"3\" value=\"\" readonly>kgs<input type=\"text\" name=\"discharge_weight_gms\" size=\"2\" maxlength=\"3\" value=\"\" readonly>gms";}
						else {echo "<input type=\"text\" name=\"discharge_weight_kgs\" size=\"2\" maxlength=\"3\" value=\"" . ($record['discharge_weight']-$record['discharge_weight']%1000)/1000 . "\" readonly>kgs<input type=\"text\" name=\"discharge_weight_gms\" size=\"2\" maxlength=\"3\" value=\"" . $record['discharge_weight']%1000 . "\" readonly>gms";}
						?>

						</td>
						</tr>
						<tr>
						<td>Outcome</td>
						<td>
						<?php
						$dtf = ''; $dth = ''; $dis = ''; $lam = ''; $abs = ''; if($record['outcome']=="transfer"){$dtf = 'checked="checked"';} else if($record['outcome']=="death"){$dth = 'checked="checked"';} else if($record['outcome']=="discharge") {$dis = 'checked="checked"';} else if($record['outcome']=="lama") {$lam = 'checked="checked"';} else if($record['outcome']=="absconded") {$abs = 'checked="checked"';}
						echo "<input type=\"radio\" name=\"outcome\" value=\"transfer\"" . $dtf . " disabled='disabled'>Transfer</input>";
						echo "<input type=\"radio\" name=\"outcome\" value=\"discharge\"" . $dis . " disabled='disabled'>Discharge</input>";
						echo "<input type=\"radio\" name=\"outcome\" value=\"lama\"" . $lam . " disabled='disabled'>Lama</input>";
						echo "<input type=\"radio\" name=\"outcome\" value=\"absconded\"" . $abs . " disabled='disabled'>Asconded</input>";
						echo "<input type=\"radio\" name=\"outcome\" value=\"death\"" . $dth . " disabled='disabled'>Death</input>";
						?>
						</td></tr>
						<tr>
						<td>Outcome Date</td>
						<td>
						<?php echo "<input type=\"text\" name=\"outcm_date\" value=\""; if($record['outcome_date']!='0000-00-00') {echo date("d M Y", strtotime($record['outcome_date']));} echo "\" readonly >";?>
						</td>
						</tr>
						<tr>
						<td>Outcome Time</td>
						<td>
						<?php 
						echo "<input type=\"text\" name=\"outcm_time\" value=\""; if($record['outcome_time']!='00:00:00') {echo date("g:ia", strtotime($record['outcome_time']));} echo "\" readonly >";?>
						</td>
						</tr>
						<tr>
						<td>File Recieved Date by MRD</td>
						<td>
						<?php echo "<input type=\"text\" name=\"fileres_date\" value=\""; if($record['ip_file_received']!='0000-00-00') {echo date("d M Y", strtotime($record['ip_file_received']));} echo "\" readonly >";?>
						</td>
						</tr>
						</table>
				</div >
				<div id="div_7" style="display:none;">
					<?php include 'tabs/history.php' ;?>
				</div>
			</div>
		</td>
	</tr>
	
</table>
</form>
