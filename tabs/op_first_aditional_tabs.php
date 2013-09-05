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
			for(var i=1;i<=6;i++){
				var m="div_"+i;
				var k=document.getElementById(m)
				k.style.display="none"
				var n="button_"+i;
				var j=document.getElementById(n)
				j.style.background="#eee"
				j.style.zIndex=0;
				}
			e.style.display="block";
			b.style.zIndex=1;
			// b.style.background="#febbbb";
			b.style.background="#febbbb";
			b.style.borderRight="none";
			
		} else {
			for(var i=1;i<=6;i++){
				var m="div_"+i;
				var k=document.getElementById(m)
				k.style.display="none"
				}
			b.style.background="#eee";
			b.style.zIndex=0;
		}
		 return true;
		}
</script>

<table>
	<tr><td></td><td><b style="font-size:110%">Additional Info</b></td></tr>
	<tr>
		<td style="position: relative; vertical-align:top; padding-right:0; padding-top:20px;">
			<table>
				<tr><td><input type="button" id="button_1" value="Patient Info" onclick="reveal('div_1','button_1');" style="position:relative;width:104%; "></td></tr>
				<tr><td><input type="button" id="button_2" value="Birth Info" onclick="reveal('div_2','button_2');" style="position:relative;width:104%;"></td></tr>
				<tr><td><input type="button" id="button_3" value="Visit/Admit Info" onclick="reveal('div_3','button_3');" style="position:relative;width:104%;"></td></tr>
				<tr id="gynic_button" hidden><td><input type="button" id="button_6" value="OBG Info" onclick="reveal('div_6','button_6');" style="position:relative;width:104%;"></td></tr>
				<tr><td><input type="button" id="button_4" value="Treatment Info" onclick="reveal('div_4','button_4');" style="position:relative;width:104%;"></td></tr>
				<tr><td><input type="button" id="button_5" value="Discharge Info" onclick="reveal('div_5','button_5');" style="position:relative;width:104%;"></td></tr>
			</table>
		</td>
		<td style=" position: relative;vertical-align:top; padding-left:-10px;">
			<fieldset style="width:750px; height:300px; overflow: auto; background:white">
				<div id="div_1" style="display:none; ">
					<table width="100%" id="table-tab">
						<tr>
							<td>Address</td>
							<td><input type="text" name="address" style='text-transform:capitalize'></td>
						
							<td>Place</td>
							<td><input type="text" name="place" style='text-transform:capitalize'></td>
							
						</tr>
						<tr>
							<td>Father's Name *</td>
							<td><input type="text" name="father_name" style='text-transform:capitalize'></td>
							<td>Mother's Name *</td>
							<td><input type="text" name="mother_name" style='text-transform:capitalize'></td>
						</tr>
						<tr>
							<td>Spouse's Name *</td>
							<td>
								<input type="text" name="spouse_name" style='text-transform:capitalize'>
							</td>
							<td>Phone No</td>
							<td><input type="text" name="phone_no" maxlength="13"></td>
							
						</tr>
						<tr>
							<td>ID Proof</td>
							<td><input type="text" id="idproof" name="id_proof" tabindex="2" onchange="DropDownIndexClear('idprooftextbox');" style="width:133px;position: absolute; z-index: 1;text-transform:capitalize;margin-top:-13px;" />
							<select name="" id="idprooftextbox" tabindex="1000" onchange="DropDownTextToBox(this,'idproof');" style="position: absolute; z-index: 0; width: 155px;margin-top:-13px;" >
							<?php
								$idproof=array("Voter ID","Adhaar Card","Ration Card","Passport","PAN Card","College ID");
								for($i = 0, $size = count($idproof); $i < $size; $i++)
								{
										 echo "<option value=\"".$idproof[$i]."\" >".$idproof[$i]."</option>";
								}
							?>
							</select>
							<script language="javascript" type="text/javascript">
								DropDownIndexClear("idprooftextbox");
							</script>
							</td>
							<td>ID Proof No</td>
							<td><input type="text" name="id_proof_no" style='text-transform:uppercase'></td>
						</tr>
						<tr>
							<td>Occupation</td>
							<td><input type="text" id="occupation" name="occupation" tabindex="2" onchange="DropDownIndexClear('occtextbox');" style="width:133px; position: absolute; z-index: 1;text-transform:capitalize;margin-top:-13px;" />
							<select name="" id="occtextbox" tabindex="1000" onchange="DropDownTextToBox(this,'occupation');" style="position: absolute; z-index: 0; width: 155px;margin-top:-13px;" >
							<?php
								$occupation=array('Doctor','Teacher','Government Employee','Private Employee','Farmer','Unemployed','Student','Retired','House Wife');
								for($i = 0, $size = count($occupation); $i < $size; $i++)
								{
										echo "<option value=\"".$occupation[$i]."\" title=\"".$occupation[$i]."\">".$occupation[$i]."</option>";
								}
							?>
							</select>
							<script language="javascript" type="text/javascript">
								DropDownIndexClear("occtextbox");
							</script>
							</td>
							<td>Education Level</td>
							<td><input type="text" id="edulevel" name="edu_level" tabindex="2" onchange="DropDownIndexClear('edleveltextbox');" style="width:133px; position: absolute; z-index: 1;text-transform:capitalize; margin-top:-13px;" />
							<select name="" id="edleveltextbox" tabindex="1000" onchange="DropDownTextToBox(this,'edulevel');" style="position: absolute; z-index: 0; width: 155px;margin-top:-13px;" >
							<?php
								$edulevel=array('Illiterate','Literate','Below Primary','Primary','Secondary','Intermediate','Diploma','Undergraduate','Post Graduate');
								for($i = 0, $size = count($edulevel); $i < $size; $i++)
								{
										echo "<option value=\"".$edulevel[$i]."\" title=\"".$edulevel[$i]."\">".$edulevel[$i]."</option>";
								}
							?>
							</select>
							<script language="javascript" type="text/javascript">
								DropDownIndexClear("edleveltextbox");
							</script>
							</td>
						</tr>
						<tr>
							<td>Education Qualification</td>
							<td><input type="text" id="eduqual" name="edu_qualification" tabindex="2" onchange="DropDownIndexClear('edqualtextbox');" style="width:133px; position: absolute; z-index: 1;text-transform:capitalize; margin-top:-13px;" />
							<select name="" id="edqualtextbox" tabindex="1000" onchange="DropDownTextToBox(this,'eduqual');" style="position: absolute; z-index: 0; width: 155px;margin-top:-13px;" >
							<?php
								$eduqual=array('10th','12th','B.Com','B.Sc','B.A','B.Tech/B.E','Diploma','M.B.B.S','Ph.D','M.B.A','L.L.B','M.com','M.Sc','M.A','M.Tech','M.D','F.R.C.S');
								for($i = 0, $size = count($eduqual); $i < $size; $i++)
								{
										echo "<option value=\"".$eduqual[$i]."\" title=\"".$eduqual[$i]."\">".$eduqual[$i]."</option>";
								}
							?>
							</select>
							<script language="javascript" type="text/javascript">
								DropDownIndexClear("edqualtextbox");
							</script>
							</td>
						</tr>
							<td>Blood Group</td>
							<td><select name="blood_group">
								<option value="" selected>---SELECT---</option>
								<option value="A+">A+</option>
								<option value="A-">A-</option>
								<option value="B+">B+</option>
								<option value="B-">B-</option>
								<option value="AB+">AB+</option>
								<option value="AB-">AB-</option>
								<option value="O+">O+</option>
								<option value="O-">O-</option>
							</select></td>
					</table>
				</div>
				<div id="div_2" style="display:none;">
					<table width="100%" id="table-tab">
						<tr>
							<td>MR.no
								<span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Medical Record Number</span></a></span>
							</td>
							<td><input type="text" name="mr_no" style='text-transform:uppercase'></td>
							<td>BC.no
								<span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Birth Certificate Number</span></a></span>
							</td>
							<td><input type="text" name="bc_no" style='text-transform:uppercase'></td>
						</tr>
						<tr>
							<td>Gestation(in weeks)</td>
							<td>
							 	<input type="text" name="gestation" style='text-transform:capitalize'>
							</td>
							<td>Gestation</td>
							<td>
								<select name="gestation_type" style="width:155px">
									<option value="" selected>---SELECT---</option>
									<option value="Term">Term</option>
									<option value="Pre_Term">Pre-Term</option>
									<option value="Post_Term">Post-Term</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Delivery Location</td>
							<td colspan="3">
								<input type="radio" id="del_loc" name="Del_location" ondblclick="this.checked=!this.checked" value="hospital" >Hospital  
								<input type="radio" id="del_home" name="Del_location" ondblclick="this.checked=!this.checked" value="home">Home  
								<input type="radio" id="del_enroute" name="Del_location" ondblclick="this.checked=!this.checked" value="enroute">Enroute
							</td>
							
						</tr>
						<tbody id="del_type" hidden>
							<tr>
								<td>Type of Hospital</td>
								<td colspan="3">
									<input type="radio" name="hospital_type" ondblclick="this.checked=!this.checked" value="government">Government  
									<input type="radio" name="hospital_type" ondblclick="this.checked=!this.checked" value="private">Private
								</td>
							</tr>
							<tr>
								<td>Delivery Location Type</td>
								<td>
									<input type="radio" name="Delivery_loc_type" ondblclick="this.checked=!this.checked" value="IN">In-Born  
									<input type="radio" name="Delivery_loc_type" ondblclick="this.checked=!this.checked" value="OUT">Out-Born
								</td>
							</tr>
							<tr>
								<td>Booked/Unbooked</td>
								<td>
									<input type="radio" name="booked_unbooked" ondblclick="this.checked=!this.checked" value="booked">Booked  
									<input type="radio" name="booked_unbooked" ondblclick="this.checked=!this.checked" value="unbooked">Unbooked
								</td>
							</tr>
						</tbody>
						<tr>
							<td>Delivery Mode</td>
								<td>
									<select name="delivery_mode" style="width:155px">
									<option value="" selected>---SELECT---</option>
									<option value="SPVD">SPVD</option>
									<option value="EL-LSCS">EL-LSCS</option>
									<option value="EM-LSCS">EM-LSCS</option>
									<option value="Assisted Breech Delivery">Assisted Breech Delivery</option>
									<option value="Forcepts">Forcepts</option>
									<option value="Vaccuum Extraction">Vaccuum Extraction</option>
									<option value="Episiotomy">Episiotomy</option>
								</select>
							</td>
							<td>Hospital Name / Enroute Mode</td>
							<td>
								<input type="text" name="Del_place" style='text-transform:capitalize'>
							</td>
							
						</tr>
						<tr>
							<td>Weight at Birth</td>
							<td>
								<input type="text" name="birth_weight_kgs" size="1" maxlength="1">kgs<input type="text" name="birth_weight_gms" size="2" maxlength="3">gms
							</td>
							<td>Congenital anomalies</td>
							<td>
								<input type="text" name="congenital_anomalies" style='text-transform:capitalize'>
							</td>
						</tr>
					</table>
				</div>
				<div id="div_3" style="display:none;" >
					<table width="100%" id="table-tab">
						<tr>
							<td>Presenting Complaints</td>
							<td><input type="text" name="presenting_complaints" style='text-transform:capitalize'></td>
						
							<td>Hospital File No
							<span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>IN Patient Case Sheet Number</span></a></span>
							</td>
							<td><input type="text" name="hosp_file_no" disabled></td>
						</tr>
						<tr>
							<td>Past History</td>
							<td><input type="text" name="past_history" style='text-transform:capitalize'></td>
						
							<td>Unit</td>
							<td>
								<select name="unit" id="unit" style="width:155px;">
									<option selected="selected" value="" disabled>--Select--</option>
									<?php
									$sql=mysql_query("select * from units");
									while($row=mysql_fetch_array($sql))
									{
										$id=$row['unit_id'];
										$data=$row['unit_name'];
										$dept_id=$row['department_id'];		
										echo '<option value="'.$id.'" name="'.$dept_id.'" hidden>'.$data.'</option>';
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Area</td>
							<td>
								<select name="area" id="area" style="width:155px;">
									<option selected="selected" value="">--Select--</option>
									<?php
									$sql=mysql_query("select * from areas");
									while($row=mysql_fetch_array($sql))
									{
										$id=$row['area_id'];
										$data=$row['area_name'];
										$dept_id=$row['department_id'];
										echo '<option value="'.$id.'" name="'.$dept_id.'" hidden>'.$data.'</option>';
									}			
									?>
								</select>
							</td>
						
							<td>Weight at Admission</td>
							<td><input type="text" name="admit_weight_kgs" size="2" maxlength="3">kgs<input type="text" name="admit_weight_gms" size="2" maxlength="3">gms</td>
						</tr>
						<tr>
							<td>Pulse Rate</td>
							<td><input type="text" name="pulse_rate"></td>
						
							<td>Respiratory Rate</td>
							<td><input type="text" name="respiratory_rate"></td>
						</tr>
						<tr>
							<td>Temperature</td>
							<td><input type="text" name="temperature" style='text-transform:capitalize'></td>
						
							<td>Blood Pressure</td>
							<td><input type="text" name="sbp" style="width:50px;"> / <input type="text" name="dbp" style="width:50px;"></td>
						</tr>
						<tr>
							<td>Provisional Diagnosis</td>
							<td><input type="text" name="provisional_diagnosis" style='text-transform:capitalize'></td>

							<td>Doctor Name</td>
							<td><input type="text" name="doctor" style='text-transform:capitalize'></td>
						</tr>	
							<td>Nurse Name</td>
							<td><input type="text" name="nurse" style='text-transform:capitalize'></td>
						
							<td>Aarogya Sri
							<span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Health Insurance Scheme</span></a></span>
							</td>
							<td>
								<input type="radio" name="aarogya" id="aarogya_yes" ondblclick="this.checked=!this.checked" value="yes" onchange="aarogya_td();">Yes
								<input type="radio" name="aarogya" id="aarogya_no" ondblclick="this.checked=!this.checked" value="no" onchange="aarogya_td();">No
							</td>
						</tr>
						<tr>
							<td>Aarogya Sri no.</td>
							<td><input type="text" name="aarogya_number" style='text-transform:uppercase' id="aarogya_number" readonly></td>
							<td>Referred From</td>
							<td><input type="text" name="referred_from" style='text-transform:capitalize'></td>
						</tr>
						<tr>
							<td>Referral Reason</td>
							<td><input type="text" name="referral_reason" style='text-transform:capitalize'></td>
						
							<td>MLC
								<span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Medico Legal Case</span></a></span>
							</td>

						<td>
								<input type="radio" name="mlc" id="mlc_yes" ondblclick="this.checked=!this.checked" value="1">Yes
								<input type="radio" name="mlc" id="mlc_no" ondblclick="this.checked=!this.checked" value="0">No
							</td>
						<tbody id="mlc_y" hidden>
							<tr>
								<td>MLC no.</td>
								<td><input type="text" name="mlc_number" style='text-transform:uppercase' id="mlc_number"></td>
								<td>PS Name</td>
								<td><input type="text" name="ps_name" id="ps_name" style='text-transform:uppercase' style='text-transform:capitalize'>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div id="div_6" style="display:none;">
					<?php include("tabs/gynic/gynic_first.php"); ?>
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
						<th></th>
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
					</div>
				</div>
				<div id="div_5" style="display:none;">
					<table width="100%" id="table-tab">
						<tr>
							<td>Final Diagnosis</td>
							<td><input type="text" name="final_diagnosis" style='text-transform:capitalize'></td>
						</tr>
						<tr>
							<td>ICD-10 Code</td>
							<td><input type="text" name="icd_10" style="width:50px;"> . <input type="text" name="icd_10_ext" style="width:30px;"></td>
						</tr>
						<tr>
							<td>Weight at Discharge</td>
							<td><input type="text" name="discharge_weight_kgs" size="2" maxlength="3">kgs<input type="text" name="discharge_weight_gms" size="2" maxlength="3">gms</td>
						</tr>
						<tr>
							<td>Outcome</td>
							<td>
								<input type="radio" name="outcome" id="out_transfer" ondblclick="this.checked=!this.checked" value="transfer">Transfer
								<input type="radio" name="outcome" id="out_discharge" ondblclick="this.checked=!this.checked" value="discharge">Discharge
								<input type="radio" name="outcome" id="out_lama" ondblclick="this.checked=!this.checked" value="lama">LAMA
								<input type="radio" name="outcome" id="out_abscond" ondblclick="this.checked=!this.checked" value="absconded">Absconded
								<input type="radio" name="outcome" id="out_death" ondblclick="this.checked=!this.checked" value="death">Death
							</td>
						</tr>
						<tbody id="outcome_dt" hidden>
							<tr>
								<td>Outcome Date *</td>
								<td>
									<input type="text" id="odatepicker" name="outcm_date">
								</td>
							</tr>
							<tr>
								<td>Outcome Time *</td>
								<td>
									<input type="text" id="otimepicker" size="10" name="outcm_time">
								</td>
							</tr>
						</tbody>
						<tr>
							<td>File Recieved Date by MRD</td>
							<td>
								<input type="text" id="rdatepicker" name="fileres_date">
							</td>
						</tr>
					</table>
				</div>
			
				</fieldset>
		</td>
	</tr>
</table>
