<?php include("config.php");
$id=$_GET["userid"];
header("Content-type: application/vnd.ms-excel");
// header('Content-type: application/csv'); //*** CSV ***//
header("Content-Disposition: attachment; filename=ประวัติการทำรายการ.xls");
?>
<html>
<body>
<?php
$startdatethai=show_tdate($startdate);
$enddatethai=show_tdate($enddate);
  $sqlmem='';
	$sqlmem="select * from tblemployment where ID='$id'";
	$resultmem=$db->query($sqlmem);
	$rowmem=$resultmem->fetch_array(MYSQLI_ASSOC);
?>
<h3 align="center"> ประวัติรายการของ <?=$rowmem["prefixThai"]?> <?=$rowmem["nameThai"]?></h3>
<table border="1">
<tr>
<th align="center">รหัสยืม</th>
<th align="center">ชื่อผู้ใช้</th>
<th align="center">วันที่ยืม</th>
<th align="center">ถึงวันที่</th>
<th align="center">ผู้ให้ยืม</th>
<th align="center">ผู้รับคืน</th>
<th align="center">หมายเหตุคืน</th>
<th align="center">สถานะการยืม</th>
</tr>
<?php
$sql="SELECT * from tb_servicedetails where tb_servicedetails.status_id=4 AND user_id='$id'";
$result=$db->query($sql);
while($row=$result->fetch_array(MYSQLI_ASSOC)){
?>
 <tr>
 <td><?=$row["servicedetail_id"]?></td>
  <?php
  $sqlmember='';
	$sqlmember="select * from tblemployment where ID='$row[user_id]'";
	$resultmember=$db->query($sqlmember);
	$rowmember=$resultmember->fetch_array(MYSQLI_ASSOC);
	$row["on_date"]=show_tdate($row["on_date"]);
	$row["to_date"]=show_tdate($row["to_date"]);
 ?>
 <td><?=$rowmember["prefixThai"]?> <?=$rowmember["nameThai"]?></td>
 <td><?=$row["on_date"]?> เวลา <?=$row["on_time"]?></td>
 <td><?=$row["to_date"]?> เวลา <?=$row["to_time"]?></td>
 <td><?=$row["userapprove_id"]?></td>
 <td><?=$row["userrecipient_id"]?></td>
 <td style="mso-number-format:\@;"><?=$row["recipient_note"]?></td>
 <td align="center">คืนอุปกรณ์แล้ว</td>
 </tr>
<?php
}
?>
</table>
</body>
</html>

<?php
function  show_tdate($date_in) // กำหนดชื่อของฟังชั่น show_tdate และสร้างตัวแปล $date_in ในการรับค่าที่ส่งมา
{
$month_arr = array("มกราคม" , "กุมภาพันธ์" , "มีนาคม" , "เมษายน" , "พฤษภาคม" , "มิถุนายน" , "กรกฏาคม" , "สิงหาคม" , "กันยายน" , "ตุลาคม" ,"พฤศจิกายน" , "ธันวาคม" ) ;
$tok = strtok($date_in, "-");
$year = $tok ;
$tok  = strtok("-");
$month = $tok ;
$tok = strtok("-");
$day = $tok ;
$year_out = $year + 543 ;
$cnt = $month-1 ;
$month_out = $month_arr[$cnt] ;
$t_date = $day." ".$month_out." ".$year_out ;
return $t_date ;
}
?>