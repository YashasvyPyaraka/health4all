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
<form name="reg" action="update.php" onsubmit="return validateForm_ip();" method="post">
<table>
	<tr><td></td><td>
		<table width="100%">
			<tr> <input type="hidden" name="visit_id" value="<?php echo $record['visit_id'];?>">
				<td>Patient Name * :<?php echo "<input type=\"text\" name=\"pname\" style='text-transform:capitalize' value=\"" . $record['name'] . "\">";?></td>
				<td>Patient ID:<?php echo "<input type=\"text\" name=\"patient_id\" style=\"width:80px;\" readonly value=\"" . $record['patient_id'] . "\">";?></td>
			</tr>
		</table>
	</td></tr>
	<tr>
		<td style="vertical-align:top; padding-right:0px; padding-top:20px;">
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
								<?php 
								if($record['dob']==0) echo "<input type=\"text\" id=\"datepicker\" name=\"dob\" value=\"\">";
								if($record['dob']!=0) echo "<input type=\"text\" id=\"datepicker\" name=\"dob\" value=\"" . $record['dob'] . "\">";?>
							</td>
							<td>Age:</td>
							<td>
							<?php if($record['age_years']==0) echo "<input type=\"text\" id=\"age\" name=\"age_years\" size=\"3\" maxlength=\"3\" value=\"\">"; else if($record['age_years']!=0) echo "<input type=\"text\" id=\"age\" name=\"age_years\" size=\"3\" maxlength=\"3\" value=\"" . $record['age_years'] . "\">";?>Yrs <?php if($record['age_months']==0) echo "<input type=\"text\" name=\"age_months\" id=\"age_months\"  size=\"3\" maxlength=\"3\" value=\"\">"; else if($record['age_months']!=0) echo "<input type=\"text\" name=\"age_months\" id=\"age_months\"  size=\"3\" maxlength=\"3\" value=\"" . $record['age_months'] . "\">" ;?>Mnts<?php if($record['age_days']==0) echo "<input type=\"text\" name=\"age_days\"  id=\"age_days\" size=\"3\" maxlength=\"3\" value=\"\">"; else if($record['age_days']!=0) echo "<input type=\"text\" name=\"age_days\"  id=\"age_days\" size=\"3\" maxlength=\"3\" value=\"" . $record['age_days'] . "\">";?>Dys
							</td>
						</tr>	
						<tr>
							<td>Gender</td>
							<td>
							<?php
								$f = ''; $m = '';if($record['gender']=="F"){$f = 'checked="checked"';} else if($record['gender']=="M"){$m = 'checked="checked"';}
							echo "<input type=\"radio\" name=\"gender\" ondblclick=\"this.checked=!this.checked\" value=\"F\"" . $f . ">Female</input>";
							echo "<input type=\"radio\" name=\"gender\" ondblclick=\"this.checked=!this.checked\" value=\"M\"" . $m . ">Male</input>";
							?>
							</td>
							<td>Address</td>
							<td>
							<?php echo "<input type=\"text\" name=\"address\" style='text-transform:capitalize' value=\"" . $record['address'] . "\">";?>
							</td>
						</tr>
						<tr>
							<td>Place</td>
							<td>
								<?php echo "<input type=\"text\" name=\"place\" style='text-transform:capitalize' value=\"" . $record['place'] . "\">";?>
							</td>
							<td>District</td>
							<td>
								<?php 
								$dis="$record[district_id]";
								echo "<select name=\"district\">";
								$query_dis_1= "SELECT * FROM districts";
								$result_dis_1 = mysql_query($query_dis_1);
									while ($record_dis_1 = mysql_fetch_array($result_dis_1))
								{
									if($dis=="$record_dis_1[district_id]")
									{
										echo "<option value=\"" . $record_dis_1['district_id'] . "\" selected=\"selected\">" . $record_dis_1['district'] . "</option>";
									}	
									else
									{
										echo "<option value=\"" . $record_dis_1['district_id'] . "\">" . $record_dis_1['district'] . "</option>";
									}
								}
								echo "</select>";
								?>
							</td>
						</tr>
						<tr>
							<td colspan="4" align="center"><hr></td>
						</tr>
						<tr>
							<td>Father's Name *</td>
							<td>
								<?php echo "<input type=\"text\" name=\"father_name\" style='text-transform:capitalize' value=\"" . $record['father_name'] . "\">";?>
							</td>
							<td>Mother's Name *</td>
							<td>
								<?php echo "<input type=\"text\" name=\"mother_name\" style='text-transform:capitalize' value=\"" . $record['mother_name'] . "\">";?>
							</td>
						</tr>
						<tr>
							<td>Spouse's Name *</td>
							<td>
								<?php echo "<input type=\"text\" name=\"spouse_name\" style='text-transform:capitalize' value=\"" . $record['spouse_name'] . "\">";?>
							</td>
							<td>Phone No</td>
							<td>
								<?php if($record['phone']==0) echo "<input type=\"text\" name=\"phone_no\" value=\"\">";
								else if($record['phone']!=0) echo "<input type=\"text\" name=\"phone_no\" value=\"" . $record['phone'] . "\">";
								?>
							</td>
							
						</tr>
						<tr>
							<td>ID Proof</td>
							<td>
								<?php 
									echo "<input type=\"text\" id=\"idproof\" name=\"id_proof\" tabindex=\"2\" onchange=\"DropDownIndexClear('idprooftextbox');\" style=\"width:150px; position: absolute; z-index: 1;text-transform:capitalize; margin-top:-13px;\" value=\"" . $record['id_proof'] . "\">
									<select name=\"\" id=\"idprooftextbox\" tabindex=\"1000\" onchange=\"DropDownTextToBox(this,'idproof');\" style=\"position: absolute; z-index: 0; width: 173px; margin-top:-13px; value=\">";
									$idproof=array("Voter ID","Adhaar Card","Ration Card","Passport","PAN Card","College ID");
									for($i = 0, $size = count($idproof); $i < $size; $i++)
									{
											echo "<option value=\"".$idproof[$i]."\" >".$idproof[$i]."</option>";
									}
									echo "</select>
									<script language=\"javascript\" type=\"text/javascript\">
											DropDownIndexClear(\"idprooftextbox\");
									</script>";
								?>
							</td>
							<td>ID Proof No</td>
							<td>
								<?php if($record['id_proof_number']==0) echo "<input type=\"text\" name=\"id_proof_no\" style='text-transform:uppercase' value=\"\">";
								if($record['id_proof_number']!=0) echo "<input type=\"text\" id=\" name=\"id_proof_no\" style='text-	transform:uppercase' value=\"" . $record['id_proof_number'] . "\">";
								?>
							</td>
						</tr>
						<tr>
							<td>Occupation</td>
							<td>
								<?php 
									echo "<input type=\"text\" id=\"occupation\" name=\"occupation\" tabindex=\"2\" onchange=\"DropDownIndexClear('occtextbox');\" style=\"width:150px; position: absolute; z-index: 1;text-transform:capitalize;margin-top:-13px;\" value=\"" . $record['occupation'] . "\">
									<select name=\"\" id=\"occtextbox\" tabindex=\"1000\" onchange=\"DropDownTextToBox(this,'occupation');\" style=\"position: absolute; z-index: 0; width: 173px;margin-top:-13px;\" > ";
									$occupation=array('Doctor','Teacher','Government Employee','Private Employee','Farmer','Unemployed','Student','Retired','House Wife');
									for($i = 0, $size = count($occupation); $i < $size; $i++)
									{
											echo "<option value=\"".$occupation[$i]."\" >".$occupation[$i]."</option>";
									}
									echo "</select>
										<script language=\"javascript\" type=\"text/javascript\">
										DropDownIndexClear(\"occtextbox\");
										</script>";
								?>
							</td>
							<td>Education Level</td>
							<td>
								<?php 
								echo "<input type=\"text\" id=\"edulevel\" name=\"edu_level\" tabindex=\"2\" onchange=\"DropDownIndexClear('edleveltextbox');\" style=\"width:150px; position: absolute; z-index: 1; margin-top:-13px;\" value=\"" . $record['education_level'] . "\">
									<select name=\"\" id=\"edleveltextbox\" tabindex=\"1000\" onchange=\"DropDownTextToBox(this,'edulevel');\" style=\"position: absolute;z-index: 0; width: 173px;margin-top:-13px;\" > ";
									$edulevel=array('Illiterate','Literate','Below Primary','Primary','Secondary','Intermediate','Diploma','Undergraduate','Post Graduate');
									for($i = 0, $size = count($edulevel); $i < $size; $i++)
									{
											echo "<option value=\"".$edulevel[$i]."\" >".$edulevel[$i]."</option>";
									}
									echo "</select>
									<script language=\"javascript\" type=\"text/javascript\">
										DropDownIndexClear(\"edleveltextbox\");
									</script>";
								?>
							</td>
						</tr>
						<tr>
							<td>Education Qualification</td>
							<td>
								<?php 
									echo "<input type=\"text\" id=\"eduqual\" name=\"edu_qualification\" tabindex=\"2\" onchange=\"DropDownIndexClear('edqualtextbox');\" style=\"width:150px;position: absolute; z-index: 1; margin-top:-13px;\" value=\"" . $record['education_qualification'] . "\">
									<select name=\"\" id=\"edqualtextbox\" tabindex=\"1000\" onchange=\"DropDownTextToBox(this,'eduqual');\" style=\"position: absolute;z-index: 0; width: 173px;margin-top:-13px;\" > ";
									$eduqual=array('10th','12th','B.Com','B.Sc','B.A','B.Tech/B.E','Diploma','M.B.B.S','Ph.D','M.B.A','L.L.B','M.com','M.Sc','M.A','M.Tech','M.D','F.R.C.S');
									for($i = 0, $size = count($eduqual); $i < $size; $i++)
									{
											echo "<option value=\"".$eduqual[$i]."\" >".$eduqual[$i]."</option>";
									}
									echo "</select>
									<script language=\"javascript\" type=\"text/javascript\">
										DropDownIndexClear(\"edqualtextbox\");
									</script>";
								?>
							</td>
							<td>Blood Group</td>
							<td>
								<select name="blood_group">
									<option value=""<?php if ($record['blood_group'] == '') echo ' selected="selected"'; ?>>---SELECT---</option>
									<option value="A+"<?php if ($record['blood_group'] == 'A+') echo ' selected="selected"'; ?>>A+</option>
									<option value="A-"<?php if ($record['blood_group'] == 'A-') echo ' selected="selected"'; ?>>A-</option>
										<option value="B+"<?php if ($record['blood_group'] == 'B+') echo ' selected="selected"'; ?>>B+</option>
										<option value="B-"<?php if ($record['blood_group'] == 'B-') echo ' selected="selected"'; ?>>B-</option>
										<option value="AB+"<?php if ($record['blood_group'] == 'AB+') echo ' selected="selected"'; ?>>AB+</option>
									 <option value="AB-"<?php if ($record['blood_group'] == 'AB-') echo ' selected="selected"'; ?>>AB-</option>
									 <option value="O+"<?php if ($record['blood_group'] == 'B+') echo ' selected="selected"'; ?>>O+</option>
									 <option value="O-"<?php if ($record['blood_group'] == 'O-') echo ' selected="selected"'; ?>>O-</option>
								</select>
							</td>
						</tr>
					</table>
				</div>
				<div id="div_2" style="display:none;">
					<table width="100%" id="table-tab">
						<tr>
							<td>MR.no
							<span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Medical Record Number</span></a></span>
							</td>
							<td>
								<?php 
									if($record['mr_no']==0) echo "<input type=\"text\" name=\"mr_no\" style='text-transform:uppercase' value=\"\">";
									if($record['mr_no']!=0) echo "<input type=\"text\" name=\"mr_no\" style='text-transform:uppercase' value=\"" . $record['mr_no'] . "\">";
								?>
							</td>
							<td>BC.no
							<span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Birth Certificate Number</span></a></span>
							</td>
							<td>
								<?php if($record['bc_no']==0) echo "<input type=\"text\" name=\"bc_no\" style='text-transform:uppercase' value=\"\">";
									if($record['bc_no']!=0) echo "<input type=\"text\" name=\"bc_no\" style='text-transform:uppercase' value=\"" . $record['bc_no'] . "\">";
								?>
							</td>
						</tr>
						<tr>
							<td>Gestation(in weeks)</td>
							<td>
								<?php echo "<input type=\"text\" name=\"gestation\" style='text-transform:capitalize' value=\"" . $record['gestation'] . "\">";
							?>
							</td>
							<td>Gestation</td>
							<td>
								<select name="gestation_type">
									<option value="" <?php if ($record['gestation_type'] == '') echo ' selected="selected"'; ?>>---SELECT---</option>
									<option value="Term" <?php if ($record['gestation_type'] == 'Term') echo ' selected="selected"'; ?>>Term</option>
									<option value="Pre_Term" <?php if ($record['gestation_type'] == 'Pre_Term') echo ' selected="selected"'; ?>>Pre-Term</option>
									<option value="Post_Term" <?php if ($record['gestation_type'] == 'Post_Term') echo ' selected="selected"'; ?>>Post-Term</option>
								</select>
							</td>
					</tr>
					<tr>
						<td>Delivery Location</td>
						<td colspan="3">
							<?php
								$hosp = ''; 
								$hom = ''; 
								$enr = '';
								if($record['delivery_location']=="hospital")
								{
									$hosp = 'checked="checked"';
								} 
								else if($record['delivery_location']=="home") 
								{
									$hom = 'checked="checked"';
								} 
								else if($record['delivery_location']=="enroute") 
								{
									$enr = 'checked="checked"';
								}
								echo "<input type=\"radio\" id=\"del_loc\" name=\"Del_location\" ondblclick=\"this.checked=!this.checked\" value=\"hospital\"" . $hosp . ">Hospital</input>";
								echo "<input type=\"radio\" id=\"del_home\" name=\"Del_location\" ondblclick=\"this.checked=!this.checked\" value=\"home\"" . $hom . ">Home</input>";
								echo "<input type=\"radio\" id=\"del_enroute\" name=\"Del_location\" ondblclick=\"this.checked=!this.checked\" value=\"enroute\"" . $enr . ">Enroute</input>";
							?>
						</td>
					</tr>
					<tbody id="del_type">
					<tr>
						<td>Type of Hospital</td>
						<td colspan="3">
						<?php
							$gov = ''; 
							$pri = '';
							if($record['hospital_type']=="government")
							{
								$gov = 'checked="checked"';
							}
							else if($record['hospital_type']=="private")
							{
								$pri = 'checked="checked"';
							}
							echo "<input type=\"radio\" name=\"hospital_type\" ondblclick=\"this.checked=!this.checked\" value=\"government\"" . $gov . ">Government</input>";
							echo "<input type=\"radio\" name=\"hospital_type\" ondblclick=\"this.checked=!this.checked\" value=\"private\"" . $pri . ">Private</input>";
						?>
						</td>
					</tr>
					<tr>
						<td>Delivery Location Type</td>
						<td>
						<?php
							$in = ''; 
							$out = '';
							if($record['delivery_location_type']=="IN")
							{
								$in = 'checked="checked"';
							} 
							else if($record['delivery_location_type']=="OUT")
							{
								$out = 'checked="checked"';
							}
							echo "<input type=\"radio\" name=\"Delivery_loc_type\" ondblclick=\"this.checked=!this.checked\" value=\"IN\"" . $in . ">In-Born</input>";
							echo "<input type=\"radio\" name=\"Delivery_loc_type\" ondblclick=\"this.checked=!this.checked\" value=\"OUT\"" . $out . ">Out-Born</input>";
						?>
						</td>
					</tr>
					<tr>
						<td>Booked/Unbooked</td>
						<td>
							<?php
								$bk = ''; 
								$ubk = '';
								if($record['delivery_plan']=="booked")	
								{
									$bk = 'checked="checked"';
								} 
								else if($record['delivery_plan']=="unbooked")
								{
									$ubk = 'checked="checked"';
								}
								echo "<input type=\"radio\" name=\"booked_unbooked\" ondblclick=\"this.checked=!this.checked\" value=\"booked\"" . $bk . ">Booked</input>";
								echo "<input type=\"radio\" name=\"booked_unbooked\" ondblclick=\"this.checked=!this.checked\" value=\"unbooked\"" . $ubk . ">Unbooked</input>";
							?>
						</td>
					</tr>
				</tbody>
					<tr>
						<td>Delivery Mode</td>
						<td>
							<select name="delivery_mode">
								<option value=""<?php if ($record['delivery_mode'] == '') echo ' selected="selected"'; ?>>---SELECT---</option>
									<option value="SPVD"<?php if ($record['delivery_mode'] == 'SPVD') echo ' selected="selected"'; ?>>SPVD</option>
									<option value="EL-LSCS"<?php if ($record['delivery_mode'] == 'EL-LSCS') echo ' selected="selected"'; ?>>EL-LSCS</option>
									<option value="EM-LSCS"<?php if ($record['delivery_mode'] == 'EM-LSCS') echo ' selected="selected"'; ?>>EM-LSCS</option>
									<option value="Assisted Breech Delivery"<?php if ($record['delivery_mode'] == 'Assisted Breech Delivery') echo ' selected="selected"'; ?>>Assisted Breech Delivery</option>
									<option value="Forcepts"<?php if ($record['delivery_mode'] == 'Forcepts') echo ' selected="selected"'; ?>>Forcepts</option>
									<option value="Vaccuum Extraction"<?php if ($record['delivery_mode'] == 'Vaccuum Extraction') echo ' selected="selected"'; ?>>Vaccuum Extraction</option>
									<option value="Episiotomy"<?php if ($record['delivery_mode'] == 'Episiotomy') echo ' selected="selected"'; ?>>Episiotomy</option>
							</select>
						</td>	
						<td>Hospital Name / Enroute Mode</td>
						<td>
							<?php echo "<input type=\"text\" name=\"Del_place\" style='text-transform:capitalize' value=\"" . $record['delivery_place'] . "\">";?>
						</td>
					</tr>
				<tr>
					<td>Weight at Birth</td>
					<td>
						<?php 
							if($record['birth_weight']==0) 
							{ 
								echo "<input type=\"text\" name=\"birth_weight_kgs\" size=\"1\" maxlength=\"1\" value=\"\">kgs<input type=\"text\" name=\"birth_weight_gms\" size=\"2\" maxlength=\"3\" value=\"\">gms";
							}
							if($record['birth_weight']!=0)
							{
								 echo "<input type=\"text\" name=\"birth_weight_kgs\" size=\"1\" maxlength=\"1\" value=\"" . ($record['birth_weight']-$record['birth_weight']%1000)/1000 . "\">kgs<input type=\"text\" name=\"birth_weight_gms\" size=\"2\" maxlength=\"3\" value=\"" . $record['birth_weight']%1000 . "\">gms";
							}
						?>
					</td>
					<td>Congenital anomalies</td>
					<td>
						<?php 
							echo "<input type=\"text\" name=\"congenital_anomalies\" style='text-transform:capitalize' value=\"" . $record['congenital_anomalies'] . "\">";
						?>
					</td>
				</tr>
					</table>
				</div>
				<div id="div_3" style="display:none;" >
					<table width="100%" id="table-tab">
						<tr>
						<td>Visit/Admit Date *</td>
						<td>
						<?php echo "<input type=\"text\" id=\"vdatepicker\" name=\"admit_date\" value=\"" . $record['admit_date'] . "\">";?>
						</td>
						<td>Visit/Admit Time *</td>
						<td>
						<?php 
						$admit_time_12=DATE("g:iA", STRTOTIME($record['admit_time']));;
						echo "<input type=\"text\" id=\"vtimepicker\" size=\"10\" name=\"admit_time\" value=\"" . $admit_time_12 . "\">";?>
						</td>
						</tr>
						<tr>
						<td>Department</td>
						<td>
						<select name="department" id="department" style="max-width:190px;">
						<?php 
						 $did="$record[department_id]";
						 $query_dept= "SELECT * FROM departments";
						 $result_dept = mysql_query($query_dept);
						 echo '<option selected="selected" value="">--Select--</option>';
							while ($record_dept_1 = mysql_fetch_array($result_dept)){
							if($did=="$record_dept_1[department_id]"){
							echo "<option value=\"" . $record_dept_1['department_id'] . "\" selected=\"selected\">" . $record_dept_1['department'] . "</option>";
							}else{
							echo "<option value=\"" . $record_dept_1['department_id'] . "\">" . $record_dept_1['department'] . "</option>";
							}}
						?>
						</select>
						</td>
						<td>Presenting Complaints</td>
						<td>
						<?php echo "<input type=\"text\" name=\"presenting_complaints\" style='text-transform:capitalize' value=\"" . $record['presenting_complaints'] . "\">";?>
						</td>
						</tr>
						<tr><td colspan="4" align="center"><hr></td></tr>
						<tr>
						<td>Hospital File No
						<span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>IN Patient Case Sheet Number</span></a></span>
						</td>
						<td>
						<?php if($record['hosp_file_no']==0) echo "<input type=\"text\" name=\"hosp_file_no\" style='text-transform:uppercase' value=\"\">";
						else if($record['hosp_file_no']!=0) echo "<input type=\"text\" name=\"hosp_file_no\" style='text-transform:uppercase' value=\"" . $record['hosp_file_no'] . "\">";
						?> 
						</td>
						<td>Past History</td>
						<td>
						<?php echo "<input type=\"text\" name=\"past_history\" style='text-transform:capitalize' value=\"" . $record['past_history'] . "\">";?>
						</td>
						</tr>
						<tr>
						<td>Unit</td>
						<td>
						<select name="unit" id="unit" style="min-width:190px;">
						<?php
						$unt="$record[unit]";
						$did="$record[department_id]";
						 $query_unit= "SELECT * FROM units";
								$result_unit = mysql_query($query_unit);
								echo '<option selected="selected" value="">--Select--</option>';
							while ($record_unit = mysql_fetch_array($result_unit)){
							if($unt=="$record_unit[unit_id]"){
							echo "<option value=\"" . $record_unit['unit_id'] . "\" name=\"" . $record_unit['department_id'] . "\" selected=\"selected\">" . $record_unit['unit_name'] . "</option>";
							}else if($did==$record_unit['department_id']){
							echo "<option value=\"" . $record_unit['unit_id'] . "\" name=\"" . $record_unit['department_id'] . "\">" . $record_unit['unit_name'] . "</option>";
							}
							else{
							echo "<option value=\"" . $record_unit['unit_id'] . "\" name=\"" . $record_unit['department_id'] . "\" hidden>" . $record_unit['unit_name'] . "</option>";
							}
							}
								
						?>
						</select>
						</td>
						<td>Area</td>
						<td>
						<select name="area" id="area" style="min-width:190px;">
						<?php
						$are="$record[area]";
						$did="$record[department_id]";
						 $query_area= "SELECT * FROM areas";
						 $result_area = mysql_query($query_area);
						 echo '<option selected="selected" value="">--Select--</option>';
							while ($record_area = mysql_fetch_array($result_area)){
							if($are=="$record_area[area_id]"){
							echo "<option value=\"" . $record_area['area_id'] . "\" name=\"" . $record_area['department_id'] . "\" selected=\"selected\">" . $record_area['area_name'] . "</option>";
							}
							else if($did==$record_area['department_id']){
							echo "<option value=\"" . $record_area['area_id'] . "\" name=\"" . $record_area['department_id'] . "\">" . $record_area['area_name'] . "</option>";
							}
							else{
							echo "<option value=\"" . $record_area['area_id'] . "\" name=\"" . $record_area['department_id'] . "\" hidden>" . $record_area['area_name'] . "</option>";
							}}
						?>
						</select>
						</td>
						</tr>
						<tr>
						<td>Weight at Admission</td>
						<td>
						<?php if($record['admit_weight']==0) {echo "<input type=\"text\" name=\"admit_weight_kgs\" size=\"2\" maxlength=\"3\" value=\"\">kgs<input type=\"text\" name=\"admit_weight_gms\" size=\"2\" maxlength=\"3\" value=\"\">gms";}
						else if($record['admit_weight']!=0) {echo "<input type=\"text\" name=\"admit_weight_kgs\" size=\"2\" maxlength=\"3\" value=\"" . ($record['admit_weight']-$record['admit_weight']%1000)/1000 . "\">kgs<input type=\"text\" name=\"admit_weight_gms\" size=\"2\" maxlength=\"3\" value=\"" . $record['admit_weight']%1000 . "\">gms";}
						?>
						</td>
						<td>Pulse Rate</td>
						<td>
						<?php if($record['pulse_rate']==0) echo "<input type=\"text\" name=\"pulse_rate\" value=\"\">";
						else if($record['pulse_rate']!=0) echo "<input type=\"text\" name=\"pulse_rate\" value=\"" . $record['pulse_rate'] . "\">";
						?>
						</td>
						</tr>
						<tr>
						<td>Respiratory Rate</td>
						<td>
						<?php if($record['respiratory_rate']==0) echo "<input type=\"text\" name=\"respiratory_rate\" value=\"\">";
						else if($record['respiratory_rate']!=0) echo "<input type=\"text\" name=\"respiratory_rate\" value=\"" . $record['respiratory_rate'] . "\">";
						?>
						</td>
						<td>Temperature</td>
						<td>
						<?php if($record['temperature']==0) echo "<input type=\"text\" name=\"temperature\" style='text-transform:capitalize' value=\"\">";
						else if($record['temperature']!=0) echo "<input type=\"text\" name=\"temperature\" style='text-transform:capitalize' value=\"" . $record['temperature'] . "\">";
						?>
						</td>
						</tr>
						<tr>
						<td>Blood Pressure</td>
						<td>
						<?php if($record['sbp']==0) echo "<input type=\"text\" name=\"sbp\" style=\"width:50px;\" value=\"\">"; else if($record['sbp']!=0) echo "<input type=\"text\" name=\"sbp\" style=\"width:50px;\" value=\"" . $record['sbp'] . "\">"; ?> / <?php if($record['dbp']==0) echo "<input type=\"text\" name=\"dbp\" style=\"width:50px;\" value=\"\">"; else if($record['dbp']!=0) echo "<input type=\"text\" name=\"dbp\" style=\"width:50px;\" value=\"" . $record['dbp'] . "\">";?>
						</td>
						<td>Provisional Diagnosis</td>
						<td>
						<?php echo "<input type=\"text\" name=\"provisional_diagnosis\" style='text-transform:capitalize' value=\"" . $record['provisional_diagnosis'] . "\">";?>
						</td>
						</tr>
						<td>Doctor Name</td>
						<td>
						<?php echo "<input type=\"text\" name=\"doctor\" style='text-transform:capitalize' value=\"" . $record['doctor'] . "\">";?>
						</td>
						<td>Nurse Name</td>
						<td>
						<?php echo "<input type=\"text\" name=\"nurse\" style='text-transform:capitalize' value=\"" . $record['nurse'] . "\">";?>
						</td>
						</tr>
						<tr>
						<td>Aarogya Sri
						<span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Health Insurance Scheme</span></a></span>
						</td>
						<td>
						<?php $y = ''; $n = '';if($record['insurance_case']=="yes"){$y = 'checked="checked"';} else if($record['insurance_case']=="no"){$n = 'checked="checked"';}
						echo "<input type=\"radio\" name=\"aarogya\" ondblclick=\"this.checked=!this.checked\" value=\"yes\"" . $y . ">Yes</input>";
						echo "<input type=\"radio\" name=\"aarogya\" ondblclick=\"this.checked=!this.checked\" value=\"no\"" . $n . ">No</input>"; ?>
						</td>
						<td>Aarogya Sri no.</td>
						<td>
						<?php echo "<input type=\"text\" name=\"aarogya_number\" style='text-transform:uppercase' value=\"" . $record['insurance_no'] . "\">";?>
						</td>
						</tr>
						<tr>
						<td>MLC
						<span class="link"><a href="javascript: void(0)"><font face=verdana,arial,helvetica size=2>[?]</font><span>Medico Legal Case</span></a></span>
						</td>
						<td>
						<?php
						$y = ''; $n = '';if($record['mlc']=="1"){$y = 'checked="checked"';} else if($record['mlc']=="0") {$n = 'checked="checked"';}
						echo "<input type=\"radio\" id=\"mlc_yes\" name=\"mlc\" ondblclick=\"this.checked=!this.checked\" value=\"1\"" . $y . ">Yes</input>";
						echo "<input type=\"radio\" id=\"mlc_no\" name=\"mlc\" ondblclick=\"this.checked=!this.checked\" value=\"0\"" . $n . ">No</input>";
						?>
						</td>
						</tr>
						<tbody id="mlc_y">
						<tr>
						<td>MLC number</td>
						<td>
						<?php
						if($record['mlc']=="1"){
						echo "<input type=\"text\" name=\"mlc_number\" style='text-transform:uppercase' value=\"" . $record['mlc_number'] . "\">";
						} else {
						echo "<input type=\"text\" style='text-transform:uppercase' name=\"mlc_number\">";
						}
						?>
						</td>
						<td>PS Name</td>
						<td>
						<?php
						if($record['mlc']=="1"){
						echo "<input type=\"text\" name=\"ps_name\" style='text-transform:capitalize' value=\"". $record['ps_name'] . "\">";
						} else {
						echo "<input type=\"text\" name=\"ps_name\" style='text-transform:capitalize'>";
						}
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
						<tr id="dataTablehead">
							<th>Check</th>
							<th>Date</th>
							<th>Time</th>
							<th>Treatment Type</th>
							<th>Treatment</th>
							<th>Duration(Hrs,Dys,Mns)</th>
							<th>Notes</th>
							</tr>
							<tr>
								<td><input type="checkbox" name="chk"/></td>
								<td><input type="text" name="treatment_date[]" ></td>
								<td><input type="text" name="treatment_time[]" ></td>
								<td><input type="text" name="treatment_type[]"></td>
								<td><input type="text" name="treatment[]" ></td>
								<td><input type="text" name="duration[]" ></td>
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
						<?php echo "<input type=\"text\" name=\"final_diagnosis\" style='text-transform:capitalize' value=\"" . $record['final_diagnosis'] . "\">";?>
						</td>
						</tr>
						<tr>
						<td>ICD-10 Code</td>
						<td>
						<?php echo "<input type=\"text\" name=\"icd_10\" style=\"width:50px;\" value=\"\">"; echo "<input type=\"text\" name=\"icd_10\" style=\"width:50px;\" value=\"" . $record['icd_10'] . "\">";?> . <?php if($record['icd_10_ext']==0) echo "<input type=\"text\" name=\"icd_10_ext\" style=\"width:30px;\" value=\"\">"; else if($record['icd_10_ext']!=0) echo "<input type=\"text\" name=\"icd_10_ext\" style=\"width:30px;\" value=\"" . $record['icd_10_ext'] . "\">";?>
						</td>
						</tr>
						<tr>
						<td>Weight at Discharge</td>
						<td>
						<?php if($record['discharge_weight']==0) echo "<input type=\"text\" name=\"discharge_weight_kgs\" size=\"2\" maxlength=\"3\" value=\"\">kgs<input type=\"text\" name=\"discharge_weight_gms\" size=\"2\" maxlength=\"3\" value=\"\">gms";
						else if($record['discharge_weight']!=0) echo "<input type=\"text\" name=\"discharge_weight_kgs\" size=\"2\" maxlength=\"3\" value=\"" . ($record['discharge_weight']-$record['discharge_weight']%1000)/1000 . "\">kgs<input type=\"text\" name=\"discharge_weight_gms\" size=\"2\" maxlength=\"3\" value=\"" . $record['discharge_weight']%1000 . "\">gms";
						?>
						</td>
						</tr>
						<tr>
						<td>Outcome</td>
						<td>
						<?php
						$dtf = ''; $dth = ''; $dis = ''; $lam = ''; $abs = ''; if($record['outcome']=="transfer"){$dtf = 'checked="checked"';} else if($record['outcome']=="death"){$dth = 'checked="checked"';} else if($record['outcome']=="discharge") {$dis = 'checked="checked"';} else if($record['outcome']=="lama") {$lam = 'checked="checked"';} else if($record['outcome']=="absconded") {$abs = 'checked="checked"';}
						echo "<input type=\"radio\" name=\"outcome\" id=\"out_transfer\" ondblclick=\"this.checked=!this.checked\" value=\"transfer\"" . $dtf . ">Transfer</input>";
						echo "<input type=\"radio\" name=\"outcome\" id=\"out_discharge\" ondblclick=\"this.checked=!this.checked\" value=\"discharge\"" . $dis . ">Discharge</input>";
						echo "<input type=\"radio\" name=\"outcome\" id=\"out_lama\" ondblclick=\"this.checked=!this.checked\" value=\"lama\"" . $lam . ">Lama</input>";
						echo "<input type=\"radio\" name=\"outcome\"  id=\"out_abscond\" ondblclick=\"this.checked=!this.checked\" value=\"absconded\"" . $abs . ">Asconded</input>";
						echo "<input type=\"radio\" name=\"outcome\" id=\"out_death\" ondblclick=\"this.checked=!this.checked\" value=\"death\"" . $dth . ">Death</input>";
						?>
						</td></tr>
						<tbody id="outcome_dt">
						<tr>
						<td>Outcome Date *</td>
						<td>
						<?php if($record['outcome_date']==0) echo "<input type=\"text\" id=\"odatepicker\" name=\"outcm_date\" value=\"\">";
						else if($record['outcome_date']!=0) echo "<input type=\"text\" id=\"odatepicker\" name=\"outcm_date\" value=\"" . $record['outcome_date'] . "\">";
						?>
						</td>
						</tr>
						<tr>
						<td>Outcome Time *</td>
						<td>
						<?php 
						$outcome_time_12=DATE("g:iA", STRTOTIME($record['outcome_time']));
						if($outcome_time_12==0) echo "<input type=\"text\" id=\"otimepicker\" size=\"10\" name=\"outcm_time\" value=\"\">";
						else if($outcome_time_12!=0) echo "<input type=\"text\" id=\"otimepicker\" size=\"10\" name=\"outcm_time\" value=\"" . $outcome_time_12 ."\">";
						?>
						</td>
						</tr>
						</tbody>
						<tr>
						<td>File Recieved Date by MRD</td>
						<td>
						<?php if($record['ip_file_received']==0) echo "<input type=\"text\" id=\"rdatepicker\" name=\"fileres_date\" value=\"\">";
						else if($record['ip_file_received']!=0) echo "<input type=\"text\" id=\"rdatepicker\" name=\"fileres_date\" value=\"" . $record['ip_file_received'] . "\">";?>
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
	<tr><td colspan='2' align='center'><input type="submit" name="sub" Value="Update"></td></tr>
</table>
</form>
<?php
/*
VERSION TRACK
1 - 16May2013 - Yashasvi - BUG RESOLVED - Displaying Visit/admit info,discharge/treatment info.
*/
?>
