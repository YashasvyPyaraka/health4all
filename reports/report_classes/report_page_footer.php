<?php
if (isset($_POST['submit'])){
if($report_type=='OP'){$total_type="Total OP Visits";} else {$total_type="Total IP Admissions";}
 $result = mysql_query($query);
 if(mysql_num_rows($result) != 0) {
 if ($column2=='Month'){
 $arr_m = array("","January","February","March","April","May","June","July","August","September","October","November","December");
 }
 $i=1; $total=0; $mc=0; $fc=0; $c=0; $ma=0; $fa=0;$a=0;
 echo "<table id=\"table-his\">";
 echo "<thead>";
 echo "<tr><th rowspan=\"2\">S.no</th>"; echo "<th rowspan=\"2\">".$column1."</th>"; if ($column2=='Month'){echo "<th rowspan=\"2\">".$column2."</th>";} echo "<th colspan=\"3\" align=\"center\"><= 14 Years</th>"; echo "<th colspan=\"3\" align=\"center\">> 14 Years</th>"; echo "<th rowspan=\"2\">" . $total_type . "</th></tr>"; 
 echo "<tr><th>Male</th>";  echo "<th>Female</th>";  echo "<th>Total</th>";  echo "<th>Male</th>";  echo "<th>Female</th>";  echo "<th>Total</th></tr>";
 echo "</thead>";
    $csv_hdr = " S.no,Department,Male<14,Female<14,Total<14,Male>14,Female>14,Total>14,Total OP visits";
    $csv_output="";
 echo "<tbody>";
 while ($record = mysql_fetch_array($result)){
 echo "<tr>";
 echo "<td>" . $i . "</td>";
$csv_output .= $i . ", ";
 echo "<td>" . $record[$column1] . "</td>";
$csv_output .= $record[$column1] . ", ";
 if ($column2=='Month'){
 echo "<td>" . $arr_m[$record[$column2]] . "</td>";
$csv_output .= $arr_m[$record[$column2]] . ", ";
 }
 echo "<td>" . $record['mchild'] . "</td>";
$csv_output .= $record['mchild'] . ", ";
 echo "<td>" . $record['fchild'] . "</td>";
$csv_output .= $record['fchild'] . ", ";
 echo "<td>" . $record['child'] . "</td>";
$csv_output .= $record['child'] . ", ";
 echo "<td>" . $record['madult'] . "</td>";
$csv_output .= $record['madult'] . ", ";
 echo "<td>" . $record['fadult'] . "</td>";
$csv_output .= $record['fadult'] . ", ";
 echo "<td>" . $record['adult'] . "</td>";
$csv_output .= $record['adult'] . ", ";
 echo "<td>" . $record[$report_type] . "</td>";
$csv_output .= $record[$report_type] . "\n ";
 echo "</tr>";
 $mc=$mc+$record['mchild']; $fc=$fc+$record['fchild']; $c=$c+$record['child']; $ma=$ma+$record['madult']; $fa=$fa+$record['fadult']; $a=$a+$record['adult'];  
 $total=$total+$record[$report_type];
 $i++;
 }
 echo "<tr>";

 echo "<td style=\"border-top:1px solid;\"></td>";
 $csv_output .= ", ";
 if ($column2=='Month'){
 echo "<td style=\"border-top:1px solid;\"></td>";
 $csv_output .= ", ";
 }
 echo "<td style=\"border-top:1px solid;\">" . $total_type . "</td>";
 $csv_output .= $total_type . ", ";
 echo "<td style=\"border-top:1px solid;\">" . $mc . "</td>";
 $csv_output .= $mc . ", ";
 echo "<td style=\"border-top:1px solid;\">" . $fc . "</td>";
 $csv_output .= $fc . ", ";
 echo "<td style=\"border-top:1px solid;\">" . $c . "</td>";
 $csv_output .= $c . ", ";
 echo "<td style=\"border-top:1px solid;\">" . $ma . "</td>";
 $csv_output .= $ma . ", ";
 echo "<td style=\"border-top:1px solid;\">" . $fa . "</td>";
 $csv_output .= $fa . ", ";
 echo "<td style=\"border-top:1px solid;\">" . $a . "</td>";
 $csv_output .= $a . ", ";
 echo "<td style=\"border-top:1px solid;\">" . $total . "</td>";
 $csv_output .= $total . ", ";
 echo "</tr>";
 echo "</tbody>";
 ?>
<form name="export" action="export.php" method="post">
<input type="submit" value="Export table to CSV">
<input type="hidden" value="<?php echo $csv_hdr; ?>" name="csv_hdr">
<input type="hidden" value="<?php echo $csv_output; ?>" name="csv_output">
</form>
<input type="submit" value="Print report" onclick="window.print();">
<?php
 echo "</table>";
 if($chart_name!=''){
 echo "<br>";
 include "../charts/".$chart_name.".php";
 }
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
