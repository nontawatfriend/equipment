<?php include("config.php");
$startdate=$_GET["ondate"];
$enddate=$_GET["todate"];
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
		if(!empty($startdate) && !empty($enddate) && !empty($id)){?>
			<h3 align="center"> ประวัติรายการของ <?=$rowmem["prefixThai"]?> <?=$rowmem["nameThai"]?> ระหว่างวันที่ <?=$startdatethai?> ถึงวันที่ <?=$enddatethai?></h3>
			<?php }
		else if(!empty($startdate) && !empty($enddate) && empty($id)){?>
			<h3 align="center">ประวัติรายการของ <?=$startdatethai?> ถึงวันที่ <?=$enddatethai?></h3>
			<?php } 
		else if(empty($startdate) && empty($enddate) && !empty($id)){?>
			<h3 align="center">ประวัติรายการ ระหว่างวันที่ <?=$rowmem["prefixThai"]?> <?=$rowmem["nameThai"]?></h3>
			<?php } 
		else{?>
			<h3 align="center">ประวัติรายการ</h3>
		<?php }?>
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
$sql='';
if( !empty($startdate) && !empty($enddate) && !empty($id)){
	$sql="SELECT * from tb_servicedetails where tb_servicedetails.status_id=4 AND user_id='$id' AND on_date BETWEEN '$startdate' AND '$enddate'";
}
else if( !empty($startdate) && !empty($enddate) && empty($id)){
	$sql="SELECT * from tb_servicedetails where tb_servicedetails.status_id=4 AND on_date BETWEEN '$startdate' AND '$enddate'";
}else if( empty($startdate) && empty($enddate) && !empty($id)){
	$sql="SELECT * from tb_servicedetails where tb_servicedetails.status_id=4 AND user_id='$id'";
}else{
	$sql="SELECT * from tb_servicedetails where tb_servicedetails.status_id=4";
}
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
$month_arr = array("มกราคม" , "กุมภาพันธ์" , "มีนาคม" , "เมษายน" , "พฤษภาคม" , "มิถุนายน" , "กรกฏาคม" , "สิงหาคม" , "กันยายน" , "ตุลาคม" ,"พฤศจิกายน" , "ธันวาคม" ) ; //กำหนด อาร์เรย์ $month_arr  เพื่อเก็บ ชื่อเดือน ของไทย
// ใช้ฟังชั่น strtok เพื่อแยก ปี เดือน วัน
// โดยเริ่มจาก ปีก่อน
$tok = strtok($date_in, "-"); //สร้างตัวแปล $tok เพื่อเก็บค่าแยกของปี ออกมา
$year = $tok ; //กำหนดค่าให้ ตัวแปล $year มีค่าเท่ากับ ปีที่ ถูกแยกออกมาจาก ตัวแปล $tok 
//ต่อไปคือส่วนของ เดือน
$tok  = strtok("-");// ส่วนนี้เราจะมีไว้เพื่อทำการแยกเดือน
$month = $tok ;//สร้างตัวแปล$monthเพื่อเก็บค่าแยกของเดือน ออกมา
//ต่อไปส่วนสุดท้ายคือ ส่วนของวันที่
$tok = strtok("-");//ส่วนนี้เราจะมีไว้เพื่อทำการแยกเดือน
$day = $tok ;//สร้างตัวแปล $$dayเพื่อเก็บค่าแยกของเดือน ออกมา
//เมื่อได้ส่วนแยกของ วัน เดือน ปี มาแล้วว แต่ ปี ยังเป็นรูปแบบของ ค.ศ. ดังนั้นเราต้องแปล เป็น พ.ศ.  ก่อนด้ววิธีกรนนี้
$year_out = $year + 543 ;// สร้างตัวแแปลขึ้นมาเพื่อเก็บค่าที่ได้จากการนำปี ค.ศ. มาบวกกับ 543  ก็จะได้ปีที่เป็น  พ.ศ. ออกมา
$cnt = $month-1 ;// เราตัองสร้างตัวแปล มาเพื่อเก็บค่าเดือน โดยจะต้องเอาเดือนที่ได้มา ลบ 1 เพราะว่า เราจะต้องใช้ในการเทียบกับ ค่าที่อยู่ได้อาร์เรย์ เนื่องจาก อาร์เรย์จะมีค่า เริ่มจาก 0
$month_out = $month_arr[$cnt] ;// ทำการเทียบค่าเดือนที่ได้กับเดือนที่เก็บไว้ในอาร์เรย์ แล้วเก็บลงใน ตัวแปล
$t_date = $day." ".$month_out." ".$year_out ; //สร้างตัวแปลเก็บค่า วัน เดือน ปี ที่แปลเป็นไทยแล้ว
return $t_date ;// ส่งค่ากลับไปยังส่วนที่ส่งมา
}
?>