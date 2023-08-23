<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>home</title>
<meta http-equiv="refresh" content="300"/>
</head>
<body>
<hr>
<h3 align="center"><!--<i class="fa fa-clock-o" style="font-size:20px"></i> -->&#128344; กำลังรออนุมัติ</h3>
<hr>
<div class="table-responsive">
<table class="datatable table table-hover table-bordered">
<thead>
 <tr style="background-color: #ff9800">
 <th width="14%"><h4>รหัสยืมอุปกรณ์</h4></th>
 <th width="20%"><h4>ชื่อผู้ใช้</h4></th>
 <th width="23%"><h4>ในวันที่</h4></th>
 <th width="23%"><h4>ถึงวันที่</h4></th>
 <th width="20%"><h4>รออนุมัติ</h4></th>
 </tr>
</thead>
<tbody>
<?php
$sql="select * from tb_servicedetails where status_id=1";
$result=$db->query($sql);
while($row=$result->fetch_array(MYSQLI_BOTH)){
  $row["on_date"]=show_tdate($row["on_date"]);
  $row["to_date"]=show_tdate($row["to_date"]);
?>
 <tr>
 <td><?=$row["servicedetail_id"]?></td>
<?php
	$sqlmember="select * from tblemployment where ID='$row[user_id]'";
	$resultmember=$db->query($sqlmember);
	$rowmember=$resultmember->fetch_array(MYSQLI_BOTH);
 ?>
 <td><?=$rowmember["prefixThai"]?> <?=$rowmember["nameThai"]?></td>
 <td><?=$row["on_date"]?> เวลา <?=$row["on_time"]?></td>
 <td><?=$row["to_date"]?> เวลา <?=$row["to_time"]?></td>
 <td><a href="?page=check&servicedetail_id=<?=$row["servicedetail_id"];?>" title="ดูรายละเอียด"><button class="btn btn-warning"><i class="fa fa-search"></i> รออนุมัติ/ยืนยัน</button></a></td>
<?php } ?>
 </tr>
</tbody>
</table>
</div>
<hr>
<h3 align="center"><!-- <i class="fa fa-refresh" style="font-size:20px"></i> -->&#128260; อยู่ระหว่างการยืม</h3>
<hr>
<div class="table-responsive">
<table class="datatable table table-hover table-bordered">
<thead>
 <tr style="background-color: #e7e7e7">
 <th width="12%"><h4>รหัสยืมอุปกรณ์</h4></th>
 <th width="19%"><h4>ชื่อผู้ใช้</h4></th>
 <th width="19%"><h4>ในวันที่</h4></th>
 <th width="19%"><h4>ถึงวันที่</h4></th>
 <th width="18%"><h4>ผู้อนุมัติ</h4></th>
 <th width="13%"><h4>สถานะการยืม</h4></th>
 </tr>
</thead>
<tbody>
<?php
$sql="select * from tb_servicedetails where status_id=3";
$result=$db->query($sql);
while($row=$result->fetch_array(MYSQLI_BOTH)){
  $row["on_date"]=show_tdate($row["on_date"]);
  $row["to_date"]=show_tdate($row["to_date"]);
?>
 <tr>
 <td><?=$row["servicedetail_id"]?></td>
<?php
	$sqlmember="select * from tblemployment where ID='$row[user_id]'";
	$resultmember=$db->query($sqlmember);
	$rowmember=$resultmember->fetch_array(MYSQLI_BOTH);
 ?>
 <td><?=$rowmember["prefixThai"]?> <?=$rowmember["nameThai"]?></td>
 <td><?=$row["on_date"]?> เวลา <?=$row["on_time"]?></td>
 <td><?=$row["to_date"]?> เวลา <?=$row["to_time"]?></td>
 <td><?=$row["userapprove_id"]?></td>
	 <td><a href="?page=check_return&servicedetail_id=<?=$row["servicedetail_id"];?>" title="ดูรายละเอียด"><span class="btn btn-default"><i class="fa fa-search"></i> ตรวจสอบ/รับคืน</span></a></td>
<?php } ?>
 </tr>
</tbody>
</table>
</div>
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